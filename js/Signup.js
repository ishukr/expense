$(document).ready(function () {
  $("#Signup").submit(function (event) {
    var check = validateForm();
    if (check) {
      $("#userUname-info").html("");
      $("#userName-info").html("");
      $("#userEmail-info").html("");
      $("#userEmail-info").html("");
      $("#password-info").html("");
       $("#usertype-info").html("");
       
      var formData = {
        uname: $("#uname").val().toLowerCase(),
        name: $("#name").val(),
        type: $("#inputState").val().trim(),
        email: $("#email").val(),
        password: $("#password").val(),
        Sq: $("#securityQ").val(),
        Sa: $("#Sanswer").val().trim(),
      };
     //console.log(formData);
      $("#Submit").text("Hold on....");
      jQuery("#Submit").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: "auth_signup.php",
        data: formData,
        dataType: "json",
        encode: true,
      })
        .done(function (data) {
          //console.log(data);
          if(data.status===false)
          {
            $("#response_message").html(data.message);
             $("#Submit").text("Signup");
             jQuery("#Submit").attr("disabled", false);
          }
          if(data.status===true)
          {
            jQuery("#Signup")["0"].reset();
             jQuery("#Submit").attr("disabled", false);
            $("#response_message_success")
              .html("Registration Successfull..");
            setTimeout(() => {
                window.location = "login.php";
            }, 2000);
           
          }
          
          
        })
        .fail(function (data) {
          //console.log(data);
            jQuery("#Signup")["0"].reset();
            $("#Submit").text("Signup");
            jQuery("#Submit").attr("disabled", false);
        });
    }
    event.preventDefault();
  });
  function validateForm() {
    var valid = true;
    if (!$("#uname").val()) {
      $("#userUname-info").html("Required");
      valid = false;
    }
    if (!$("#name").val()) {
      $("#userName-info").html("Required");
      valid = false;
    }
     if (!$("#inputState").val()) {
       $("#usertype-info").html("Required");
       valid = false;
     }
    if (!$("#email").val()) {
      $("#userEmail-info").html("Required");
      valid = false;
    }
    if (
      !$("#email")
        .val()
        .match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)
    ) {
      $("#userEmail-info").html("Invalid");
      valid = false;
    }
    if (
      !$("#password")
        .val()
        .match(
          /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/
        )
    ) {
      $("#password-info").html(
        "Must contain 8 letters with Alphanum and Symbols"
      );
      valid = false;
    }
    return valid;
  }
});
