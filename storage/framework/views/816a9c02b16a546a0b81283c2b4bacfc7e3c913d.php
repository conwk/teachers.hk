
<?php $__env->startSection('content'); ?>
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
	 <?php if(\Session::has('success')): ?>
	<div class="alert alert-success">
		<?php echo \Session::get('success'); ?>

	</div>
	<?php elseif(\Session::has('failed')): ?>
	<div class="alert alert-danger">
		<?php echo \Session::get('failed'); ?>

	</div>
	<?php endif; ?>
	<a class="btn btn-primary float-right" href="<?php echo e(route('admin.posts')); ?>">View All</a><br><br>
	<div class="clearfix"></div>
	<form action="<?php echo e(route('admin.posts.update')); ?>" method="post">	
	<?php echo csrf_field(); ?>
	<?php if(isset($post->id) && !empty($post->id)): ?>

		<input type="hidden" class="form-control" name="id" value="<?php echo e($post->id); ?>">
	<?php endif; ?>		
	  
	<div class="card-body">
	<div class="row">

		<div class="col-md-12">         
			<div class="form-group">
				 <label for="name">Title</label>
				 <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo e($post->title); ?>">
				 <span class="text-danger"><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
			 </div>
			<div class="form-group">
				<label>Category</label>
				<select id="categoryList" class="form-control" name="category_id" required>
					<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($key); ?>" <?echo (($post->category_id == $key)?'selected':''); ?>><?php echo e($categories); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
			 <div class="form-group">
				 <label for="name">Content</label>
				  <textarea type="text" class="form-control" name="content" value="<?php echo e($post->content); ?>"  placeholder="Content"><?php echo e($post->content); ?></textarea>
				 <span class="text-danger"><?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
			 </div>
			 <div class="form-group">
				 <label for="name">Tag</label>
				 <input type="text" class="form-control" name="tags" placeholder="Tag" value="<?php echo e($post->tags); ?>">
				 <span class="text-danger"><?php $__errorArgs = ['tag'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/admin/posts/edit.blade.php ENDPATH**/ ?>