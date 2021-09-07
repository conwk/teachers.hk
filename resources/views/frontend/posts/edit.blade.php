<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
				width:700px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
input {    padding: 10px;    margin-bottom: 1em;    width: 100%;}
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->first_name }} <span class="caret"></span></a>								
							<a class="dropdown-item" href="/dashboard">  
							{{ __('Dashboard') }}       
							</a>								
							<a class="dropdown-item" href="{{ route('profile') }}">      
							{{ __('Profile') }}                           
							</a>
							<a class="dropdown-item" href="{{ route('posts') }}">      
							{{ __('Post') }}                           
							</a>

                               
                                    <a class="dropdown-item" href="{{ route('signOut') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('signOut') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
	
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
	<a class="btn btn-primary float-right" href="{{route('posts')}}">View All</a><br><br>
	<div class="clearfix"></div>
	<form action="{{ route('posts.update') }}" method="post">	
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
			<!--<div class="form-group">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addCategoryByUserPopup">Add Category</button>
			</div>-->
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
        </div>
		<div id="addCategoryByUserPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  <form method="post" id="addCategoryByUser">
	   @csrf
		  <div class="form-group">
			<label for="messageUser">Category</label>
			<input type="text" class="form-control" name="name" id="categories" rows="3" required>
		  </div>
		   <div class="form-group">
		   <button type="submit" class="btn btn-default">Submit</button>
		     </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    </body>
	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"  crossorigin="anonymous"></script>

<script>

 $('#addCategoryByUser').on('submit', function (e) {
	 $('.alert').remove();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
  e.preventDefault();

  $.ajax({
	type: 'post',
	url:'category',
	data: $(this).serialize(),
	dataType: 'json',
	success: function (data) {
	 if(data.status == false){	
			$('#addCategoryByUser').prepend('<div class="alert alert-danger" role="alert">'+data.error+'</div>');
			//$('#status-'+data.userId).html(data.message);
		}else{
			$('#addCategoryByUser').prepend('<div class="alert alert-success" role="alert">'+data.success+'</div>');
		}
	}
  });

});</script>

</html>
