@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <div class="container-fluid">
		<div class="row mb-2">
		  <div class="col-sm-6">
			<h1>Categories</h1>
		  </div>
		  <div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
			  <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item active">Edit Categories</li>
			</ol>
		  </div>
		</div>
	  </div><!-- /.container-fluid -->
	</section>
	
	
	    <!-- Main content -->
    <section class="content">
	 @if (\Session::has('success'))
	<div class="alert alert-success">
		{!! \Session::get('success') !!}
	</div>
	@elseif(\Session::has('failed'))
	<div class="alert alert-danger">
		{!! \Session::get('failed') !!}
	</div>
	@endif
	<a class="btn btn-primary float-right" href="{{route('admin.category')}}">View All</a><br><br>
	<div class="clearfix"></div>
	<form action="{{ route('admin.category.update') }}" method="post">	
	@csrf
	@if(isset($category->id) && !empty($category->id))

		<input type="hidden" class="form-control" name="id" value="{{ $category->id }}">
	@endif		
	  
	<div class="card-body">
	<div class="row">
		<div class="col-md-12">         
			<div class="form-group">
				 <label for="name">Name</label>
				 <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{ $category->name }}">
				 <span class="text-danger">@error('name'){{ $message }}@enderror</span>
			 </div>
			
			
			<div class="form-group">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
    </div>
    </div>
	</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@endsection