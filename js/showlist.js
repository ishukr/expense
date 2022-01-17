function load_listsOfUSers(params) {
  var load = localStorage.getItem("payload");
  // //console.log("!", params);
  var Formdata = {
    roomName: params,
  };
  $.ajax({
    type: "post",
    url: "listUsers.php",
    data: Formdata,
    dataType: "json",
    encode: true,
  })

    .done(function (response) {
      //console.log("Response",response);
      let usersDisplay = "";
      let OwnerDisplay = `
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Your Entire Expense Record Will Be Deleted!<br> Please Take Backup Before Deleting</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
       if (response.length == 0) {
         usersDisplay += `<span class="badge badge-primary mr-2">No one is here</span>`;
          $("#display_members_list").hide();
       }
      
      for (let i = 0; i < response.length; i++) {
 usersDisplay += `<span class="badge badge-success mr-2 px-2 py-2">${response[0].owner}</span>`;
        if (JSON.parse(load).username == response[i].owner) {
          OwnerDisplay += `<li class="list-group-item py-1 text-uppercase" aria-disabled="true">${response[i].member}
                <button type="button" class="btn btn-outline-danger btn-sm float-right"onclick="handle_kick('${response[i].room_id}',
                '${response[i].member}','${response[i].owner}')" >Remove</button></li>`;
          $("#display_members_list").hide();
        } else {
          usersDisplay += `<span class="badge badge-primary mr-2">${response[i].member}</span>
          `;
          $("#display_members_list_owner").hide();
        }
      }
          
      // usersDisplay += `<button type="button" class="btn btn-outline-primary float-right mt-4" id="hide-only-owner" onclick="handle_leaveRoom()">Leave Room</button>`;
      OwnerDisplay += `<button type="button" class="btn btn-outline-primary mt-2" onclick="handle_deleteRoom()" >Delete Room</button>`;
      $("#display_members_list").html(usersDisplay);
      $("#display_members_list_owner").html(OwnerDisplay);
    })
    .fail(function (data) {
      //console.log(data);

      //   $("#span_group_name").html("Something Went Wrong");
      //   jQuery("#login")["0"].reset();
      //   $("#create_room").text("Create");
      //   jQuery("#create_room").attr("disabled", false);
    });
  // alert(params)
}

