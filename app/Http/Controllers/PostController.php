<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
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
        return view('frontend.posts.index',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
	public function add(Post $post)
    {
		 return view('frontend.posts.edit', [
            'post' => $post,
            'category' => Category::all()->pluck('name', 'id'),          
        ]);
    }	
	
	public function edit($id = null) {
        $post = Post::find($id);
         return view('frontend.posts.edit', [
            'post' => $post,
            'category' => Category::all()->pluck('name', 'id'),          
        ]);		
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
			 return redirect()->route('posts')
                        ->with('success','Post updated successfully.');
		}else{
			$user_id = Auth::user()->id;	
			$request['createdBy']	= $user_id; 
			$request->except('name');
			Post::create($request->all());
			 return redirect()->route('posts')
                        ->with('success','Post created successfully.');
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
