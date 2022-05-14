<?php $__env->startSection('content'); ?>

        <div class="columns is-mobile is-justify-content-center">
            <div class="column is-flex-grow-0 is-12-mobile is-5-tablet is-4-desktop is-5-widescreen is-5-fullhd">
		
	<?php if(\Session::has('success')): ?>

	<div class="alert alert-success">

		<?php echo \Session::get('success'); ?>


	</div>

	<?php elseif(\Session::has('failed')): ?>

	<div class="alert alert-danger">

		<?php echo \Session::get('failed'); ?>


	</div>

	<?php endif; ?>
		<div class="my-6">
		     <?php if(!empty($contact)): ?>
		 <?php $key = 0 ?>
		     	<?php $__currentLoopData = $contact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contacts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				
		     <p class="title is-5 has-text-left m-0" style="white-space: pre-wrap;color:#BD3F39; font-size:18px;margin-bottom:1rem; font-weight:bold;line-height:26px;">MSG <?php echo e($key+1); ?> | <?php echo e($contacts->contact); ?></p> 
                <p class="mt-4 subtitle is-6" style="color:#000;font-size:14px;"><?php echo e($contacts->message); ?></p>
                <hr class="dropdown-divider" style="border:block;background-color:#ccc">
	
                <?php $key++ ?>
          
			<p style="margin-top:1rem"></p>
                       
		   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
		   <?php endif; ?>
<div class="is-inline-flex">		   
		   <?php echo e($contact->links()); ?>

		   </div>
		   </div>
		
		     </div>
        </div>
   
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<style>
.note-editor.note-frame.fullscreen{
	position:fixed;
	top:30%;
	width:600px!important;
	left:30%;
	height:350px;
}
.note-editable ol, ul{
	margin-left:10px;
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/contact.blade.php ENDPATH**/ ?>