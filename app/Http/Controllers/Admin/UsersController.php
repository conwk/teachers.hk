<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class UsersController extends Controller {
	public function __construct()
    {
		$this->middleware('auth:admin');
    }

	/* Index */	
   
    public function index() {
		$users = User::latest()->paginate(10);    
        return view('admin.users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
		/* $users = User::all();
        return view('admin.users.index', compact('users')); */
    }
	public function changeStatus(Request $request) {
		$basic  = new \Nexmo\Client\Credentials\Basic($_ENV['SMS_API_KEY'], $_ENV['SMS_API_SECRET']);
        $client = new \Nexmo\Client($basic);
		$userStatus = $request->input('userStatus');
		$dataId = $request->input('dataId');
		$user = User::where('id','=', $dataId)->update(['status' => $userStatus]);
		$result['user'] = $user;
		$users = User::where('id', '=', $dataId)->first();
		if($userStatus == 1):
			$response = $client->message()->send([
				'to' => $_ENV['MOBILE_EXTENSION'].$users->mobile,
				'from' => 'LMS',
				'text' => 'Your Profile is Approve'
			]);	
			$message = '<span class="badge badge-success">Approve</span>';
		elseif($userStatus == 2):
			$response = $client->message()->send([
				'to' => $_ENV['MOBILE_EXTENSION'].$users->mobile,
				'from' => 'LMS',
				'text' => 'Your Profile is Reject'
			]);	
			$message = '<span class="badge badge-secondary">Reject</span>';
		else:
			$message = '<span class="badge badge-warning">Pending</span>';
		endif;		
		$result['message'] = $message;		
		return response()->json($result,200);		
    }
	
	public function sendMessage(){
		$basic  = new \Nexmo\Client\Credentials\Basic($_ENV['SMS_API_KEY'], $_ENV['SMS_API_SECRET']);
        $client = new \Nexmo\Client($basic);
		$result = [];
		if(isset($_POST) && !empty($_POST)){
			 $userID = $_POST['userID'];
			 $userStatus = $_POST['userStatus'];
			 $messageUser = $_POST['messageUser'];
			 $users = User::where('id', '=', $userID)->first();
			 if($users != null){
				 $response = $client->message()->send([
					'to' => $_ENV['MOBILE_EXTENSION'].$users->mobile,
					'from' => 'LMS',
					'text' => $messageUser,
				]);	
				 $user = User::where('id','=', $users->id)->update(['status' => $userStatus,'message' => $messageUser]);
				 $result['userId'] = $users->id;
				 $result['status'] = true;
				 $message = '<span class="badge badge-secondary">Reject</span>';
			 }else{
				 $result['status'] = false;
				 $message = "User does not exist";
			 }
			$result['message'] = $message;		
			return response()->json($result,200);
			//[messageUser] => fsfasf
		}		
		die;
	}
	
	
	 public function destroy($id)
    {
		$user =User::find($id);
        $user->delete();

        return redirect()->route('admin.users')
                        ->with('success','User deleted successfully');
    }  
	
}
