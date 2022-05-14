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
p
{
    text-align:justify;
}
 </style>
<div class="my-4 columns is-mobile is-justify-content-center">

    <div class="column is-flex-grow-0 is-12-mobile is-5-tablet is-4-desktop is-5-widescreen is-5-fullhd">
         <div class="columns">
		    <div class="column is-flex-grow-0 is-6-mobile is-5-tablet is-4-desktop is-6-widescreen is-6-fullhd is-hidden-mobile">
          
            </div>
            <div class="column is-flex-grow-0 is-6-mobile is-5-tablet is-2-desktop is-3-widescreen is-3-fullhd is-hidden-mobile"  >
                </div>
            <div class="column is-flex-grow-0 is-6-mobile is-5-tablet is-2-desktop is-3-widescreen is-3-fullhd is-hidden-mobile"  >
                <button class="button is-primary is-rounded is-fullwidth" style="background-color:#BD3F39" id="myBtn">Contact Me</button>
                </div>
            </div>
         <div class="my-4">
                    <h4 class="title is-5 mb-2 has-text-left" style="white-space: pre-wrap;color:#BD3F39; font-size:18px; font-weight:bold; line-height:28px;"><?php echo e(ucfirst($post->title)); ?></h4>
                    
                </div>
              
				
               
       
        <div class="my-4 subtitle is-5" style="text-align:justify;font-size:14px !important; color:#000!important;margin-top:10px;"> 
          
			<?php echo $post->content ?>
            
        </div>
    </div>
</div>
<!-- The Modal -->
	<div id="myModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
		<span class="close">&times;</span>
		<div class="box">
			<form action="<?php echo e(route('contact.contact_post')); ?>" id="sendBtn" method="post">
             <?php echo csrf_field(); ?>
			<div class="has-text-centered">
				<h5 class="title is-6">Your contact information will shared with the publisher. Add custom message if you want.</h5>
			</div>
			<div class="field my-5">
				<div class="control">
				<div><label>Your preferred contact method:</label></div>
				<div class="select">					
					<select name="contact_method" id="contact_method" class="form-control" style="width: 100%;" required="">
						<option value="0">Mobile</option>
						<option value="1">Email</option>
					</select>
				</div>
				</div>
			</div>
			<div class="field my-5">
				<div class="control">
				<input id="type" type="hidden" class="form-control" value="<?php echo e($post->title); ?>" name="type" required autofocus>
				<input id="profile_id" type="hidden" class="form-control" value="<?php echo e($post->user_id); ?>" name="user_id" required autofocus>
				  <input id="mobile" type="text" class="form-control" placeholder="Contact" name="contact" required autofocus>
				</div>
			</div>
			<div class="field my-5">
				<div class="control">
				  <textarea class="textarea" name="message" placeholder="Message" required></textarea>
				</div>
			</div>
			<div class="has-text-right">
			<button class="button px-6 is-primary is-rounded">Send</button>
			</div>
			<?php if( isset($user->pref_contact_method) && $user->pref_contact_method == "public"): ?>
			<article id="sendAns" class="message is-small mt-5 ">
				<div class="message-body">
				  <p class="title is-6">Alternatively Direct Contact: +852<?php echo e($user->mobile); ?></p>
				</div>
			</article>
			<?php endif; ?>
			</form>
		</div>
	  </div>
	</div>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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
	

	
$("#sendBtn").submit(function(event) {
    event.preventDefault(); 
	$('.alert').remove();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax( {
		url:$(this).attr("action"),
		type:'post',
		data: $(this).serialize(),
		dataType: "json",
		success:function(data) {
			if(data.status == true){
				$('#sendBtn').prepend('<div class="alert alert-success text-center">'+data.message+'</div>');
				document.getElementById("sendBtn").reset(); 
			}else{
				$('#sendBtn').prepend('<div class="alert alert-danger text-center">'+data.message+'</div>');
			}			
		}, 
		error:function () {
			$('#sendBtn').prepend('<div class="alert alert-danger text-center">Error</div>');			
		}
	});
});
  </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/post_view_without_login.blade.php ENDPATH**/ ?>