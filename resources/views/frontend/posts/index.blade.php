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
                     <!-- Default box -->
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
      <div class="card">   
		<div class="card-header">
          <div class="card-tools">
		  <a class="btn btn-success float-right" href="{{route('posts.add')}}">Add New</a><br><br>            
          </div>
        </div>	  
        <div class="card-body p-10">		
		<div class="clearfix"></div>
		<table id="users"  class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Sr. No</th>	
					<th>Title</th>					
					<th>Status</th>					
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@php($count=1)
			@foreach($posts as $post)
            <tr>
				<th>{{$count}}</th>		
				<th>{{$post->title}}</th>		
				<th id="status-{{$post->id}}">
					@if($post->status == 1)
						<span class="badge badge-success">Approve</span>					
					@else
						<span class="badge badge-warning">Pending</span>							
					@endif		
				</th>
				
				<td>
					<form action="{{ route('posts.destroy',$post->id) }}" method="POST">     
						<a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>   
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
		{{ $posts->links() }}
        </div>
        <!-- /.card-body -->
      </div>
      </section>

            </div>
        </div>
		
    </body>
	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</html>

