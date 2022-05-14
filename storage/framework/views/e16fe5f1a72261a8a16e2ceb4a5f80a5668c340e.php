<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><?php echo e(Auth::user()->first_name); ?> <span class="caret"></span></a>								
							<a class="dropdown-item" href="/dashboard">  
							<?php echo e(__('Dashboard')); ?>       
							</a>								
							<a class="dropdown-item" href="<?php echo e(route('profile')); ?>">      
							<?php echo e(__('Profile')); ?>                           
							</a>
							<a class="dropdown-item" href="<?php echo e(route('posts')); ?>">      
							<?php echo e(__('Post')); ?>                           
							</a>

                               
                                    <a class="dropdown-item" href="<?php echo e(route('signOut')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('signOut')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                     <!-- Default box -->
					  <section class="content">
	<?php if(\Session::has('success')): ?>
	<div class="alert alert-success">
		<?php echo \Session::get('success'); ?>

	</div>
	<?php elseif(\Session::has('failed')): ?>
	<div class="alert alert-danger">
		<?php echo \Session::get('failed'); ?>

	</div>
	<?php endif; ?>
      <div class="card">   
		<div class="card-header">
          <div class="card-tools">
		  <a class="btn btn-success float-right" href="<?php echo e(route('posts.add')); ?>">Add New</a><br><br>            
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
			<?php ($count=1); ?>
			<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
				<th><?php echo e($count); ?></th>		
				<th><?php echo e($post->title); ?></th>		
				<th id="status-<?php echo e($post->id); ?>">
					<?php if($post->status == 1): ?>
						<span class="badge badge-success">Approve</span>					
					<?php else: ?>
						<span class="badge badge-warning">Pending</span>							
					<?php endif; ?>		
				</th>
				
				<td>
					<form action="<?php echo e(route('posts.destroy',$post->id)); ?>" method="POST">     
						<a class="btn btn-primary" href="<?php echo e(route('posts.edit',$post->id)); ?>">Edit</a>   
						<?php echo csrf_field(); ?>
						<?php echo method_field('DELETE'); ?>
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</td>
            </tr>
			<?php ($count++); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			</tbody>
		</table>
        </div>
		<div class="card-body p-10">	
		<?php echo e($posts->links()); ?>

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

<?php /**PATH F:\XAMPP\htdocs\teacher\resources\views/frontend/posts/index.blade.php ENDPATH**/ ?>