<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\Session;

class UserOtpAuthController extends Controller
{

    public function index()
    {
       if(Auth::check()){
	        return redirect("dashboard");
	    }
        return view('auth.login');
    }  
	
	
    public function sendOtp(Request $request){
        $otp = rand(1000,9999);
        $basic  = new \Nexmo\Client\Credentials\Basic($_ENV['SMS_API_KEY'], $_ENV['SMS_API_SECRET']);
        $client = new \Nexmo\Client($basic);
        $users = User::where('mobile', '=', $request->input('mobile'))->first();
		$result = array();
		$request->session()->put('otpValue',$otp);
		
	   if ($users === null) {
            User::create([
                'mobile' => $request->input('mobile'),]);            
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
					$result['message'] = 'Otp has been sent';	
				}				        
		}else{ 
		//echo $users->first_name;
		 if ((!empty($users->first_name)) && (!empty($users->last_name)) && $users->status == 0):			
			$result['status'] = false;
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
		
		if($request->session()->has('otpValue')){
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
			$request->validate([
				'first_name'=>'required',
				'last_name'=>'required',
			]);
			$user = Auth::user();	
			//$user->status = 0;
			$category = User::where('id',$user->id);
			$data = $request->except('_token');
			$data['status'] = 0;
			$category->update($data);			
			 return redirect()->route('profile')
                        ->with('success','profile updated successfully.');
			
		}
    }

    public function dashboard()
    {
		$user = Auth::user();		
        if(Auth::check()){
			if(empty($user->first_name) || empty($user->last_name)){
				 return redirect("profile");
			}else if($user->status == 2){
				return redirect("profile");
			}else{
				 return view('dashboard');
			}     
		}
		return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function profile()
    {
		$user = Auth::user();		
        if(Auth::check()){		
			$user = User::find($user->id);       
			 return view('profile')->with(compact('user'));;
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}