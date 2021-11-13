
<?php $__env->startSection('content'); ?>
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
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active">Users</li>
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
        <div class="card-body p-10">		
		<div class="clearfix"></div>
		<table id="users"  class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Id</th>					
					<th>First Name</th>					
					<th>Last Name</th>
					<th>Mobile</th>
					<th>Status</th>
					<th></th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($user->id); ?></td>					
					<td><?php echo e($user->first_name); ?></td>					
					<td><?php echo e($user->last_name); ?></td>
					<td><?php echo e($user->mobile); ?></td>
					<td id="status-<?php echo e($user->id); ?>">
						<?php if($user->status == 1): ?>
							<span class="badge badge-success">Approve</span>
						<?php elseif($user->status == 2): ?>
							<span class="badge badge-secondary">Reject</span>
						<?php else: ?>
							<span class="badge badge-warning">Pending</span>							
						<?php endif; ?>	
					</td>
					<td>
						<select id="update_status_user" name="update_status_user" dataid ="<?php echo e($user->id); ?>" class="form-control update_status_user">
							<option value="0" <?php echo (($user->status == 0)?'selected':'') ?>>Pending</option>
							<option value="1" <?php echo (($user->status == 1)?'selected':'') ?>>Approve</option>
							<option value="2" <?php echo (($user->status == 2)?'selected':'') ?>>Reject</option>
						 </select>
					</td>
					<td>
					<form action="<?php echo e(route('admin.users.destroy',$user->id)); ?>" method="POST">   
						<?php echo csrf_field(); ?>
						<?php echo method_field('DELETE'); ?>
						<button type="submit" class="btn btn-danger">Delete</button>
					</form>
				</td>
            </tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			</tbody>
		</table>	
		
        </div>
		<div class="card-body p-10">	
		<?php echo e($users->links()); ?>

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


<div id="rejectMessage" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	  <form method="post" id="userMessageForm">
	   <?php echo csrf_field(); ?>
		 <input type="hidden" name="userID" id="userID" value="">
		 <input type="hidden" name="userStatus" id="userStatus" value="">
         <div class="form-group">
			<label for="messageUser">Message</label>
			<textarea class="form-control" name="messageUser" id="messageUser" rows="3" required></textarea>
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\XAMPP\htdocs\teacher\resources\views/admin/users/index.blade.php ENDPATH**/ ?>