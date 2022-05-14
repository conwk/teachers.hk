<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Validator;

class SearchController extends Controller
{
   public function __construct()
    {
		if(!Auth::check()){
	        return view('auth.login');
	    }       
    } 
    
    public function index()
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
		$terms = explode(",", request('q'));
		$q = request('q');
		$posts = array();
		if(isset($q) && !empty($q)){	
			$posts = Post::query()	
			->where('status', 1)	
			->where(function ($query) use ($terms) {
				foreach ($terms as $term) {
					$query->orWhere('title', 'like', '%' . $term . '%');
					$query->orWhere('tags', 'like', '%' . $term . '%');
					
				}
			})
		/* 	->orWhere(function ($query) use ($terms) {
				foreach ($terms as $term) {
					$query->orWhere('title', 'like', '%' . $term . '%');
				}
			}) */
			->paginate(5);
			$posts->appends (array ('q' => $q));	
			//print_R($posts );
		}
		$dataTag = Post::select("tags")->where('status', 1)->get()->toArray();
		return view('search',compact('newArrayUnique','posts','dataTag'))
            ->with('i', (request()->input('page', 1) - 1) * 5);		
    }
	
    public function autocomplete(Request $request)
    {

        	$q = request('term');
        $data = Post::select("tags")
                ->where('tags', 'like', '%' . $q . '%')
                ->get();
   
        return response()->json($data);
    }

}
