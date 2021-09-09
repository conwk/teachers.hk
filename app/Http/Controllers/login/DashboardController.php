<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	
	public function __construct()
    {
		$this->middleware('auth');
    }

    public function index()
    {
		//$this->middleware('auth');
		$data = array("Test");
		return view('admin.dashboard.index', $data);       
    }
   
}
