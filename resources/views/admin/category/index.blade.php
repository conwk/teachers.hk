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
              <li class="breadcrumb-item"><a href="#">Category</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
      <!-- Default box -->
      <div class="card">   
		<div class="card-header">
          <div class="card-tools">
		  <a class="btn btn-success float-right" href="{{route('admin.category.add')}}">Add New</a><br><br>            
          </div>
        </div>	  
        <div class="card-body p-10">		
		<div class="clearfix"></div>
		<table id="users"  class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Sr. No</th>		
					<th>Name</th>
					<th>User</th>
					<th>Status</th>
					<th></th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@php($count=1)
			@foreach($category as $categories)
            <tr>
				<td>{{$count}}</td>		
				<td>{{$categories->name}}</td>					
				<td>{{$categories->createdBy}}</td>					
				<td id="status-{{$categories->id}}">
					@if($categories->status == 1)
						<span class="badge badge-success">Approve</span>
					@elseif($categories->status == 2)
						<span class="badge badge-secondary">Reject</span>
					@else
						<span class="badge badge-warning">Pending</span>							
					@endif		
				</td>
				<td>
				<select id="update_status_category" name="update_status_category" dataid ="{{$categories->id}}" class="form-control update_status_category">
						<option value="0" <?php echo (($categories->status == 0)?'selected':'') ?>>Pending</option>
						<option value="1" <?php echo (($categories->status == 1)?'selected':'') ?>>Approve</option>		
					 </select>
				</td>
				<td>
					
					<form action="{{ route('admin.category.destroy',$categories->id) }}" method="POST">     
						<a class="btn btn-primary" href="{{ route('admin.category.edit',$categories->id) }}">Edit</a>   
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</td>
            </tr>
			@php($count++)
			@endforeach
			
			</tbody>
		</table>
        </div>
		<div class="card-body p-10">	
		{{ $category->links() }}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
@endsection