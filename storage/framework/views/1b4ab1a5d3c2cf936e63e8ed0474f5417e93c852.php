<?php $__env->startSection('content'); ?>
<style>
 
 /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 999; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: auto; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  overflow: hidden;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 12% auto; /* 15% from the top and centered */
  padding: 0px;
  border: 1px solid #888;
  width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 22px;
  font-weight: bold;
  text-align:right;
  padding-right:10px;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
 </style>
<div class="my-6 columns is-mobile is-justify-content-center">
    <div class="column is-flex-grow-0 is-11-mobile is-10-tablet is-8-desktop is-8-widescreen is-6-fullhd">
        <div class="m-4">
            <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                <div class="my-2">
                    <h4 class="title is-5 mb-2"><?php echo e($post->title); ?></h4>
                    <div class="is-flex">
                        <div class="mx-3">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/group.png" />
                            </figure>
                        </div>
                        <div class="mx-3">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/level.png" />
                            </figure>
                        </div>
                        <div class="mx-3">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/map.png" />
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    <button class="button is-danger is-medium" id="myBtn">Contact Me</button>
                </div>
            </div>
        </div>
        <div class="my-4">
            <p class="subtitle is-6" style="white-space: pre-line;">
			<?php echo $post->content ?>
            </p>
        </div>
    </div>
</div>
<!-- The Modal -->
	<div id="myModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
		<span class="close">&times;</span>
		<div class="box">
			<div class="has-text-centered">
				<h5 class="title is-6">Your contact information will shared with the publisher. Add custom message if you want.</h5>
			</div>
			<div class="field my-5">
				<div class="control">
				  <textarea class="textarea" placeholder="Message"></textarea>
				</div>
			</div>
			<div class="has-text-right">
			<button id="sendBtn" class="button px-6 is-primary is-rounded">Send</button>
			</div>
			<?php if( isset($user->pref_contact_method) && $user->pref_contact_method == "public"): ?>
			<article id="sendAns" class="message is-small mt-5 ">
				<div class="message-body">
				  <p class="title is-6">Alternatively Direct Contact: +852<?php echo e($user->mobile); ?></p>
				</div>
			</article>
			<?php endif; ?>
		</div>
	  </div>
	</div>	
  
<script type="text/javascript">
    // Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal
	btn.onclick = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
		modal.style.display = "none";
	  }
	}
	
	document.getElementById("clipboard-btn").addEventListener("click", function() {
		copyToClipboard(document.getElementById("clipboard-btn"));
	});

  </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/post_view.blade.php ENDPATH**/ ?>