@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
	  <div class="container-fluid">
		<div class="row mb-2">
		  <div class="col-sm-6">
			<h1>Users</h1>
		  </div>
		  <div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">	
			  <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item active">Edit Users</li>
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
	<a class="btn btn-primary float-right" href="{{route('users')}}">View All</a><br><br>
	{!!Form::model($users, ['action' => ['admin\UsersController@update',$users->id],'method' => 'PUT', 'files' => true, 'novalidate' => 'novalidate',]) !!}	
	<div class="card-body">
		<div class="row"> 
			<div class="col-md-6">         
				<div class="form-group">
					 <label for="Name">Image:</label>
					{{ Form::file('image', ['class'=>'form-control' , 'autocomplete'=>'off']) }} 
					 <span class="text-danger">{{ $errors->first('image') }}</span>
				</div>
			</div>	
			<div class="col-md-6"> 
<?= URL::to('/'); ?>			
				<?php 
				
	echo '<pre>';
		print_r($users->image);
	echo '</pre>';
	?>
			</div>
       
			<div class="col-md-4">         
				<div class="form-group">
					<label for="comapny_name">Company Name:</label>
					{{Form:: text('comapny_name', $value = null,['class'=>'form-control' , 'autocomplete'=>'off'])}}
					<span class="text-danger">{{ $errors->first('comapny_name') }}</span>
				</div>
			</div>
			<div class="col-md-4">        
				<div class="form-group">
					 <label for="Number">Company Type : </label> 
					{{ Form::select('company_id', [
					   ' '=>'Select',
					   '1' => 'Draft',
					   '2' => 'Publish',
					   ],
					   null,
					   ['class'=>'form-control' , 'autocomplete'=>'off']
					) }}
					 <span class="text-danger">{{ $errors->first('company_id') }}</span>
				</div>
			</div>		
			
			<div class="col-md-4">        
				<div class="form-group">
					 <label for="sufficient">Only one is sufficient : </label> 
					{{ Form::select('sufficient', [
					   ' '=>'Select',
					   'owner' => 'Owner',
					   'partner' => 'partner',
					   'Director Name' => 'Director Name',
					   ],
					   null,
					   ['class'=>'form-control' , 'autocomplete'=>'off']
					) }}
					 <span class="text-danger">{{ $errors->first('sufficient') }}</span>
				</div>
			</div>
        
			<div class="col-md-4">         
				<div class="form-group">
					<label for="Name">Name:</label>
					{{Form:: text('name', $value = null,['class'=>'form-control' , 'autocomplete'=>'off'])}}
					<span class="text-danger">{{ $errors->first('name') }}</span>
				</div>
			</div>
			
			<div class="col-md-4">         
				<div class="form-group">
					<label for="Email">Email:</label>
					{!! Form::email('email', $value = null, ['class' => 'form-control','readonly']) !!}
					<span class="text-danger">{{ $errors->first('email') }}</span>
				</div>
			</div>
			
			<div class="col-md-4">         
				<div class="form-group">
					<label for="Name">Mobile:</label>
					{{Form:: text('mobile_num', $value = null,['class'=>'form-control' , 'autocomplete'=>'off'])}}
					<span class="text-danger">{{ $errors->first('mobile_num') }}</span>
				</div>
			</div>	
			
			<div class="col-md-4">         
				<div class="form-group">
					<label for="Name">Whatsapp Number:</label>
					{{Form:: text('whatsapp_number', $value = null,['class'=>'form-control' , 'autocomplete'=>'off'])}}
					<span class="text-danger">{{ $errors->first('whatsapp_number') }}</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">        
				<div class="form-group">
					 <label for="country_id">Country : </label> 
					{{ Form::select('country_id', [
					   ' '=>'Select',
					   '101' => 'India',
					  ],
					   null,
					   ['class'=>'form-control' , 'autocomplete'=>'off']
					) }}
					 <span class="text-danger">{{ $errors->first('country_id') }}</span>
				</div>
			</div>			
			
			<div class="col-md-4">        
				<div class="form-group">
					 <label for="state_id">State : </label> 
					{{ Form::select('state_id', [
					   ' '=>'Select',
					   '101' => 'India',
					  ],
					   null,
					   ['class'=>'form-control' , 'autocomplete'=>'off']
					) }}
					 <span class="text-danger">{{ $errors->first('state_id') }}</span>
				</div>
			</div>		
			
			<div class="col-md-4">        
				<div class="form-group">
					 <label for="city_id">City : </label> 
					{{ Form::select('city_id', [
					   ' '=>'Select',
					   '101' => 'India',
					  ],
					   null,
					   ['class'=>'form-control' , 'autocomplete'=>'off']
					) }}
					 <span class="text-danger">{{ $errors->first('city_id') }}</span>
				</div>
			</div>
			<div class="col-md-12">         
				<div class="form-group">
					<label for="full_address">Full Address:</label>
					{{Form:: text('full_address', $value = null,['class'=>'form-control' , 'autocomplete'=>'off'])}}
					<span class="text-danger">{{ $errors->first('full_address') }}</span>
				</div>
			</div>	
			<div class="col-md-12">         
				<div class="form-group">
					<label for="gst_number">GST Number:</label>
					{{Form:: text('gst_number', $value = null,['class'=>'form-control' , 'autocomplete'=>'off'])}}
					<span class="text-danger">{{ $errors->first('gst_number') }}</span>
				</div>
			</div>
			<div class="col-md-6">        
				<div class="form-group">
					 <label for="status">Status : </label> 
					{{ Form::select('status', [
					   ' '=>'Select',
					   'draft' => 'Draft',
					   'pending' => 'Pending',
					   'approved' => 'Publish',
					   ],
					   null,
					   ['class'=>'form-control' , 'autocomplete'=>'off']
					) }}
					 <span class="text-danger">{{ $errors->first('status') }}</span>
				</div>
			</div>		

			<div class="col-md-6">        
				<div class="form-group">
					 <label for="Number">User Type : </label> 
					{{ Form::select('type', [
					   ' '=>'Select',
					   'admin' => 'Admin',
					   'seller' => 'Seller',
					   'buyer' => 'Buyer',
					   ],
					   null,
					   ['class'=>'form-control' , 'autocomplete'=>'off']
					) }}
					 <span class="text-danger">{{ $errors->first('type') }}</span>
				</div>
			</div>		
		</div>          
		<div class="row"> 	
			<div class="col-md-12">      		
				<div class="form-group">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
		</div>
    </div>
    </div>
	{!! Form::close() !!}
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
	