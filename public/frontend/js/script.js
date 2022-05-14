	
function createCroppie() {
	$('.image-crop').croppie({
		enableExif: true,
		customClass:'profile-photo',
		showZoomer:false,
		viewport: {
			width: 230,
			height: 230,
			type: 'circle'
		},
		boundary: {
			width: 250,
			height: 250
		}
	});
}

    
function readURL(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
			$('.image-error').remove();			
			if (!input.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
				$('.cr-slider-wrap').after('<div class="image-error">Profile image is not appropriate.</div>');
				input.value = null;
				return false;
			}
    
			var size = input.files[0].size;
			if(size > 300000){
				$('.cr-slider-wrap').after('<div class="image-error">Profile image is too large. Allowed maximum size is 300KB.</div>');
				input.value = null;
				return false;
			}
			$('.profile-pic').attr('src', e.target.result);
			$('#temp_image').val(e.target.result);
			
			$('.img').prepend('<a class="remove-photo" data-image="" href="javascript:void(0);"><i class="fas fa-times"></i></a>');
			
			/**/
			createCroppie();
			$('#temp_image').val('temp');			
			
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function () {

$(document).on('change', ".file-upload", function(){
	readURL(this);	
});

	
$(document).on('click', ".upload-button", function() {
	
	$(".file-upload").click();		
	
}); 


$(".submit-profile").on('click', function() {
	if($('#temp_image').val() == "temp"){
		$('.image-crop').croppie('result', {
			type: 'canvas',
			size: 'viewport'
	   }).then(function (img) {
		   $('#temp_image').val(img);	
		});
	}
	
}); 
 
$("#phonePageClick").click(function (e) {
    e.preventDefault();
    $(".phonePage").hide();
    $(".passwordPage").show();
    $(".progress").attr('value',"30")

  });
  $("#passwordPageClick").click(function (e) {
    e.preventDefault();
    $(".passwordPage").hide();
    $(".userPage").show();
    $(".progress").attr('value',"50")


  });
  $("#userPageClick").click(function (e) {
    e.preventDefault();
    $(".userPage").hide();
    $(".completePage").show();
    $(".progress").attr('value',"100")

  });

  $("#completePageClick").click(function (e) {
    e.preventDefault();
   window.location.href="screen8.html"
  });
  
  
  $('input[name="edit_url"]').change(function(e){
	  e.preventDefault();
	  var value = $(this).val();
		if(value == 1){
		   $('#new_profile_id').removeClass('hide');
	  }else{
		   $('#new_profile_id').addClass('hide');
	  }
  });
  
  $('#new_profile_id').change(function(e){
	  e.preventDefault();
	  var value = $(this).val();
		value = value.replace(/[_\W]+/g, "");
		$(this).val(value);	  
	  var flag = false;
	  $('.form-error').remove();
	  if($.trim(value) == ""){
		  $(this).after('<div class="form-error">Please enter valid profile URL</div>');
		  flag = true;
	  }else if(value.length < 6){
		  $(this).after('<div class="form-error">Profile URL should be a minimum 6 character.</div>');
		  flag = true;
	  }
	 
	  if(flag == false){
		  $.ajax({
			  url: "checkProfileUrl/"+value,
			  cache: false,
			  success: function(response){
				 $('.form-success').remove(); 
				 $('.form-error').remove(); 
				if(response == true){
					$('#new_profile_id').after('<div class="form-success">Profile URL is available.</div>');
				}else{
					$('#new_profile_id').after('<div class="form-error">Profile URL is not available.</div>');
				}
			  }
			});
	  }
	  
  });
  
  /*Remove Photo*/
  $(document).on('click', '.remove-photo', function(){
		var obj = $(this);
		var img = $(this).data('image');
		if(img == ""){
			$('.profile-photo').remove();
			obj.parents('.img').prepend('<img class="profile-pic image-crop upload-button placeholder" src="frontend/img/manplaceholder.jpg" alt="">');
			obj.remove();			
			$('.image-crop').croppie('destroy');	
		}else{
			obj.parents('.img').find('.profile-pic').attr('src','frontend/img/manplaceholder.jpg');
			obj.parents('.img').find('.profile-pic').addClass('placeholder');
			$('#temp_image').val('deleted');
			obj.remove();
		}
		 
	});
});