<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class PostsController extends Controller {	
	public function __construct()
    {
		$this->middleware('auth:admin');    
	} 
    public function index(){
		$posts = Post::latest()->paginate(5);
		return view('admin.posts.index',compact('posts')) 
		->with('i', (request()->input('page', 1) - 1) * 5);    
	}
 
	public function add(Post $post){
	/* 	$data = Post::select("title","tags")
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
		$newArrayUnique = array_unique($newArray['val']);	 */	
		return view('admin.posts.edit', [	
			'post' => $post,		
			'category' => Category::all()->pluck('name', 'id'),   	
			//'newArrayUnique' => $newArrayUnique,	
		]);        
		//return view('admin.posts.edit', compact('post'));   
		}	
	
	public function edit($id = null) {
        $post = Post::find($id);
         return view('admin.posts.edit', [
            'post' => $post,
            'category' => Category::all()->pluck('name', 'id'),          
        ]);
		//return view('admin.posts.edit')->with(compact('post'));
    }	
	
	public function update(Request $request, Post $post) {
	    $request->validate([
            //'title' => 'required',
            //'url' => 'required',
        ]); 
		
		if($request->input('id') != null){	
			//unset($request->input('_token'));
			$id = $request->input('id');
		
			$post = Post::where('id',$id);
			$data = $request->except('_token');
			$post->update($data);			
			 return redirect()->route('admin.posts')
                        ->with('success','Post updated successfully.');
		}else{		
			//$request->except('name');
			Post::create($request->all());
			 return redirect()->route('admin.posts')
                        ->with('success','Post created successfully.');
		}	 
       
    }
   
    public function destroy($id)
    {
		$post =Post::find($id);
        $post->delete();

        return redirect()->route('admin.posts')
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
