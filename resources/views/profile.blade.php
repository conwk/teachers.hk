<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
            }

            .title {
                font-size: 14px;
				text-align: left;
				color:#000;
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
.card-header {
    color: #000;
    font-weight: bold;
}
   .input-group label {
    font-size: 17px;
    font-weight: bold;
    text-align: left;
}
			input {
				width: 300px;
				padding: 10px;
				margin-bottom: 20px;
			}

			button.btn.btn-primary.btn-block.btn-flat {
				font-size: 15px;
				padding: 10px 30px;
				margin-top: 10px;
			}
.form-group {
    display: grid;
	    margin-bottom: 1em;
}

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
                               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
                                </a>
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
                <div class="title m-b-md">
					@if ($user->status == 2)
					<div class="col-md-4 offset-md-4" style="margin-top: 45px">						
						<div class="alert alert-primary" role="alert">
						{{$user->message}}
						</div>
					</div>
					@endif
					<div class="col-md-4 offset-md-4" style="margin-top: 45px">
						 <h4>Profile</h4><hr>
						 @if ((!empty($user->first_name)) && (!empty($user->last_name)) && $user->status == 0)
								<div class="alert alert-primary" role="alert">
								  Thanks for submitting. your profile is under review
								</div>					
						@else
						 <form action="{{ route('login.updateProfile') }}" method="post">
							@if (Session::get('success'))
								<div class="alert alert-success">
									{{ Session::get('success') }}
								</div>
							@endif
							@if (Session::get('fail'))
							<div class="alert alert-danger">
								{{ Session::get('fail') }}
							</div>
							@endif

							@csrf
							 <div class="form-group">
								 <label for="name">Name</label>
								 <input type="text" class="form-control" name="first_name" placeholder="Enter First name" value="{{isset($user->first_name) ? $user->first_name : old('first_name') }}">
								 <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
							 </div> 
							 <div class="form-group">
								 <label for="name">Name</label>
								  <input type="text" class="form-control" name="last_name" placeholder="Enter Last name" value="{{isset($user->last_name) ? $user->last_name : old('last_name') }}">
								
								 <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
							 </div>
							 <div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{isset($user->email) ? $user->email : old('email') }}">
								<span class="text-danger">@error('email'){{ $message }}@enderror</span>
							</div>
							 <div class="form-group">
								 <button type="submit" class="btn btn-primary">Update</button>
							 </div>							
							
						 </form>
						 @endif
					</div>
     
                </div>

            </div>
        </div>
    </body>
</html>
