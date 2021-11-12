<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Validator;

class PostController extends Controller {
	public function __construct()
    {
		if(!Auth::check()){
	        return view('auth.login');
	    }       
    } 

    public function index()
    {	
		$user_id = Auth::user()->id;	
		$posts = Post::where('createdBy', $user_id)->paginate(5);
        return view('post',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
	public function add()
    {
		$user = Auth::user();		
        if(Auth::check()){		
			$user = User::find($user->id);       
			return view('post_add')->with(compact('user'));;
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
		
		 
    }	
	
	public function edit($id = null) {
		
		$user = Auth::user();		
        if(Auth::check()){		
			$user = User::find($user->id);   
			$post = Post::find($id);
			return view('post_add')->with(compact('user','post'));
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
			
    }	
	
	public function update(Request $request, Post $post) {
	    $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]); 
		
		if($request->input('id') != null){	
			//unset($request->input('_token'));
			$id = $request->input('id');
		
			$post = Post::where('id',$id);
			$data = $request->except('_token');
			$post->update($data);			
			return redirect()->route('profile')
                        ->with('success','Post updated successfully.');
		}else{
			$user_id = Auth::user()->id;
			$data = $request->except('_token');
			$data['user_id'] = $user_id; 
			Post::create($data);
			 return redirect()->route('profile')
                        ->with('success','Post created successfully.');
		}	 
       
    }
	
	public function view($slug = null) {
		
		$user = Auth::user();
		$post = Post::where('slug',$slug)->first();				
        if(Auth::check()){		
			$user = User::find($user->id);   
		}else{
			$user = User::find($post->user_id);
		}  
		return view('post_view')->with(compact('user','post'));
			
    }	
	
	
   
   public function category(Request $request){
	      $validator = Validator::make($request->all(),[
            'name' => 'required|unique:post_categories|max:100',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
    
        $input = $request->all();
        Category::create($input);        
        return response()->json(['success'=>'Category saved successfully.']);
   }
   
    public function destroy($id)
    {
		$post =Post::find($id);
        $post->delete();

        return redirect()->route('posts')
                        ->with('success','Post deleted successfully');
    }  

	public function changeStatus(Request $request) {
		$status = $request->input('status');
		$dataId = $request->input('dataId');
		$post = Post::where('id','=', $dataId)->update(['status' => $status]);
		$result['post'] = $post;
		if($status == 1):
			$message = '<span class="badge badge-success">Approve</span>';
		else:
			$message = '<span class="badge badge-warning">Pending</span>';
		endif;		
		$result['message'] = $message;		
		return response()->json($result,200);		
    }

}
