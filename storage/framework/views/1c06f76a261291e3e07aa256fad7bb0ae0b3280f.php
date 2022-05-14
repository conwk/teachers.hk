<?php $__env->startSection('content'); ?> 
<style>
.article
{
    text-align:justify;
}
.article p
{
    text-align:justify;
}
    a:hover
    {
        color: red !important;
    }
        .linkCourses:hover > div p:first-child {
    color: var(--red-color) !important;
}
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

@media(max-width:768px)
{
    .modal-content {
        width:80%;
    }
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

#userTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#userTable td, #userTable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#userTable tr:nth-child(even){background-color: #f2f2f2;}

#userTable tr:hover {background-color: #ddd;}

#userTable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #cc3131;
  color: white;
}
</style>
   <div class="py-6 columns is-mobile is-justify-content-center">
      <div class="column is-flex-grow-0 is-11-mobile is-10-tablet is-8-desktop is-8-widescreen is-6-fullhd">
        <div class="is-relative is-inline-block">
            <figure class="image is-128x128">
				<?php if(!empty($user->photo) && file_exists(public_path('/frontend/teacher/'.$user->photo))): ?>
				<img class="is-rounded" src="<?= URL::to('/'); ?>/frontend/teacher/<?php echo e($user->photo); ?>">
				<?php else: ?>
					<img class="is-rounded"  src="<?= URL::to('/'); ?>/frontend/img/flatProfile.png">	
				<?php endif; ?>
                
              </figure>
              <div class="absolute" style="position:absolute;bottom: 0;right: 0;">
                <figure class="image is-48x48">
                    <img src="<?= URL::to('/'); ?>/frontend/img/flatCheck.png">
                  </figure>
              </div>
           </div>
           <div class="">
               
                <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                    <div class="my-2">
                        <h4 class="title is-5 mb-2"><?php echo e($user->first_name); ?> 
						<?php
							$profileUrl = URL::to('/').'/mem/'.$user->profile_id;
						?>
						<?php if( Illuminate\Support\Facades\Auth::check() ): ?>
						<label style="padding-bottom:5px!important; background-color:#f1f1f1; padding:2px 5px; font-size:12px;"><?php echo e(Str::limit($profileUrl, 30)); ?><i link-url="<?php echo e($profileUrl); ?>" id="clipboard_btn" title="Copied!" class="fas fa-clipboard copy" aria-hidden="true" data-toggle="tooltip" data-placement="top" style="color:#333; padding-left:10px; padding-top:3px; font-size:18px; cursor:pointer;"></i></label>
						<?php endif; ?>
						</h4>
                        <div class="is-flex">
						<?php
							$socialLinks = (!empty($user->social_links)?json_decode($user->social_links):"");
						?>
							<?php if(!empty($socialLinks->twitter)): ?>
                           <div class="mx-1" style="margin-left:0px !important;"><a href="<?php echo e($socialLinks->twitter); ?>" target="_blank">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/twitter.png">
                              </figure>
							  </a>
                           </div>
						   <?php endif; ?>
						   <?php if(!empty($socialLinks->linkedin)): ?>
                           <div class="mx-1">
							<a href="<?php echo e($socialLinks->linkedin); ?>" target="_blank">
                            <figure class="image is-32x32">
                                <img src="<?= URL::to('/'); ?>/frontend/img/linkedin.png">
                              </figure>
							 </a> 
                           </div>
						    <?php endif; ?>
							<?php if(!empty($socialLinks->instagram)): ?>
							   <div class="mx-1">
								<a href="<?php echo e($socialLinks->instagram); ?>" target="_blank">
								<figure class="image is-32x32">
									<img src="<?= URL::to('/'); ?>/frontend/img/facebook.png">
								  </figure>
							   </div>
							   </a>
                              <?php endif; ?> 
                        </div>
                    </div>
					<?php if( Illuminate\Support\Facades\Auth::check() ): ?>
                    <div class="my-2">
						<a class="button is-primary is-rounded  submit-profile" href="<?php echo e(route('edit_profile.update')); ?>">Edit</a>   
                    </div>
					
					<?php else: ?>
					 <div class="my-2">
						<button class="button is-primary is-rounded  submit-profile" id="myBtn">Contact Me</button>
                    </div>
					<?php endif; ?>
                </div>
           </div>
		   <?php 
		  /*  echo '<pre>';
			print_r($user);
		   echo '</pre>'; */
		   ?>
           <div class="article">
          <?php echo $user->about_us ?>
          </div>
           <div class="my-6">
		   <table id="userTable">
			  <tr>
				<th>First Name</th>
				<td><?php echo e($user->first_name); ?></td>
			  </tr>			 
			  <tr>
				<th>Email</th>
				<td><?php echo e($user->email); ?></td>
			  </tr>
			  <tr>
				<th>DOB</th>
				<td><?php echo e($user->dob); ?></td>
			  </tr>
			  <tr>
				<th>Mobile</th>
				<td><?php echo e($user->mobile); ?></td>
			  </tr>
			  <tr>
				<th>City</th>
				<td><?php echo e($user->city); ?></td>
			  </tr>
			  <tr>
				<th>Address</th>
				<td><?php echo e($user->address); ?></td>
			  </tr>
			  <tr>
				<th>Account Type</th>
				<td><?php echo e($user->account_type); ?></td>
			  </tr>
			  <tr>
				<th>Pref Contact Method</th>
				<td><?php echo e($user->pref_contact_method); ?></td>
			  </tr>
			</table>
       
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
	<script src="<?= URL::to('/'); ?>/frontend/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">

	
	
	
    // Get the modal
	var modal = document.getElementById("myModal");
	var span = document.getElementsByClassName("close")[0];
	$(document).on("click","#myBtn",function() {
		modal.style.display = "block";
	});

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
	$(document).ready(function(){
		$('#clipboard_btn').tooltip({
		  trigger: 'click'
		});
	});
	
	document.getElementById("clipboard_btn").addEventListener("click", function() {
		copyToClipboard(document.getElementById("clipboard_btn"));
		hideTooltip('#clipboard_btn');
	});

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA" ;
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
		
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.getAttribute("link-url");
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
function hideTooltip(btn) {
  setTimeout(function() {
    $(btn).tooltip('hide');
  }, 1000);
}
  </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dvgsaeae/teacher.dvgsoft.com/resources/views/profile.blade.php ENDPATH**/ ?>