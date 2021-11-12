<?php $__env->startSection('content'); ?>
<section class="mt-6 is-large">
	<div class="">
		<div class="columns is-mobile is-justify-content-center">
			<div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">			
				<form action="<?php echo e(route('edit_profile.update')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="my-3">
						<input name="first_name" class="input is-primary" type="text" placeholder="Full name as per HKID" value="<?php echo e(isset($user->first_name) ? $user->first_name : old('first_name')); ?>">
					</div>
					<div class="is-block dropdown chooseCityOption">
						<div class="is-fullwidth dropdown-trigger">
							<button class="is-flex is-fullwidth button btn-trans chooseCity  is-justify-content-space-between" aria-haspopup="true" aria-controls="dropdown-menu2">
								<span>Choose City</span>
								<span class="icon is-small">
									<i class="fas fa-angle-down" aria-hidden="true"></i>
								</span>
							</button>
						</div>
						<div style="width: 100% !important; height: 200px !important; overflow-y: scroll !important
						; box-shadow: 0 0.5em 1em -0.125em rgb(10 10 10 / 10%), 0 0 0 1px rgb(10 10 10 / 2%);" class="dropdown-menu" id="dropdown-menu2" role="menu" >
						<input type="hidden" name="city" id="user-city" value="<?php echo e(isset($user->city) ? $user->city : old('city')); ?>" />
							<div class="dropdown-content">
								<div class="dropdown-item">
									<p class="">Aberdeen</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Cheung Chau</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Fanling</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Hong Kong Island</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Kowloon</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Kwai Chung</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Kwun Tong</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">lamma island</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Ma On Shan</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">North Lantau</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Sai Kung</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Sha Tin</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Sheung Shui</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Tai Po</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Tin Shui Wai</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Tseung Kwan O</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Tsing Yi</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Tsuen Wan</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Tuen Mun</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Tung Chung</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Victoria</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p class="">Yuen Long</p> 
								</div>


							</div>
						</div>
					</div>
					<div class="my-3">
						<input name="address" class="input is-primary" type="text" placeholder="Address" value="<?php echo e(isset($user->address) ? $user->address : old('address')); ?>">
					</div>
					<div class="my-3">
						<div class="field">
							<p class="control has-icons-left has-icons-right">
								<input name="email" class="input is-primary" type="email" placeholder="Email" value="<?php echo e(isset($user->email) ? $user->email : old('email')); ?>">
									<span class="icon is-small is-left">
										<i class="fas fa-envelope"></i>
									</span>
							</p>
						</div>
					</div>
					<div class="my-3">
						<input name="dob" class="input  is-primary" type="date" placeholder="Date of Birth" value="<?php echo e(isset($user->dob) ? $user->dob : old('dob')); ?>">
					</div>
					<div class="is-block dropdown accountTypeOption">
						<div class="is-fullwidth dropdown-trigger">
							<input type="hidden" name="account_type" id="user-account-type" value="<?php echo e(isset($user->account_type) ? $user->account_type : old('account_type')); ?>" />
							<button class="is-flex is-fullwidth button btn-trans accountType is-justify-content-space-between" aria-haspopup="true" aria-controls="dropdown-menu2">
								<span>Account Type</span>
								<span class="icon is-small">
									<i class="fas fa-angle-down" aria-hidden="true"></i>
								</span>
							</button>
						</div>

						<div class="dropdown-menu" id="dropdown-menu2" role="menu" style="width: 100% !important;">
							<div class="dropdown-content">
								<div class="dropdown-item">
									<p>Self-Managed</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<p>Institution</p> 
								</div>
							</div>
						</div>
					</div>
					
					 <div class="mt-3 is-block dropdown preferredMathodOption">
						<div class="is-fullwidth dropdown-trigger">
							<input type="hidden" name="pref_contact_method" id="user-pref_contact_method" value="<?php echo e(isset($user->pref_contact_method) ? $user->pref_contact_method : old('pref_contact_method')); ?>" />
							<button class="is-flex is-fullwidth button btn-trans preferredMathod is-justify-content-space-between" aria-haspopup="true" aria-controls="dropdown-menu2">
								<span>Preferred Contact Mathod</span>
								<span class="icon is-small">
									<i class="fas fa-angle-down" aria-hidden="true"></i>
								</span>
							</button>
						</div>
						<div class="dropdown-menu" id="dropdown-menu2" role="menu" >
							<div class="dropdown-content">
								<div class="dropdown-item">
									<h3 class="has-text-weight-bold">Public</h3> 
									<p class="subtitile is-size-7 "> You registered phone number will be showen with a whatsapp icon.Please make sure you have whatsapp with your registered number.</p> 
								</div>
								<hr class="dropdown-divider m-0">
								<div class="dropdown-item">
									<h3 class="has-text-weight-bold">Private</h3> 
									<p class="subtitile is-size-7 ">user wont see your phone number. A message box will show user where user can send a custom  message. you will be notified by sms and you can log here and read under message.</p>
								</div>
							</div>
						</div>
					</div>
					
					<div class="my-3 profile-picture is-relative">
						<div class="has-text-centered">
							<div class="img">
								<?php if(!empty($user->photo) && file_exists(public_path('/frontend/teacher/'.$user->photo))): ?>
								<img class="profile-pic image-crop" id="upload-demo" src="<?= URL::to('/'); ?>/frontend/teacher/<?php echo e($user->photo); ?>">
								<?php else: ?>
									<img class="profile-pic image-crop" id="upload-demo" src="<?= URL::to('/'); ?>/frontend/img/manplaceholder.jpg" alt="">								
								<?php endif; ?>
								
								<div class="photo-edit">
									<i class="fas fa-edit photo-edit-icon upload-button"></i>
									<input name="photo" class="file-upload" type="file" accept="image/*"/>
								</div>
							</div>
						</div>
					</div>
					<?php
					$socialLinks = (!empty($user->social_links)?json_decode($user->social_links):"");
					?>
					<div class="mb-5">
						<label for="basic-url" class="form-label has-text-white py-1 px-2" style="background-color:rgb(27, 149, 224)"><span><i class="fab fa-twitter"></i></span> Twitter</label>
						<div class="my-3">
							<input name="social_links[twitter]" id="basic-url" type="url" class="input is-primary" placeholder="https://www.url.com" value="<?php echo e(isset($socialLinks->twitter) ? $socialLinks->twitter : old('social_links[twitter]')); ?>"  >
						</div>
					</div>
					<div class="mb-5">
						<label for="basic-url" class="form-label has-text-white py-1 px-2" style="background-color: #0a66c2;"><span><i class="fab fa-linkedin"></i></span> Linkedin</label>
						<div class="my-3">
							<input name="social_links[linkedin]" id="basic-url" type="url" class="input is-primary" placeholder="https://www.url.com" value="<?php echo e(isset($socialLinks->linkedin) ? $socialLinks->linkedin : old('social_links[linkedin]')); ?>" >
						</div>
					</div>
					<div class="mb-5">
						<label for="basic-url" class="form-label has-text-white py-1 px-2" style="background-image: linear-gradient(
										-226deg,#d0165f,#e1475b 51%,#ee592c);">
							<span><i class="fab fa-instagram"></i></span> Instagram
						</label>
						<div class="my-3">
							<input name="social_links[instagram]" id="basic-url" type="url" class="input is-primary" placeholder="https://www.url.com" value="<?php echo e(isset($socialLinks->instagram) ? $socialLinks->instagram : old('social_links[instagram]')); ?>">
						</div>
					</div>
					
					<div class="my-3">
						<textarea name="about_us" id="about-us" class="textarea is-primary"  placeholder="About you" row="8"><?php echo e(isset($user->about_us) ? $user->about_us : old('about_us')); ?></textarea>
					</div>
				   
							<div class="mt-3">
						<button class="button is-primary is-rounded is-fullwidth">Done</button>
					</div>
				</form>
					
			</div>
		</div>
	</div>
</section>
<!-- crop  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script src="<?= URL::to('/'); ?>/frontend/js/script.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
  $(function () {
    // Summernote
    $('#about-us').summernote({
	height: 200,  
	toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]});
  })
</script>
  <script>
  $(document).ready(function(){
	  $('.image-crop').croppie({});
  });
    
    </script>
    <script>
        const dropdowns = document.querySelectorAll('.dropdown:not(.is-hoverable)');

if (dropdowns.length > 0) {
  // For each dropdown, add event handler to open on click.
  dropdowns.forEach(function(el) {
    el.addEventListener('click', function(e) {
      e.stopPropagation();
      e.preventDefault();
      el.classList.toggle('is-active');
    });
  });

  // If user clicks outside dropdown, close it.
  document.addEventListener('click', function(e) {
    closeDropdowns();
  });
}

/*
 * Close dropdowns by removing `is-active` class.
 */
function closeDropdowns() {
  dropdowns.forEach(function(el) {
    el.classList.remove('is-active');
  });
}

// Close dropdowns if ESC pressed
document.addEventListener('keydown', function (event) {
  let e = event || window.event;
  if (e.key === 'Esc' || e.key === 'Escape') {
    closeDropdowns();
  }
});
const chooseCity = document.querySelector(".chooseCity > span");
if(document.getElementById("user-city").value != ""){
	document.querySelector(".chooseCity > span").innerHTML = document.getElementById("user-city").value;
}
const optionsList1 = document.querySelectorAll(".chooseCityOption .dropdown-item");
optionsList1.forEach(option1 => {
	option1.addEventListener("click", () => {
		const cityName = option1.querySelector("p").innerHTML;
		chooseCity.innerHTML = cityName;
		document.getElementById("user-city").value = cityName;
	});
});
const accountType = document.querySelector(".accountType > span");
if(document.getElementById("user-account-type").value != ""){
	document.querySelector(".accountType > span").innerHTML = document.getElementById("user-account-type").value;
}
const optionsList2 = document.querySelectorAll(".accountTypeOption .dropdown-item");
optionsList2.forEach(option2 => {
	const accountTypeValue = option2.querySelector("p").innerHTML;
	option2.addEventListener("click", () => {
		accountType.innerHTML = accountTypeValue;
		document.getElementById("user-account-type").value = accountTypeValue;
	});
});
const preferredMathod = document.querySelector(".preferredMathod > span");
if(document.getElementById("user-pref_contact_method").value != ""){
	document.querySelector(".preferredMathod > span").innerHTML = document.getElementById("user-pref_contact_method").value;
}
const optionsList3 = document.querySelectorAll(".preferredMathodOption .dropdown-item");
optionsList3.forEach(option3 => {
	const pcMethod = option3.querySelector("h3").innerHTML;
	option3.addEventListener("click", () => {
		preferredMathod.innerHTML = pcMethod
		document.getElementById("user-pref_contact_method").value = pcMethod;
		
	});
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\XAMPP\htdocs\teacher\resources\views/edit_profile.blade.php ENDPATH**/ ?>