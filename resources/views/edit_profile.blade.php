@extends('layouts.new')
@section('content')
<section class="mt-6 is-large">    
	<div class="">
		<div class="columns is-mobile is-justify-content-center">
			<div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">			
				<form action="{{ route('edit_profile.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="my-3">
						@php
							$profileUrl = URL::to('/').'/mem/'.$user->profile_id;
						@endphp
						
						
						<div class="radio-group">
							<div class="form-check form-switch">
							 <input class="form-check-input" name="edit_url" type="checkbox" id="switch_status" {{ ($user->edit_url == 1)?"checked":""}} style="margin-top:8px;">
							 <label for="switch_status">Make Profile Active?</label>							 
							 </div>
							<!--<input required type="radio" name="edit_url" value="1" id="edit_url_yes" {{(isset($user->edit_url) && $user->edit_url == '1') ? 'checked' : '' }} />&nbsp;<label for="edit_url_yes">Yes</label>
							<input required type="radio" name="edit_url" value="0" id="edit_url_no" {{(isset($user->edit_url) && $user->edit_url == '0') ? 'checked' : '' }}  />&nbsp;<label for="edit_url_no">No</label>-->
						</div>
						<div class="edit-url-section" style="display:none;">
							<label class="profile-url">{{Str::limit($profileUrl, 35)}}
							<i link-url="{{ $profileUrl }}" title="Click to edit URL" class="fas fa-edit edit-profile-url" aria-hidden="true" style="color:#333; padding-left:10px; padding-top:3px; font-size:16px; cursor:pointer;"></i>
							<i link-url="{{ $profileUrl }}" id="clipboard-btn" title="Copied!" class="fas fa-clipboard copy" aria-hidden="true" data-toggle="tooltip" data-placement="top" style="color:#333; padding-left:10px; padding-top:3px; font-size:16px; cursor:pointer;"></i>
							</label>
							<div class="profile-url-group" style="display:none;">
								<label class="url-label" >{{Str::limit($profileUrl, 20)}}</label>
								<input style="margin-top:5px;" name="new_profile_id" id="new_profile_id" class="is-primary custom-input" type="text" placeholder="Enter profile url" maxLength="30" value="{{isset($user->profile_id) ? $user->profile_id : old('profile_id') }}" />
							</div>
							
						</div>
						
					</div>
					<div class="my-3">
						<input required name="first_name" class="input is-primary" type="text" placeholder="Full name as per HKID" value="{{isset($user->first_name) ? $user->first_name : old('first_name') }}">
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
						<input type="hidden" name="city" id="user-city" value="{{isset($user->city) ? $user->city : old('city') }}" />
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
						<input required name="address" class="input is-primary" type="text" placeholder="Address" value="{{isset($user->address) ? $user->address : old('address') }}">
					</div>
					<div class="my-3">
						<div class="field">
							<p class="control has-icons-left has-icons-right">
								<input required name="email" class="input is-primary" type="email" placeholder="Email" value="{{isset($user->email) ? $user->email : old('email') }}">
									<span class="icon is-small is-left">
										<i class="fas fa-envelope"></i>
									</span>
							</p>
						</div>
					</div>
					<div class="my-3">
						<input required name="dob" class="input  is-primary" type="date" placeholder="Date of Birth" value="{{isset($user->dob) ? $user->dob : old('dob') }}">
					</div>
					<div class="is-block dropdown accountTypeOption">
						<div class="is-fullwidth dropdown-trigger">
							<input type="hidden" name="account_type" id="user-account-type" value="{{isset($user->account_type) ? $user->account_type : old('account_type') }}" />
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
							<input type="hidden" name="pref_contact_method" id="user-pref_contact_method" value="{{isset($user->pref_contact_method) ? ucfirst($user->pref_contact_method) : old('pref_contact_method') }}" />
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
								@if(!empty($user->photo) && file_exists(public_path('/frontend/teacher/'.$user->photo)))
								<a class="remove-photo" data-image="{{$user->photo}}" href="javascript:void(0);"><i class="fas fa-times"></i></a>	
								<img class="profile-pic image-crop upload-button" src="<?= URL::to('/'); ?>/frontend/teacher/{{$user->photo}}">
								@else
									<img class="profile-pic image-crop upload-button placeholder" src="<?= URL::to('/'); ?>/frontend/img/manplaceholder.jpg" alt="">							
								@endif								
								<div class="photo-edit">
									<input class="file-upload" type="file" accept="image/*" onclick="this.value = null"/>
									<input type="hidden" name="avatar"  value="" id="temp_image" />
								</div>

							</div>
						</div>
					</div>
					@php
					$socialLinks = (!empty($user->social_links)?json_decode($user->social_links):"");
					@endphp
					<div class="mb-5">
				
						<div class="my-3">
							<input required name="social_links[twitter]" id="basic-url" type="url" class="input is-primary" placeholder="https://www.twitter.com" value="{{isset($socialLinks->twitter) ? $socialLinks->twitter : old('social_links[twitter]') }}"  >
						</div>
					</div>
					<div class="mb-5">
					
						<div class="my-3">
							<input required name="social_links[linkedin]" id="basic-url" type="url" class="input is-primary" placeholder="https://www.linkedin.com" value="{{isset($socialLinks->linkedin) ? $socialLinks->linkedin : old('social_links[linkedin]') }}" >
						</div>
					</div>
					<div class="mb-5">
						
						<div class="my-3">
							<input required name="social_links[instagram]" id="basic-url" type="url" class="input is-primary" placeholder="https://www.instagram.com" value="{{isset($socialLinks->instagram) ? $socialLinks->instagram : old('social_links[instagram]') }}">
						</div>
					</div>
					
					<div class="my-3">
						<textarea required name="about_us" id="about-us" class="textarea is-primary"  placeholder="About you" row="8">{{isset($user->about_us) ? $user->about_us : old('about_us') }}</textarea>
					</div>				   
					<div class="mt-3">
						<button class="button is-primary is-rounded is-fullwidth submit-profile">Done</button>
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
  <script src="<?= URL::to('/'); ?>/frontend/js/bootstrap.bundle.min.js"></script>
  <script src="<?= URL::to('/'); ?>/frontend/js/script.js?t={{time()}}"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<style>
.note-editor.note-frame.fullscreen {
    position: fixed;
    top: 30%;
    width: 90% !important;
    left: 30%;
    height: 350px;
    max-width: 670px;
}
@media only screen and (max-width: 600px) {
   .note-editor.note-frame.fullscreen {
        left: 5%; 
    }
    }
.img{
	background-color:#f1f1f1;
}
.note-editable ol, ul{
	margin-left:10px;
}
</style>
<script>
  $(function () {
    // Summernote
    $('#about-us').summernote({
	height: 200,  
	blockquoteBreakingLevel: 2,
	toolbar: [
		// [groupName, [list of button]]
		['style', ['bold', 'italic', 'underline']],
		['para', ['ul','ol','paragraph']],
		["view", ["fullscreen"]]
	],
	callbacks: {
		onPaste: function (e) {
			var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
			e.preventDefault();
			document.execCommand('insertText', false, bufferText);
		},
		onInit: function() {
             $('.btn-fullscreen').click(function(){
				 
			 });
        }
		
		
	  }
  });
  
  
  $(".dropdown-toggle").click(function(){
	 $(this).parents('.btn-group:first').find('.dropdown-menu').toggle();
  });

	$('.edit-profile-url').click(function(){
		$('.profile-url-group').show(0);
		$('.profile-url').hide(0);
	});
	
	if($('#switch_status').is(':checked')){
		$('.edit-url-section').show(0);
	}else{
		$('.edit-url-section').hide(0);
	}
	
	$(document).on('click', '#switch_status',function(){
		if($(this).is(':checked')){
			$('.edit-url-section').show(0);
		}else{
			$('.edit-url-section').hide(0);
		}	
	});
	
	 $('#clipboard-btn').tooltip({
		  trigger: 'click'
	});
	
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
document.getElementById("clipboard-btn").addEventListener("click", function(e) {
		copyToClipboard(document.getElementById("clipboard-btn"));
		hideTooltip('#clipboard-btn');
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

@endsection