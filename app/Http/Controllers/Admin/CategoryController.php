<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller {
	public function __construct()
    {
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $category = Category::latest()->paginate(5);    
        return view('admin.category.index',compact('category'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
	public function add(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
	
	
	public function edit($id = null) {
        $category = Category::find($id);
        return view('admin.category.edit')->with(compact('category'));
    }
	
	
	public function update(Request $request, Category $category) {
	    $request->validate([
            'name' => 'required|unique:post_categories|max:100',
            //'url' => 'required',
        ]); 
		
		if($request->input('id') != null){	
			//unset($request->input('_token'));
			$id = $request->input('id');
		
			$category = Category::where('id',$id);
			$data = $request->except('_token');
			$category->update($data);			
			 return redirect()->route('admin.category')
                        ->with('success','Category updated successfully.');
		}else{		
			Category::create($request->all());
			 return redirect()->route('admin.category')
                        ->with('success','Category created successfully.');
		}	 
       
    }
   
    public function destroy($id)
    {
		$category =Category::find($id);
        $category->delete();

        return redirect()->route('admin.category')
                        ->with('success','category deleted successfully');
    } 
  
  
  public function changeStatus(Request $request) {
		$status = $request->input('status');
		$dataId = $request->input('dataId');
		$category = Category::where('id','=', $dataId)->update(['status' => $status]);
		$result['category'] = $category;
		if($status == 1):
			$message = '<span class="badge badge-success">Approve</span>';
		else:
			$message = '<span class="badge badge-warning">Pending</span>';
		endif;		
		$result['message'] = $message;		
		return response()->json($result,200);		
    }
  
}
