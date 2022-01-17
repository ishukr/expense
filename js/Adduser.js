
     $(document).ready(function() {

      var payload = localStorage.getItem("payload");
      $("#users_search_members").keyup(function() {

        var username = $(this).val().trim();

        if (username != '' && username.length>0) {
          $.ajax({
            url: "addfriend.php",
            type: "POST",
            dataType: "json",
            data: {
              key: username,
              ownername: JSON.parse(payload).username,
              roomName: localStorage.getItem("room_name"),
            },
          })
            .done((response) => {
              //console.log(response);
              let dummy = "";
              for (var i = 0; i < response.length; i++) {
                dummy += `<div class="alert alert-primary " role="alert">
  ${response[i].username}
  <img src="upload/${response[i].profile}" class="rounded float-left mr-1" onerror="this.src='images/user.png';" width="50px" height="50px" alt="...">
  <button type="button" class="btn btn-outline-primary btn-sm float-right" id="isaddedRequest" onclick="handle('${response[i].username}')">ADD</button>
  <div id="spinner_load"></div>
</div>`;
              }
              $("#displayallusers_list").html(dummy);
            })
            .fail((data) => {
              nullify = `No user found`;
              $("#displayallusers_list").html(nullify);
            });
        } else {
          
          $("#displayallusers_list").html("");
        }

      });

    });