@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <div class="container-fluid">
		<div class="row mb-2">
		  <div class="col-sm-6">
			<h1>Posts</h1>
		  </div>
		  <div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
			  <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item active">Edit Posts</li>
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
	<a class="btn btn-primary float-right" href="{{route('admin.posts')}}">View All</a><br><br>
	<div class="clearfix"></div>
	<form action="{{ route('admin.posts.update') }}" method="post">	
	@csrf
	@if(isset($post->id) && !empty($post->id))

		<input type="hidden" class="form-control" name="id" value="{{ $post->id }}">
	@endif		
	  
	<div class="card-body">
	<div class="row">

		<div class="col-md-12">         
			<div class="form-group">
				 <label for="name">Title</label>
				 <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $post->title }}">
				 <span class="text-danger">@error('title'){{ $message }}@enderror</span>
			 </div>
			<div class="form-group">
				<label>Category</label>
				<select id="categoryList" class="form-control" name="category_id" required>
					@foreach ($category as $key=>$categories)
						<option value="{{ $key }}" <?echo (($post->category_id == $key)?'selected':''); ?>>{{ $categories }}</option>
					@endforeach
				</select>
			</div>
			 <div class="form-group">
				 <label for="name">Content</label>
				  <textarea type="text" class="form-control" name="content" value="{{ $post->content }}"  placeholder="Content">{{ $post->content }}</textarea>
				 <span class="text-danger">@error('content'){{ $message }}@enderror</span>
			 </div>
			 <div class="form-group">
				 <label for="name">Tag</label>
				 <input type="text" class="form-control" name="tags" placeholder="Tag" value="{{ $post->tags }}">
				 <span class="text-danger">@error('tag'){{ $message }}@enderror</span>
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