$(document).ready(function () {

  var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('.profile-pic').attr('src', e.target.result);
          $('.cr-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  
$(".file-upload").on('change', function(){
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
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

});