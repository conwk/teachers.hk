<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content=<?php echo e(csrf_token()); ?>>

    <title>Admin</title>
    <link rel="stylesheet" href="<?php echo e(asset('/admin/css/app.css')); ?>"></link>
	
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/fontawesome-free/css/all.min.css')); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo e(asset('/admin/dist/css/adminlte.min.css')); ?>">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
     <?php echo $__env->yieldContent('content'); ?>  <?php echo $__env->yieldContent('javascript'); ?>
    <script src="<?php echo e(url('/admin/plugins/jquery/jquery.min.js')); ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo e(url('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo e(url('/admin/dist/js/adminlte.min.js')); ?>"></script>
</body>
</html><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/admin/layouts/loginmaster.blade.php ENDPATH**/ ?>