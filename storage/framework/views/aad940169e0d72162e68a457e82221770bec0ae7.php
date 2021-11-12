<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
	
    <a href="index3.html" class="brand-link">
    <img src="<?= URL::to('/'); ?>/admin/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">LMS</span>
</a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= URL::to('/'); ?>/admin/img/profile.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> 					<?php if(auth()->guard("admin")->check()): ?>					Admin					<?php endif; ?>				</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <li class="nav-item has-treeview menu-open">
				<a href="#" class="nav-link active">
				  <i class="nav-icon fas fa-tachometer-alt"></i>
				  <p>
					Dashboard
					<i class="right fas fa-angle-left"></i>
				  </p>
				</a>		
			
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					<a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link active">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Dashboard</p>
					</a> 
				  </li>
				  <li class="nav-item">
					 <a href="<?php echo e(route('admin.users')); ?>" class="nav-link">
						 <i class="nav-icon fa fas fa-circle-notch text-info"></i>
						<p>All Users</p>
					</a>
				</li>	
				
				<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-chart-pie"></i>
					<p>
						Category
						<i class="right fa fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						 <a href="<?php echo e(route('admin.category')); ?>" class="nav-link">
							<i class="fa fa-circle-o nav-icon"></i>
							<p>All Category</p>
						</a>
					</li>
					<li class="nav-item">
						 <a href="<?php echo e(route('admin.category.add')); ?>" class="nav-link">
							<i class="fa fa-circle-o nav-icon"></i>
							<p>Add New</p>
						</a>
					</li>				
				</ul>
			</li>

			<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-chart-pie"></i>
					<p>
						Posts
						<i class="right fa fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						 <a href="<?php echo e(route('admin.posts')); ?>" class="nav-link">
							<i class="fa fa-circle-o nav-icon"></i>
							<p>All Posts</p>
						</a>
					</li>
					<li class="nav-item">
						 <a href="<?php echo e(route('admin.posts.add')); ?>" class="nav-link">
							<i class="fa fa-circle-o nav-icon"></i>
							<p>Add New</p>
						</a>
					</li>				
				</ul>
			</li>	
				
				</ul>
			</li>	
		
				
	
			

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>