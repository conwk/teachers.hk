<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }.card-header {    color: #000;    font-weight: bold;}.input-group label {    font-size: 17px;    font-weight: bold;    text-align: left;}
			input {				width: 300px;				padding: 10px;				margin-bottom: 20px;			}
            .title {
                font-size: 14px;				text-align:center;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                   <div class="content">
                        <form action="{{ route('login.user') }}" id="sendOtp" method="post">
                            @csrf

                            <div class="input-group mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No') }}</label>
								<div class="col-md-6">                                     
								<input id="otpprefix" value="+{{$_ENV['MOBILE_EXTENSION']}}" class="form-control" name="otpprefix" readonly>
                                </div> 
                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row otp">
                                <label for="password" class="col-md-4 col-form-label text-md-right">OTP</label>
                               	<div class="col-md-6">
                                    <input id="otp" type="number" class="form-control" name="otp" maxlength ="4">
                                </div>
                            </div>

                            <div class="form-group row mb-0 otp">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="form-group row send-otp">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-success sendOtp" onclick="sendOtp()">Send OTP</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   </div>
    </body>
</html>



    <script>
        $('.otp').hide();
        function sendOtp() {			
			$('.alert').remove();
			$('.otp').hide().val('');          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax( {
                url:'sendOtp',
                type:'post',
				dataType: "json",
                data: {'mobile': $('#mobile').val()},
                success:function(data) {			
				//var dataJson = JSON.parse(data);				
				$('#sendOtp').prepend('<span class="alert error">'+data.message+'</span>');			
				if(data.status == true){					
					$('.otp').show();                    
					$('.sendOtp').text('Resend');				
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

            $.ajax( {
                url: $(this).attr('action'),
                type:'post',
                data: formData,
                dataType: "json",
                success:function(data) {	
					if(data.status == true){
						$('#sendOtp').prepend('<span class="alert error">'+data.message+'</span>');	
						window.setTimeout(function(){	
							 window.location.reload()						  
						}, 2000);				
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
