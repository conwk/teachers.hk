<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contact;
use Validator;

class ContactController extends Controller {
	public function __construct()
    {
		if(!Auth::check()){
	        return view('auth.login');
	    }       
    } 
	
	
	public function all_contact()
    {	
		$user = Auth::user();		
        if(Auth::check()){		
		$user_id = Auth::user()->id;			
		$user = User::find($user_id);       
		$contact = Contact::where('user_id', $user_id)->orderBy("id", "desc")->paginate(5);
        return view('contact',compact('contact','user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
		}    
		return redirect("login")->withSuccess('You are not allowed to access');	
    }
	
	public function validate_phone_number($phone)
	{
		 $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
		 $phone_to_check = str_replace("-", "", $filtered_phone_number);
		 if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
			return false;
		 } else {
		   return true;
		 }
	}
	
	public function contact(Request $request){	
		$result = array();
		$send = true;
		$contact_method = $_POST['contact_method'];
		$contact = trim($_POST["contact"]);
		if($contact_method == 1){			
			if (!filter_var($contact, FILTER_VALIDATE_EMAIL)) {
				$result['status'] = false;
				$result['message'] = 'Please enter a valid email address.';	
				$send = false;
			}
		}else{
			if ($this->validate_phone_number($contact) != true) {
				$result['status'] = false;
				$result['message'] = 'Please enter a valid Mobile number.';	
				$send = false;
			}		
		}
		if($send){
			$profileId = $_POST['user_id'];
			$user = User::where('profile_id',$profileId)->first();
			$request['type'] = 'profile';
			$request['user_id'] = $user->id;
			$contact = Contact::create($request->all());
			if($contact){
				$result['status'] = true;
				$result['message'] = 'Success';	
			}else{
				$result['status'] = false;
				$result['message'] = 'Error';	
			}
		}
		return response()->json($result);	
    }	
	
	public function contact_post(Request $request){	
		$result = array();
		$send = true;
		$contact_method = $_POST['contact_method'];
		$contact = trim($_POST["contact"]);
		if($contact_method == 1){			
			if (!filter_var($contact, FILTER_VALIDATE_EMAIL)) {
				$result['status'] = false;
				$result['message'] = 'Please enter a valid email address.';	
				$send = false;
			}
		}else{
			if ($this->validate_phone_number($contact) != true) {
				$result['status'] = false;
				$result['message'] = 'Please enter a valid Mobile number.';	
				$send = false;
			}		
		}
		if($send){
			$contact = Contact::create($request->all());
			if($contact){
				$result['status'] = true;
				$result['message'] = 'Success';	
			}else{
				$result['status'] = false;
				$result['message'] = 'Error';	
			}
		}
		return response()->json($result);	
		die;
    }	
	
}
