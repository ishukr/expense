$(document).ready(function () {

    $("#ExpenseFrom").submit(function (e) {

var load=localStorage.getItem('payload');


 var expense_type=$("#id_of_viewing_expense_type").val();
 var type=expense_type.split(',');
 var formData = {
   desc: $("#description").val(),
   type: $("#select_category").val(),
   date: $("#expense_date").val(),
   amount: $("#expense_amount").val(),
   expense_type: type[0],
   g_name:type[1]||'',
   username: JSON.parse(load).username,
 };
 var check = validateForm();
 //console.log(formData);


 if (check) {
   $("#span_desc").html("");
   $("#span_type").html("");
   $("#span_date").html("");
   $("#span_amount").html("");
   $("#add_expense").text("Please Wait..");
   $("#add_expense").attr("disabled", true);
   $.ajax({
     type: "post",
     url: "addexpense.php",
     data: formData,
     dataType: "json",
     encode: true,
   })

     .done(function (data) {
       //console.log(data);
       if (data.status === false) {
         $("#response_message").html(data.message);
         $("#add_expense").text("Add");
         jQuery("#add_expense").attr("disabled", false);
          $.getScript('js/dashboard.js', function() {
            //  //console.log("Added");
           });
       }
       if (data.status === "failed")
       {
          // window.location.reload();
       }
         if (data.status === true) {
           jQuery("#ExpenseFrom")["0"].reset();
           jQuery("#add_expense").attr("disabled", false);
           $("#add_expense").text("Add");
           //  window.location = "index.php";
            $.getScript("js/dashboard.js", function () {
              // //console.log("Added");
            });
         }
     })
     .fail(function (data) {
       $("#response_message").html(`Something Went Wrong <button class="btn btn-warning" onClick="window.location.reload();">Click Me To Reload</button>`);
       jQuery("#ExpenseFrom")["0"].reset();
       $("#add_expense").text("Add");
       jQuery("#add_expense").attr("disabled", false);
     });
 }
e.preventDefault();
    });
    function validateForm() {
    var valid = true;
    if (!$("#description").val()) {
      $("#span_desc").html("Description Required");
      valid = false;
    }
    if (!$("#select_category").val()) {
      $("#span_type").html("Category Required");
      valid = false;
    }
    if (!$("#expense_date").val()) {
      $("#span_date").html("Date Required");
      valid = false;
    }
    if (!$("#expense_amount").val()) {
      $("#span_amount").html("Amount Required");
      valid = false;
    }
    return valid;
}

});
