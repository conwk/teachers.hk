<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Cookie;
use Image;
//use Illuminate\Support\Facades\Session;

class UserOtpAuthController extends Controller
{

    public function index()
    {
       if(Auth::check()){
	        return redirect("profile");
	    }
		
		return view('auth.login');
    }  
	

    public function sendOtp(Request $request){
        $otp = rand(1000,9999);
        $basic  = new \Nexmo\Client\Credentials\Basic($_ENV['SMS_API_KEY'], $_ENV['SMS_API_SECRET']);
        $client = new \Nexmo\Client($basic);
        $users = User::where('mobile', '=', trim($request->input('mobile')))->first();
		$result = array();
		$request->session()->put('otpValue',time());
		
	   if ($users === null) {
				$response = $client->message()->send([
					'to' => $_ENV['MOBILE_EXTENSION'].$request->input('mobile'),
					'from' => 'LMS',
					'text' => 'Your login OTP is '.$otp
				]);	
				
				$message = $response->current();			
				if($message['network'] == 'IN-FIXED'){	
					$result['status'] = false;
					$result['message'] = 'Mobile number is wrong';						
				}else{	
					User::create(['mobile' => $request->input('mobile'), 'profile_id' => $this->generateRandomString()]);            
					$user = User::where('mobile','=', $request->input('mobile'))->update(['otp' => $otp]);				
					$result['status'] = true;
					$result['action'] = '';
					$result['message'] = 'Otp has been sent';	
				}				        
		}else{ 
		 if ($users->status == 0):			
			$result['status'] = true;
			$result['action'] = 'review';
			$result['message'] = 'Your profile is under review';			
		 else:
			$user = User::where('mobile','=', $request->input('mobile'))->update(['otp' => $otp]);			
		 	$response = $client->message()->send([
                'to' => $_ENV['MOBILE_EXTENSION'].$request->input('mobile'),
                'from' => 'LMS',
                'text' => 'Your login OTP is '.$otp
            ]);	
						
			$message = $response->current();			
			if($message['network'] == 'IN-FIXED'){	
				$result['status'] = false;
				$result['message'] = 'Mobile number is wrong';						
			}else{	
				$result['status'] = true;
				$result['action'] = '';
				$result['message'] = 'Otp has been sent';	
			} 		
             endif;
					           
		   //return response()->json([$user],200);
        }
		 return response()->json($result);
		//echo json_encode($result);	
		//die;
    }

    public function userLogin(Request $request)
    {	
		$timeA = $request->session()->get('otpValue');
		$timeB = time(); 
		$checkTime = ($timeB - $timeA) / 60; // 25
		if($checkTime < 5){
			Log::info($request);
			$result = array();
			$user  = User::where([['mobile','=',request('mobile')],['otp','=',request('otp')]])->first();       
			if (!$user) {
				$result['status'] = false;
				$result['message'] = 'Invalid OTP';		
				return response()->json($result);
			}else{
				Auth::login($user, true);
				User::where('mobile','=',$request->mobile)->update(['otp' => null]);
				$result['status'] = true;				
				$result['message'] = 'Login Successful!';
				if($user->status == 1){
					$result['action'] = "edit-profile";
				}else if($user->status == 2){
					$result['action'] = "rejection";
				}else{
					$result['action'] = "registration";
				}
				return response()->json($result);
			}
		}else{
			$result['status'] = false;
			$result['message'] = 'OTP Expire';		
			return response()->json($result);
		}
        return response()->json(['error'=>'Ooops! something went wrong!']);
    }

	public function updateProfile(Request $request)
    {
		
		if(Auth::check()){
			$user = Auth::user();	
			$data = $request->input();
			$profileId = "";
			if(!empty($data['new_profile_id'])){
				$checkUser = User::where([['profile_id','=',$data['new_profile_id']], ['id','!=',$user->id]])->first();
				if(!empty($checkUser)){
				  return redirect()->route('edit-profile')
                        ->with('error','Profile URL is not valid.');
				}
				$profileId = $data['new_profile_id'];
			}
			
			$avatar = null;			
			if(!empty($data['avatar']) && $data['avatar'] != "temp" && $data['avatar'] !="deleted"){				
				$image = $data['avatar'];
				list($type, $image) = explode(';',$image);
				list(, $image) = explode(',',$image);

				$image = base64_decode($image);
				$avatar = time().'.jpg';
				$destinationPath = public_path('/frontend/teacher/');
				file_put_contents($destinationPath.$avatar, $image);
				
			}			
			
			$user = User::where('id',$user->id);
			$photo = "";
			if($data['avatar'] == "deleted"){
				$photo = "deleted";
			}
			$data = $request->except(['_token','avatar','new_profile_id']);
			$data['social_links'] = json_encode($data['social_links']);
			if(!empty($avatar)){
				$data['photo'] = $avatar;			
			}elseif($photo == "deleted"){
				$data['photo'] = "";
			}
			
			
			if(!empty($profileId)){
				$data['profile_id'] = $profileId;			
			}
			if(isset($data['edit_url']) && $data['edit_url'] == "on"){
				$data['edit_url'] = 1;
			}else{
				$data['edit_url'] = 0;
			}
			
			$user->update($data);			
			 return redirect()->route('profile')
                        ->with('success','profile updated successfully.');
			
		}
    }

    public function dashboard()
    {
		$user = Auth::user();		
        if(Auth::check()){
			if(empty($user->first_name) || empty($user->dob)){
				 return redirect("profile");
			}else if($user->status == 2){
				return redirect("profile");
			}else{
				 return view('dashboard');
			}     
		}
		return redirect("login")->withSuccess('You are not allowed to access');
    }
	
	public function edit_profile(){
		$user = Auth::user();		
        if(Auth::check()){		
			$user = User::find($user->id); 
			return view('edit_profile')->with(compact('user'));;
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function profile()
    {
		$user = Auth::user();		
        if(Auth::check()){		
			$user = User::find($user->id);     
			$posts = Post::where('user_id', $user->id)->paginate(5);
			return view('profile')->with(compact('user','posts'));;
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
    }
	
	public function profile_view( $profileId = null )
    {
		$user = User::where('profile_id',$profileId)->first();
        if(!empty($user->id)){		
			$posts = Post::where('user_id', $user->id)->paginate(10);
			if(!$user->edit_url){
				$message = "Profile Not Exist!";
				return view('page_404')->with(compact('message'));
			}else{
				return view('profile')->with(compact('user','posts'));
			}			
		}    
		$message = "Profile Not Exist!";
		return view('page_404')->with(compact('message'));
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
	
	
	public function review(){
		$user = Auth::user();
		return view('review')->with(compact('user'));
	}
	
	
	public function registration(Request $request){
		$user = Auth::user();
		if(Auth::check()){	
			if(!empty($request->input())){
				$userProfile = User::where('id',$user->id);
				$data = $request->except('_token');
				$data['status'] = 0;
				$userProfile->update($data);			
				return redirect()->route('review');
			}else{
				$user = User::find($user->id);       
				return view('registration')->with(compact('user'));
			}
			
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
	}
	
	public function rejection(Request $request){
		$user = Auth::user();
		if(Auth::check()){	
			if(!empty($request->input())){
				$userProfile = User::where('id',$user->id);
				$data = $request->except('_token');
				$data['status'] = 0;
				$userProfile->update($data);			
				return redirect()->route('review');
			}else{
				$user = User::find($user->id);       
				return view('rejection')->with(compact('user'));
			}
			
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
	}
	
	public function checkProfileUrl($profile_id){
		$user = Auth::user();
		if(Auth::check()){	
			if(!empty($profile_id)){
			  $user = User::where([['profile_id','=',$profile_id], ['id','!=',$user->id]])->first();
			  if(empty($user)){
				  echo true;
			  }
			}
		}
	   
	}
	
	public function removePhoto(){
		$user = Auth::user();
		if(Auth::check()){	
			$user = User::where('id',$user->id);
			$data['photo'] = "";
			$user->update($data);
			echo true;
		}
	}
	
	function generateRandomString($length = 6) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return strtoupper($randomString);
	}
	
	
}