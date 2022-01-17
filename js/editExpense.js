// edit expense
$(document).ready(function () {
    $("#EditExpenseFrom").submit(function (e) {
      var load = localStorage.getItem("payload");

    //   var expense_id = $("#edit_id_of_viewing_expense_type").val();
    //   var expense_desc = $("#edit_description").val();
    //   var expense_category = $("#edit_category").val();
    //   var expense_date = $("#edit_expense_date").val();
    //   var expense_amt = $("#edit_expense_amount").val();

      //  var type = expense_type.split(",");

      var EditformData = {
        type: $("#edit_id_of_viewing_expense_type").val(),
        id: $("#edit_id_of_viewing_expense").val(),
        desc: $("#edit_description").val(),
        catagory: $("#edit_category").val(),
        date: $("#edit_expense_date").val(),
        amount: $("#edit_expense_amount").val(),
        gname:localStorage.getItem("room_name")=="null"?
        localStorage.getItem("joined_room_name"):localStorage.getItem("room_name"),
        username: JSON.parse(load).username,
        functionName: "editChange",
      };
      //  var check = validateForm();
      if (
        EditformData.amount != "" &&
        EditformData.catagory != "" &&
        EditformData.date != "" &&
        EditformData.desc!=""

      )
      {
           $("#edit_span_type").html("");
        //console.log(EditformData);

      //  if (check) {
      $.ajax({
        type: "post",
        url: "edit.php",
        data: EditformData,
        dataType: "json",
        encode: true,
      })

        .done(function (data) {
          
          if(data.status===true)
          {
              
             $('#editExpense').modal('hide')

              //console.log(data);
          }
          
        })
        .fail(function (data) {
          //console.log("ERRjdROR",data);
        });
       }else{
           
           $("#edit_span_type").html("Fields Cannot Be Empty");
       }
      e.preventDefault();

    });
    

});
