<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

        <!-- SheetStyle -->
        <link rel="stylesheet" href="{{ asset('/frontend/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('/frontend/css/main/bulma.min.css') }}" />

        <title>Profile</title>
    </head>
    <body>
       <div class="container is-widescreen">
          <header class="mt-6">
        <div class="columns is-mobile">
            <div class="column is-2-desktop is-offset-5-desktop is-4-mobile is-offset-4-mobile is-3-tablet is-offset-5-tablet">
                 <img src="<?= URL::to('/'); ?>/frontend/img/logo.png" width="300" />
            </div>
        </div>
        </header>
        <section class="mt-6 is-large">
            <div class="">
                <div class="columns is-mobile is-justify-content-center">
                    <div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">
						@if ((empty($user->first_name)) && (empty($user->dob)) && $user->status == 0)
                        <progress class="progress is-small" value="70" max="100"></progress>
						@endif
						@if ($user->status == 1)
							<progress class="progress is-small" value="100" max="100"></progress>
						@endif
                        <div class="has-text-centered">
							@if ($user->status == 2)
								<progress class="progress is-small" value="100" max="100"></progress>
								<div class="mt-6">
									<div class="mt-3">
											<h6 class="subtitle is-6 has-text-weight-bold mt-3">{{$user->message}}</h6>
									</div>
								</div>								
							@endif
							@if ((!empty($user->first_name)) && (!empty($user->dob)) && $user->status == 0)
								<progress class="progress is-small" value="100" max="100"></progress>
								<div class="has-text-centered">									
										<div class="mt-6">
											<div class="mt-3">
												<h5 class="title is-6">You profile is under review.</h5>
												<h6 class="subtitle is-6 has-text-weight-bold mt-3">Update will notify you by SMS</h6>
											</div>
										</div>
										<div class="mt-4">
											<form id="logout-form" action="{{ route('signOut') }}" method="POST" style="display: none;">
												@csrf
											</form>		
											 <button class="button is-primary is-rounded is-fullwidth" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>											
																				
										</div>															  
								</div>				
							@else
                             <form action="{{ route('login.updateProfile') }}" method="post">
							@csrf
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
                                <div class="mt-6">
									<input type="text" class="input is-primary" name="first_name" placeholder="Full name as per HKID" value=	"{{isset($user->first_name) ? $user->first_name : old('first_name') }}">
									<span class="text-danger">@error('first_name'){{ $message }}@enderror</span>   
                                </div>
                                <div class="mt-2">
                                    <input class="input is-primary" name="dob" type="date" value = "{{isset($user->dob) ? $user->dob : old('dob') }}" placeholder="Date of Birth">
									<span class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                </div>
                                <div class="mt-2">
                                    <div class="field">
                                        <p class="control has-icons-left has-icons-right">
											<input type="text" class="input is-primary" name="email" placeholder="Enter email address" value="{{isset($user->email) ? $user->email : old('email') }}">
											<span class="text-danger">@error('email'){{ $message }}@enderror</span>
											<span class="icon is-small is-left">
												<i class="fas fa-envelope"></i>
											</span>
											<span class="icon is-small is-right">
												<i class="fas fa-check"></i>
											</span>
                                        </p>
                                      </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="button is-primary is-rounded is-fullwidth">Done</button>
                                </div>
                            </form>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <footer class="footer has-background-white" style="padding: 1rem 1.5rem 6rem;">
             <div class="columns">
                <div class="content has-text-centered column is-4 is-offset-4">
                    <p class="is-size-7">By Continuing, you are confirming that you have read and agree to our <span class="colorChange ">Terms and Conditions</span>, <span class="colorChange">Privacy Policy</span> and <span class="colorChange">Cookie Policy</span></p>
                </div>
                </div>
           
        </footer>
        </div>
    </body>
</html>
