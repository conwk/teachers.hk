<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
		<!-- SheetStyle -->
        <link rel="stylesheet" href="{{ asset('/frontend/css/style.css?t=1.3') }}" />
        <link rel="stylesheet" href="{{ asset('/frontend/css/main/bulma.min.css') }}" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" ></script>
        <title>teacher.hk</title>
		<style>
			.section-otp{display:none;}
			.note-editor button{
				background-color:#fff!important; 
				font-size: 12px;
				font-weight: normal;
			}
			.note-editor.note-frame.card {
			   background: #f5f5f5;
			}
			.note-editor .card-header.note-toolbar {
			   max-width: 300px!important;
			   display:block;
			}
		</style>
    </head>
    <body>
        <div class="container is-widescreen">
			@if (isset($user->status) && $user->status == 1 && Illuminate\Support\Facades\Auth::check())
				 <header class="navbar py-5 px-6">
					<div class="container">
						<div class="columns is-mobile is-centered">
							<div class="column columns is-mobile is-vcentered is-flex-grow-0 box p-2 m-0">
								<div class="column is-flex-grow-0 p-0">
									<div class="dropdown is-hoverable">
										<div class="dropdown-trigger">
										  <button class="button icon-btn" aria-haspopup="true" aria-controls="dropdown-menu4">
											<span class="icon is-medium">
												<i class="fas fa-lg fa-bars" aria-hidden="true"></i>
												</span>
											</button>
										</div>
										<div class="dropdown-menu" id="dropdown-menu4" role="menu">
											<div class="dropdown-content">
												<div class="dropdown-item p-1">
													<div class="columns is-vcentered is-centered is-mobile">
														<div class="column is-3">
															<figure class="image is-48x48">
																@if(!empty($user->photo) && file_exists(public_path('/frontend/teacher/'.$user->photo)))
																<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/teacher/{{$user->photo}}">
																@else
																	<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/img/flatProfile.png">	
																@endif
																
																
															  </figure>
														</div>
														<div class="column is-6 ml-2">
															<h6 class="title is-6 m-0"><a style="color:#363636;" href="<?= URL::to('/'); ?>/profile">{{$user->first_name}}</a></h6>
															<p class="is-6">Teacher</p>
														</div>
													</div>
												</div>
												<hr class="dropdown-divider">
												<a class="dropdown-item" href="<?= URL::to('/'); ?>/profile">
													My Post
												</a>
												<a class="dropdown-item" href="<?= URL::to('/'); ?>/add-post">
													Add Post
												</a>
												<a class="dropdown-item" href="#">
												   Communication Center
												</a>
												<a class="dropdown-item" href="#">
												   Support Center
												</a>
												<a class="dropdown-item" href="<?= URL::to('/'); ?>/edit-profile">
													My Profile
												</a>
												<form action="{{ route('signOut') }}" method="POST">
												@csrf
												<button class="dropdown-item" style="background-color:#fff!important;">
													Logout
												</button>
												</form>	  
											</div>
										</div>
									</div>
							</div>
							<div class="column is-flex-grow-0 p-0">
								<div class="is-relative">
									<figure class="image is-32x32">
										@if(!empty($user->photo) && file_exists(public_path('/frontend/teacher/'.$user->photo)))
										<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/teacher/{{$user->photo}}">
										@else
											<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/img/flatProfile.png">	
										@endif
									</figure>
									  <span class="badge">0</span>
								</div>
							 </div>
						</div>
					</div>
				</div>
				 </header>
				 <hr class="dropdown-divider">				 
			@else	
			@php $action = Route::getCurrentRoute()->getActionName();	
			@endphp
			@if(strpos($action, '@view') !== false || strpos($action, '@profile_view') !== false)
				<!-- -->
			@else
				<header class="mt-6">
                <div class="columns is-mobile">
                    <div class="column is-2-desktop is-offset-5-desktop is-4-mobile is-offset-4-mobile is-3-tablet is-offset-5-tablet">
                        <img src="<?= URL::to('/'); ?>/frontend/img/logo.png" width="300" />
                    </div>
                </div>
            </header>
			@endif
			@endif
			@yield('content')	
			 
           <!-- <section class="mt-6 is-large">
                <div class="">
                    <div class="columns is-mobile is-justify-content-center">
                        <div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">
                           						
						</div>
                    </div>
                </div>
            </section> -->
            <footer class="footer has-background-white" style="padding: 1rem 1.5rem 6rem;">
                <div class="columns">
                    <div class="content has-text-centered column is-4 is-offset-4">
                        <p class="is-size-7">
                            By Continuing, you are confirming that you have read and agree to our <span class="colorChange">Terms and Conditions</span>, <span class="colorChange">Privacy Policy</span> and
                            <span class="colorChange">Cookie Policy</span>
                        </p>
                    </div>
                </div>
            </footer>
        </div>	
	
    </body>
</html>