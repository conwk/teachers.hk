
<?php $__env->startSection('content'); ?>
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
	<?php if(\Session::has('success')): ?>
	<div class="alert alert-success">
		<?php echo \Session::get('success'); ?>

	</div>
	<?php elseif(\Session::has('failed')): ?>
	<div class="alert alert-danger">
		<?php echo \Session::get('failed'); ?>

	</div>
	<?php endif; ?>
      <!-- Default box -->
      <div class="card">   
		<div class="card-header">
          <div class="card-tools">
		  <a class="btn btn-success float-right" href="<?php echo e(route('admin.category.add')); ?>">Add New</a><br><br>            
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
			<?php ($count=1); ?>
			<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
				<td><?php echo e($count); ?></td>		
				<td><?php echo e($categories->name); ?></td>					
				<td><?php echo e($categories->createdBy); ?></td>					
				<td id="status-<?php echo e($categories->id); ?>">
					<?php if($categories->status == 1): ?>
						<span class="badge badge-success">Approve</span>
					<?php elseif($categories->status == 2): ?>
						<span class="badge badge-secondary">Reject</span>
					<?php else: ?>
						<span class="badge badge-warning">Pending</span>							
					<?php endif; ?>		
				</td>
				<td>
				<select id="update_status_category" name="update_status_category" dataid ="<?php echo e($categories->id); ?>" class="form-control update_status_category">
						<option value="0" <?php echo (($categories->status == 0)?'selected':'') ?>>Pending</option>
						<option value="1" <?php echo (($categories->status == 1)?'selected':'') ?>>Approve</option>		
					 </select>
				</td>
				<td>
					
					<form action="<?php echo e(route('admin.category.destroy',$categories->id)); ?>" method="POST">     
						<a class="btn btn-primary" href="<?php echo e(route('admin.category.edit',$categories->id)); ?>">Edit</a>   
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
		<?php echo e($category->links()); ?>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/admin/category/index.blade.php ENDPATH**/ ?>