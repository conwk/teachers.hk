@extends('layouts.new')
@section('content')
<section class="mt-6 is-large">
	<div class="">
		<div class="columns is-mobile is-justify-content-center">
			<div class="column is-flex-grow-0 is-10-mobile is-5-tablet is-4-desktop is-3-widescreen is-3-fullhd">
				<progress class="progress is-small" value="15" max="100"></progress>
				<div class="has-text-centered">
					<div><span id="timer"></span></div>
					<form action="{{ route('login.user') }}" id="sendOtp" method="post">
					@csrf
						<!--Step 1-->
						<div class="section-mobile">
							<div class="mt-6">
								<h5 class="title is-6">Please provide your phone number without +{{$_ENV['MOBILE_EXTENSION']}}</h5>
							</div>
							<div class="mt-4">
								<input type="text" class="input is-primary has-text-centered" id="mobile" placeholder="Phone Number" name="mobile" required autofocus>
							</div>                                   
						</div> 
						<!--Step 2-->
						<div class="section-otp">
							<div class="mt-6">
								<h5 class="title is-6">Next, please enter the 4-digit code we just sent you</h5>
							</div>
							<div class="mt-4">
								<input id="otp" type="password" class="input is-primary has-text-centered" name="otp" maxlength ="4" placeholder="****">											
							</div>
							<div class="mt-3">
								<button class="button is-primary is-rounded is-fullwidth mt-5">Continue</button>
							</div>									
						</div>                                 
					</form>
					<button class="button is-primary is-rounded mt-5 is-fullwidth sendOtp" onclick="sendOtp()" >Continue</button>
						
					 
				</div>
					
			</div>
		</div>
	</div>
</section>
<script>
		var timerOn = true;
		function timer(remaining,reset) {
			var m = Math.floor(remaining / 60);
			var s = remaining % 60;		  
			m = m < 10 ? '0' + m : m;
			s = s < 10 ? '0' + s : s;
			document.getElementById('timer').innerHTML = m + ':' + s;
			remaining -= 1;
			console.log(remaining);
			if(remaining >= 0 && timerOn) {				
				setTimeout(function() {
					timer(remaining);				
				}, 1000);
				return;
			}
			if(!timerOn) {		
				return;
			}
		}

		$('.otp').hide();
		
		function sendOtp() {
			$('.alert').remove();
			$('.otp').hide().val('');          
			$('#mobile').attr('style', 'border: 1px solid #808080 !important');
			var mobile = $('#mobile').val();  
			if(mobile == ""){
				$('#mobile').attr('style', 'border: 2px solid #cc3131 !important');
				return false;
			}			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url:'sendOtp',
				type:'post',
				dataType: "json",
				data: {'mobile': $('#mobile').val()},
				success:function(data) {	
					$('.progress').attr('value', '40');			
					if(data.status == true){
						if(data.action != ""){
							window.location.href = data.action;
						}else{
							$('#sendOtp').prepend('<span class="alert success">'+data.message+'</span>');
							timer(300);						
							$('.otp').show();                    
							$('.sendOtp').hide(); 
							$('.section-otp').show();                    
							$('.section-mobile').hide();
						}				
												
						//$('.sendOtp').text('Resend');				
					}else{
						$('#sendOtp').prepend('<span class="alert error">'+data.message+'</span>');						
						
					}
				},
				error:function () {
					console.log('error');
				}
			});
			
		}

		$(document).ready(function () {
			$("#sendOtp").submit(function (event) {
			$('.alert').remove();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var formData = {
				mobile: $("#mobile").val(),
				otp: $("#otp").val(),			 
			};
			$.ajax({
				url: $(this).attr('action'),
				type:'post',
				data: formData,
				dataType: "json",
				success:function(data) {	
					if(data.status == true){
						if( data.action != "" ){
							window.location.href = data.action;
						}else{
							$('#sendOtp').prepend('<span class="alert error">'+data.message+'</span>');
						}
						$('#sendOtp').prepend('<span class="alert error">'+data.message+'</span>');	
						/*window.setTimeout(function(){	
							window.location.reload()						  
						}, 2000);*/				
					}
					if(data.status == false){
						$('#sendOtp').prepend('<span class="alert error">'+data.message+'</span>');			
					}						
				},
				error:function () {
					console.log('error');
				}
			});
			event.preventDefault();
			});
		});
	</script>
@endsection