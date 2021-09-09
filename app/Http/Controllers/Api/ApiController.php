<?php
namespace App\Http\Controllers\Api;

use App\Http\Requests\PageFormRequest;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Components\FlashMessages;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;
use Laravel\Sanctum\HasApiTokens;

class ApiController extends Controller {

	public function __construct() {
		  $this->apiToken = uniqid(base64_encode(str_random(60)));
	}

  /**
    * Function for api data
    *
    * @param null
    *
    * @return json reponse.
    */

	
    public function login(Request $request)
    { 
      if(isset($_POST) && !empty($_POST)){
        $email  = $_POST['email'];
        $password   = $_POST['password'];
        $users  = DB::table('users')
                  ->where('email', $email)                  
                  ->first();
        if(isset($users) && !empty($users)) {   
            if(Hash::check($password, $users->password)){
			$update = DB::table('users')
              ->where('email', $email)
              ->update(array(
                'remember_token' => $this->apiToken
              ));
              $response = array();
              $response['id']       = $users->id;
              $response['name']= (@$users->name) ?: '';
              $response['email']    = (@$users->email) ?: '';
			  $response['access_token'] = $this->apiToken;
              return response()->json([
                'status'  => TRUE,
                'message' => 'Login successfully!',
                'data'    => $response
                //'access_token' => $this->apiToken
              ]);
            }else{
              return response()->json([
                'status' => FALSE,
                'message' => 'Password not correct!',
              ]);
            }         
        }
        else{
          return response()->json([
            'status'  => FALSE,
            'message' => 'Invalid login credentials!',
          ]);
        }
      }
      else{
        return response()->json([
          'status'  => FALSE,
          'message' => 'Some error found!'
        ]);
      }
    }
	
	public function dashboard(Request $request)
    { 
		$token = $request->header('Authorization');
		if(isset($token) && !empty($token))
		{
		   $usercheck  = DB::table('users')
			->where('remember_token', $token)
			->first();
				if(isset($usercheck) && !empty($usercheck)){
				return response()->json([
				  'status'  => TRUE,
				  'message' => 'Welecome'
				]);
			}else{
				return response()->json([
				  'status'  => FALSE,
				  'message' => 'User not found!'
				]);
				
			}
		}else{
			return response()->json([
			  'status' => FALSE,
			  'message' => 'Not a valid API request!',
			]);
		}
	}

}