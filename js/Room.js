$(document).ready(function () {


  $("#api_createRoom").submit(function (e) {
      var data=validateForm();

      if(data)
      {
           $("#span_group_name").html("");
    var load = localStorage.getItem("payload");
$("#create_room").text("Creating..");
    var formData = {
      desc: $("#group_name").val().toLowerCase(),
      functionName:"createRoom",
      username: JSON.parse(load).username,
    };
    
      $.ajax({
        type: "post",
        url: "room_auth.php",
        data: formData,
        dataType: "json",
        encode: true,
      })

        .done(function (data) {
          //console.log(data);
          if (data.status === false) {
            $("#span_group_name").html(data.message);
            $("#create_room").text("Create");
            jQuery("#create_room").attr("disabled", false);
          }
          if (data.status === true) {
            jQuery("#api_createRoom")["0"].reset();
            jQuery("#create_room").attr("disabled", false);
            $("#create_room").text("Create");
            localStorage.setItem("room_authority","room_owner")
          setTimeout(() => {
            window.location.reload();
          }, 1000);
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          }
        })
        .fail(function (data) {
          $("#span_group_name").html("Something Went Wrong");
        jQuery("#api_createRoom")["0"].reset();
          $("#create_room").text("Create");
          jQuery("#create_room").attr("disabled", false);
        });
    }
    e.preventDefault();
  });
  function validateForm() {
    var valid = true;
    if (!$("#group_name").val().trim()) {
      $("#span_group_name").html("Name Required");
      valid = false;
    }
    //  if ($("#group_name").val().trim() === "") {
    //    $("#span_group_name").html("Name Required");
    //    valid = false;
    //  } 
     return valid;
  }
   
});
