<!DOCTYPE html><html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content=<?php echo e(csrf_token()); ?>>

    <title> Admin</title>
	
	<link rel="stylesheet" href="<?php echo e(asset('/admin/css/app.css')); ?>"></link>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/fontawesome-free/css/all.min.css')); ?>">
	<!-- Ionicons -->	
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/jqvmap/jqvmap.min.css')); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/dist/css/adminlte.min.css')); ?>">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/daterangepicker/daterangepicker.css')); ?>">
	<!-- summernote -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/summernote/summernote-bs4.css')); ?>">	
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">


</head>
<body class="hold-transition sidebar-mini layout-fixed"><?php if(auth()->guard("admin")->check()): ?> 
    <div class="wrapper" id="app">
        <!-- Header -->
    <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Sidebar -->
    <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->yieldContent('content'); ?>
        <!-- Footer -->
    <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- ./wrapper --><?php endif; ?>
    
    
</body>
</html><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/admin/layouts/master.blade.php ENDPATH**/ ?>