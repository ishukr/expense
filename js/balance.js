$(document).ready(function () {
    $("#add_balance").submit(function (e) {
         var load = localStorage.getItem("payload");
 $("#add_my_balance").text("Wait..");
 
   
         var formData = {
           balance: $("#input_balance").val(),
           username: JSON.parse(load).username,
         };

        //  if(formData.balance=="")
        //  {
        //    $("#span_error_balance").html("Balance Required");
        //    break;
           
           
        //  }
          $.ajax({
            type: "post",
            url: "balance.php",
            data: formData,
            dataType: "json",
            encode: true,
          })

            .done(function (data) {
              //console.log(data);
              if (data.status === false) {
                $("#span_error_balance").html(data.update);
                $("#add_my_balance").text("Add");
                jQuery("#add_my_balance").attr("disabled", false);
              }
              if (data.status === true) {
                jQuery("#add_balance")["0"].reset();
                jQuery("#add_my_balance").attr("disabled", false);
                $("#add_my_balance").text("Add");
                 $("#span_error_balance").html(data.update);
                window.location.reload()
               
              }
            })
            .fail(function (data) {
              $("#response_message").html("Something Went Wrong");
              jQuery("#login")["0"].reset();
              $("#login_submit").text("Add");
              jQuery("#login_submit").attr("disabled", false);
            });
    
      e.preventDefault();
    });
});