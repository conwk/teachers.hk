<?php $__env->startSection('content'); ?>
<section class="my-6 is-large">
    <div class="">
        <div class="columns is-mobile is-justify-content-center">
            <div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">
                <form action="<?php echo e(route('post.save')); ?>" method="POST" >
					<?php echo csrf_field(); ?>
					<input type="hidden" name="id" value="" />
                    <div class="my-3">
                        <input name="title" class="input is-primary" type="text" placeholder="Your Post Title" required />
                    </div>
                      <div class="my-3">
                        <input name="subtitle" class="input is-primary" type="text" placeholder="Your Subtitle Title" required />
                    </div>
                    <div class="my-3">
                        <input name="tags" class="input is-primary" type="text" placeholder="Add Keyword For better search" />
                    </div>
                    <div class="select" style="display: block;">
                        <select name="level" id="city_id" style="width: 100%;" required >
                            <option value="">Level</option>
                            <option value="291">Level 1</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <input name="teaching_place" class="input is-primary" type="text" placeholder="Preferred Place of teaching"  />
                    </div>
                    <div class="select" style="display: block;">
                        <select name="class_type" id="city_id" style="width: 100%;" required>
                            <option value="">Class Type</option>
                            <option value="291">Level 1</option>
                        </select>
                    </div>

                    <div class="my-3">
                        <textarea id="post-content" required name="content" class="textarea is-primary" placeholder="About the Course" row="8"></textarea>
                    </div>

                    <div class="mt-3">
                        <button class="button is-primary is-rounded is-fullwidth">Done</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
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
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/post_add.blade.php ENDPATH**/ ?>