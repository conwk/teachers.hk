<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
      

    public function sendOtp(Request $request){
         $otp = rand(1000,9999);
         
        // Log::info("otp = ".$otp);
       $users = User::where('mobile', '=', $request->input('mobile'))->first();
        if ($users === null) {
            User::create([
                'mobile' => $request->input('mobile'),
            ]);
            $user = User::where('mobile','=', $request->input('mobile'))->update(['otp' => $otp]);
            return response()->json([$user],200);
      }else{
           $user = User::where('mobile','=', $request->input('mobile'))->update(['otp' => $otp]);
            return response()->json([$user],200);
      }
     
    }

    public function customLogin(Request $request)
    {
        Log::info($request);
        $user  = User::where([['mobile','=',request('mobile')],['otp','=',request('otp')]])->first();
        
         $otp = rand(1000,9999);
         /*Send OTP*/
        $basic  = new \Nexmo\Client\Credentials\Basic('24e51527', 'IHCsAbJeip29P0q2');
        $client = new \Nexmo\Client($basic);
 
        $message = $client->message()->send([
            'to' => '91'.$request->mobile,
            'from' => 'LMS',
            'text' => 'Your login OTP is '.$otp
        ]);
        
        
        if( $user){
            Auth::login($user, true);
            User::where('mobile','=',$request->mobile)->update(['otp' => null]);
            return view('dashboard');
        }
    }



    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}