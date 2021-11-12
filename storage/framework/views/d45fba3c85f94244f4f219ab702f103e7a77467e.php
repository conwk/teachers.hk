<footer class="main-footer">
   <strong>Copyright &copy; <?php echo date('Y');?> <a href="#">LMS</a>.</strong> All rights
reserved.
</footer>
  


<script src="<?php echo e(asset('/admin/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('/admin/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('/admin/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('/admin/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('/admin/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('/admin/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('/admin/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('/admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>

<!-- Summernote -->
<script src="<?php echo e(asset('/admin/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('/admin/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('/admin/dist/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE DataTable -->
<script src="<?php echo e(asset('/admin/dist/js/datatable/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/admin/dist/js/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('/admin/dist/js/datatable/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('/admin/dist/js/datatable/buttons.bootstrap4.min.js')); ?>"></script>


<script type=text/javascript>
$('.update_status_user').change(function(){
	 $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
	
	var userStatus = $(this).val();  
	var dataId = $(this).attr('dataid'); 
	if(userStatus == 2){
		$('.alert').remove();
		$('#userID').val(dataId);
		$('#userStatus').val(userStatus);
		$('#rejectMessage').modal('show');
	}else{
		$.ajax({
			url:'users/changeStatus',
			type:'post',
			dataType: 'json',
			data: {
				'userStatus': userStatus,
				'dataId': dataId,
			},
			success:function(data) {			
				if(data.user == 1){					
					$('#status-'+dataId).html(data.message);
				}
			},
			error:function () {
				console.log('error');
			}
		});
	}

});


$('.update_status_category').change(function(){
	 $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });	
	var status = $(this).val();  
	var dataId = $(this).attr('dataid'); 
		$.ajax({
			url:'category/changeStatus',
			type:'post',
			dataType: 'json',
			data: {
				'status': status,
				'dataId': dataId,
			},
			success:function(data) {			
				if(data.category == 1){					
					$('#status-'+dataId).html(data.message);
				}
			},
			error:function () {
				console.log('error');
			}
		});	

});

$('.update_status_post').change(function(){
	 $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });	
	var status = $(this).val();  
	var dataId = $(this).attr('dataid'); 
		$.ajax({
			url:'posts/changeStatus',
			type:'post',
			dataType: 'json',
			data: {
				'status': status,
				'dataId': dataId,
			},
			success:function(data) {			
				if(data.post == 1){					
					$('#status-'+dataId).html(data.message);
				}
			},
			error:function () {
				console.log('error');
			}
		});	

});


 $('#userMessageForm').on('submit', function (e) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
  e.preventDefault();

  $.ajax({
	type: 'post',
	url:'users/sendMessage',
	data: $(this).serialize(),
	dataType: 'json',
	success: function (data) {
	 if(data.status == true){	
			$('#userMessageForm').prepend('<div class="alert alert-success" role="alert">Message Sent</div>');
			$('#messageUser').val('');
			$('#status-'+data.userId).html(data.message);
		}else{
			$('#status-'+data.userId).html(data.message);
		}
	}
  });

});


</script>
<?php /**PATH F:\XAMPP\htdocs\teacher\resources\views/admin/layouts/footer.blade.php ENDPATH**/ ?>