$(document).ready(function () {
  $("#login").submit(function (e) {
    $("#login_submit").text("Please Wait..");
    $("#login_submit").attr("disabled", true);
    $.ajax({
      type: "post",
      url: "auth_login.php",
      data: jQuery("#login").serialize(),
      dataType: "json",
      encode: true,
    })
      .done(function (data) {
     //console.log(data);
        if (data.status === false) {
          $("#response_message").html(data.message);
          $("#login_submit").text("Login");
          jQuery("#login_submit").attr("disabled", false);
        }
        if (data.status === true) {
          jQuery("#login")["0"].reset();
          jQuery("#login_submit").attr("disabled", false);
          $("#login_submit").text("Login");
         
          const now=new Date();
          const payload={
            email:data.email,
            username:data.username,
            token:data.token
          }
          //  localStorage.setItem("email", data.email);
          
          if(data.role==="student"||data.role==="working")
          {
            localStorage.setItem("payload", JSON.stringify(payload));
            window.location = "index.php";
          }
          else{
             localStorage.setItem("Orgpayload", JSON.stringify(payload));
              window.location = "organisation.php";
          }

         
        }
      })
      .fail(function (data) {
$("#response_message").html("Something Went Wrong");
        jQuery("#login")["0"].reset();
        $("#login_submit").text("Login");
        jQuery("#login_submit").attr("disabled", false);
      });
    e.preventDefault();
  });
   function validateForm() {
    var valid = true;
    if (!$("#username").val()) {
      $("#userUname-info").html("Required");
      valid = false;
    }
  }
});
