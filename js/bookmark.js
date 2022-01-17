$(document).ready(function () {
  $("#form_bookmark").submit(function (e) {
    var load = localStorage.getItem("payload");
    
    var formData = {
      desc: $("#desc").val(),
      name: $("#name").val(),
      date: $("#date").val(),
      amount: $("#amount").val(),
      username: JSON.parse(load).username,
    };
    
var check = validateForm();

//console.log(formData);
    if (check) {
        
      $("#span_desc_bookmark").html("");
      $("#span_name_bookmark").html("");
      $("#span_date_bookmark").html("");
      $("#span_amount_bookmark").html("");
      $("#add_bookmark").text("Please Wait..");
      $("#add_bookmark").attr("disabled", true);
      $.ajax({
        type: "post",
        url: "bookmark.php",
        data: formData,
        dataType: "json",
        encode: true,
      })

        .done(function (data) {
          //console.log(data);
          if (data.status === false) {
            $("#response_message").html(data.message);
            $("#add_bookmark").text("Add");
            jQuery("#add_bookmark").attr("disabled", false);
          }
          if (data.status === true) {
            jQuery("#form_bookmark")["0"].reset();
            jQuery("#add_bookmark").attr("disabled", false);
            $("#add_bookmark").text("Add");
            $.getScript("js/dashboard.js", function () {
              //console.log("Deleted");
            });
            // window.location = "index.php";
          }
        })
        .fail(function (data) {
          $("#response_message").html("Something Went Wrong");
          jQuery("#form_bookmark")["0"].reset();
          $("#login_submit").text("Add");
          jQuery("#login_submit").attr("disabled", false);
        });
    }
    e.preventDefault();
  });
  function validateForm() {
    var valid = true;
    if (!$("#desc").val()) {
      $("#span_desc_bookmark").html("Description Required");
      valid = false;
    }
    if (!$("#name").val()) {
      $("#span_name_bookmark").html("Name Required");
      valid = false;
    }
    if (!$("#date").val()) {
      $("#span_date_bookmark").html("Date Required");
      valid = false;
    }
    if (!$("#amount").val()) {
      $("#span_amount_bookmark").html("Amount Required");
      valid = false;
    }
     if ($("#amount").val()==='0') {
       $("#span_amount_bookmark").html("Invalid Amount");
       valid = false;
     }
    var checkamount = $("#amount").val();

   
    return valid;
  }
});
