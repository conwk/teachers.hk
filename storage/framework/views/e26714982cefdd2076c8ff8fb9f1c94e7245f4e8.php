<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
		<!-- SheetStyle -->
        <link rel="stylesheet" href="<?php echo e(asset('/frontend/css/style.css?t=1.3')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('/frontend/css/main/bulma.min.css')); ?>" />
        <!--<link rel="stylesheet" href="<?php echo e(asset('/frontend/css/bootstrap-tagsinput.css')); ?>" />-->
		<?php if(isset($page) && $page == 'post'): ?>
			<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
			<link rel="stylesheet" href="<?php echo e(asset('/frontend/css/amsify.suggestags.css')); ?>" />
			<script src="<?php echo e(asset('/frontend/js/jquery.amsify.suggestags.js')); ?>"></script>
		<?php else: ?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<?php endif; ?>		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" ></script>
		<!--<script src="<?php echo e(asset('/frontend/js/bootstrap-tagsinput.js')); ?>" defer></script>-->
	
		<script src="<?php echo e(asset('/frontend/js/app.js')); ?>" defer></script>
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
        	<?php if(isset($user->status) && $user->status == 1 && Illuminate\Support\Facades\Auth::check()): ?>
        <!-- show menu button tablet -->
        <header class="is-hidden-tablet ">
         <div class="container m-2 ">
             <button class="button is-danger is-small showMenuBtn" >Show Menu</button>
         </div>
         <hr class="dropdown-divider"> 
     </header>
     <!-- body content -->
     <div id="body-content" class="is-relative">
     
         <!-- show menu click body overlay -->
      <div id="overlay" class="body-overlay"></div>
      <div class="columns">
          <div class="column is-narrow ">
              <!-- side bar left -->
      <div class="is-widescreen body-menu is-relative">
          <aside class=" menu-d menu" >
            <div class="menu-label menu-profile-item">
                    <div class="menu-profile-item-strong">
                        <div class="columns is-vcentered is-centered is-mobile">
                            <div class="column is-3">
                                	<figure class="image is-48x48">
																<?php if(!empty($user->photo) && file_exists(public_path('/frontend/teacher/'.$user->photo))): ?>
																<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/teacher/<?php echo e($user->photo); ?>">
																<?php else: ?>
																	<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/img/flatProfile.png">	
																<?php endif; ?>
																
																
															  </figure>
                            </div>
                            <div class="column is-7">
                               	<h6 class="title is-6 m-0"><a style="color:#363636;" href="<?= URL::to('/'); ?>/profile"><?php echo e($user->first_name); ?></a></h6>
															<p class="is-6">Teacher</p>
                            </div>
                        </div>
                        <hr class="dropdown-divider">
                        <span class="menu-profile-item-span">&#x2022;</span>
                    </div>
     
            </div>
            
            <style>
                .logbtn
                {
                    margin-left:1.25rem;
                }
                @media(max-width:468px)
                {
                   .logbtn
                {
                    margin-left:0rem;
                } 
                }
            </style>
            <ul class="menu-list">
                 <li class="is-relative" ><a href="<?= URL::to('/'); ?>/dashboard" class="menu-item"><strong class="menu-item-strong">Home</strong> <span class="menu-item-span ">&#x2022;</span></a></li>
              <li class="is-relative" ><a href="<?= URL::to('/'); ?>/my-post" class="menu-item"><strong class="menu-item-strong">Posts</strong> <span class="menu-item-span ">&#x2022;</span></a></li>
              <li class="is-relative" ><a href="<?= URL::to('/'); ?>/profile" class="menu-item"><strong class="menu-item-strong">Profile</strong> <span class="menu-item-span ">&#x2022;</span></a></li>
			  <li class="is-relative" ><a href="<?= URL::to('/'); ?>/message" class="menu-item"><strong class="menu-item-strong">Message</strong> <span class="menu-item-span ">&#x2022;</span></a></li>
              <li class="is-relative" >	<form action="<?php echo e(route('signOut')); ?>" method="POST">
												<?php echo csrf_field(); ?>
												<button class="menu-item logbtn" style="background-color:#fff!important; padding: 0.5em 0.75em;border: none;">
												<strong class="menu-item-strong">Logout</strong>
												</button>
												</form>	  </li>
            </ul>
          </aside>
      </div>
          </div>
        </div>
        
        
    <!-- ***************************************************  -->
         <div class="column"> <!-- body view section, footer and so on -->
             <div class="container is-widescreen body-ViewContent" id="content">
		
				
				 <hr class="dropdown-divider">				 
			<?php else: ?>	
			<?php $action = Route::getCurrentRoute()->getActionName();	
			?>
			<?php if(strpos($action, '@view') !== false || strpos($action, '@profile_view') !== false): ?>
				<!-- -->
			<?php else: ?>
				<header class="mt-6">
                <div class="columns is-mobile">
                    <div class="column is-2-desktop is-offset-5-desktop is-4-mobile is-offset-4-mobile is-3-tablet is-offset-5-tablet">
                        <img src="<?= URL::to('/'); ?>/frontend/img/logo.png" width="300" />
                    </div>
                </div>
            </header>
			<?php endif; ?>
			<?php endif; ?>
			<?php echo $__env->yieldContent('content'); ?>	
			 
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
        </div>
        </div>
	
        <script>
	$(document).ready(function () {

$('.showMenuBtn').click(function() {
        $('.menu-d').toggleClass('is-active');
        $('.body-overlay').toggleClass('is-active');
        $('body').toggleClass('is-active');
    });
    function closeAll() {
        $('.menu-d').removeClass('is-active');
        $('.body-overlay').removeClass('is-active');
        $('body').removeClass('is-active');
    }
    $('.body-overlay,.menu-item').click(function(){
       closeAll();
    });
    
});
</script>
    </body>
</html><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/layouts/new.blade.php ENDPATH**/ ?>