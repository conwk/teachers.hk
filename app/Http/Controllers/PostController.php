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
	
	
	public function home(Request $request)
    {
		$terms = explode(",", request('q'));
		$q = request('q');
		$posts = array();
		if(isset($q) && !empty($q)){			
			$posts = Post::query()	
			->where('status', 1)	
			->where(function ($query) use ($terms) {
				foreach ($terms as $term) {
					$query->orWhere('tags', 'like', '%' . $term . '%');
				}
			})
			->paginate(5);
			$posts->appends (array ('q' => $q));	
		}else{
			//$posts = Post::where('status', 1)->paginate(1);
        } 
		//$posts = Post::latest()->paginate(5); 
		return view('home',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);		
		
		
    }

    public function index()
    {	
	$user = Auth::user();		
        if(Auth::check()){		
		$user_id = Auth::user()->id;			
		$user = User::find($user_id);       
		$posts = Post::where('user_id', $user_id)->paginate(5);
        return view('post',compact('posts','user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
		}    
		return redirect("login")->withSuccess('You are not allowed to access');	
    }
   
	public function add()
    {
		$data = Post::select("title","tags")
		->where('status', 1)	
		->get()		
		->toArray();	
		$newArray = array();
		foreach($data as $datas){		
			$newTags = explode(',', $datas['tags']);	
			$newArray['val'][] = trim($datas['title']);		
			foreach($newTags as $newTag){		
				$newArray['val'][] = trim($newTag);	
			}	
		}		
		$newArrayUnique = array_unique($newArray['val']);
		$page = 'post';
		$user = Auth::user();		
        if(Auth::check()){		
			$user = User::find($user->id);       
			return view('post_add')->with(compact('user','newArrayUnique','page'));
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
		
		 
    }	
	
	public function edit($slug = null) {
		$data = Post::select("title","tags")
		->where('status', 1)	
		->get()		
		->toArray();	
		$newArray = array();
		foreach($data as $datas){		
			$newTags = explode(',', $datas['tags']);	
			$newArray['val'][] = trim($datas['title']);		
			foreach($newTags as $newTag){		
				$newArray['val'][] = trim($newTag);	
			}	
		}		
		$newArrayUnique = array_unique($newArray['val']);
		$page = 'post';
		$user = Auth::user();		
        if(Auth::check()){	
			 $post = Post::where('user_id', $user->id)
            ->Where('slug', $slug)
            ->firstOrFail();				
			$user = User::find($user->id);   
			return view('post_edit')->with(compact('user','post','newArrayUnique','page'));
		}    
		return redirect("login")->withSuccess('You are not allowed to access');
			
    }	
	
	public function update(Request $request, Post $post) {
	    $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]); 
		unset($request['files']);
		if($request->input('id') != null){				 
			$id = $request->input('id');		
			$post = Post::where('id',$id);
			$data = $request->except('_token');
			$post->update($data);			
			return redirect()->route('post')
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
			return view('post_view')->with(compact('user','post'));
		}else{
			return view('post_view_without_login')->with(compact('post'));
		}
		
			
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
		$user_id = Auth::user()->id;
		$post =Post::find($id);		
		if($user_id == $post->user_id){			
			$post->delete();						
			return redirect()->route('post')->with('success','Post deleted successfully');
		}else{	
			return redirect()->route('post')->with('success','Invalid User');		
		}
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
