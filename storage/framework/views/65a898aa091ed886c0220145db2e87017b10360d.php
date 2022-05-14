<?php $__env->startSection('content'); ?>

        <div class="columns is-mobile is-justify-content-center">
            <div class="column is-flex-grow-0 is-12-mobile is-5-tablet is-4-desktop is-5-widescreen is-5fullhd">
		
	<?php if(\Session::has('success')): ?>

	<div class="alert alert-success">

		<?php echo \Session::get('success'); ?>


	</div>

	<?php elseif(\Session::has('failed')): ?>

	<div class="alert alert-danger">

		<?php echo \Session::get('failed'); ?>


	</div>

	<?php endif; ?>
	 <div class="columns is-mobiler">
		    <div class="column is-flex-grow-0 is-6-mobile is-5-tablet is-4-desktop is-6-widescreen is-6-fullhd is-hidden-mobile">
          
            </div>
            <div class="column is-flex-grow-0 is-6-mobile is-5-tablet is-4-desktop is-6-widescreen is-6-fullhd is-hidden-mobile" style="padding-right:35px;" >
               
                        <a href="<?= URL::to('/'); ?>/add-post" class="button is-primary is-rounded " style="float:right;background-color: var(--red-color) !important;">New Post</a>
                    
                    </div>
                    </div>
			<?php if(!empty($posts)): ?>
			<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					
            <a href="<?php echo e(route('post.view',$post->slug)); ?>" class="linkCourses">
                <div class="my-5">
                <p class="title is-5 has-text-left m-0" style="white-space: pre-wrap;color:#BD3F39; font-size:18px; font-weight:bold; line-height:28px;display: flex;"><?php echo e(ucfirst($post->title)); ?> 
				<?php 
					if($post->status == 1){
						echo '<span class="tag is-success">Approve</span>';
					}else{
						echo '<span class="tag is-warning">Pending</span>';
					}
				?>
				</p> 
			</a>
			
                <div class="mt-4 subtitle is-5" style="text-align:justify;font-size:14px !important; color:#000!important;margin-top:10px;">
					<?PHP 
					$url = route('post.view',$post->slug);
					$string =  $post->content;					
					if (strlen($string) > 400) {
						$stringCut = substr($string, 0, 400);
						$endPoint = strrpos($stringCut, ' ');	
						$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
						$string .= '... <a href="'.$url.'" style="color:#000;font-weight:bold;">more >></a>';
					}
					echo $string;
			         ?>
				</div>
			
                <hr class="dropdown-divider" style="border:block;background-color:#ccc">
                </div>
           	<p style="margin-top:1.5rem;"></p>
		   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		   <?php endif; ?> 
			<div class="is-inline-flex">		   
		   <?php echo e($posts->links()); ?>

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
<script>
  $(function () {
    // Summernote
    $('#post-content').summernote({
	height: 200,  
	toolbar: [
		// [groupName, [list of button]]
		['style', ['bold', 'italic', 'underline']],
		['para', ['ul', 'ol', 'paragraph']],
		["view", ["fullscreen"]]
	],
	callbacks: {
		onPaste: function (e) {
        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        e.preventDefault();
        document.execCommand('insertText', false, bufferText);
		}
	  }
	});
	
	 $(".dropdown-toggle").click(function(){
		 $(this).parents('.btn-group:first').find('.dropdown-menu').toggle();
	  });
  })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/post.blade.php ENDPATH**/ ?>