$(document).ready(function () {
    $("#QPASS").submit(function (e) {
var Fdata = {
  username: $("#username").val(),
  securityQ: $("#securityQ").val(),
  answer: $("#answer").val(),
};
$("#login_submit").html("Validating..");
$.ajax({
  type: "post",
  url: "retPass.php",
  data: Fdata,
  dataType: "json",
  success: function (response) {
    //console.log(response);
    $("#login_submit").html("Validate");
    if(response.status===true)
    {
    $("#showpass").html(`<div class="alert alert-primary" role="alert">
  Temporary Password is genrated and valid for 10 min <a href="login.php" class="alert-link">Click to login</a>.Password:<strong>
  ${response.message}</strong>
</div>`);
    }
    else{
         $("#showpass").html(`<div class="alert alert-danger" role="alert"><strong>
  ${response.message}</strong>.
</div>`);
    }

  },
});
      e.preventDefault();
    });
    
});