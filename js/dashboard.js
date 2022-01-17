$(document).ready(function () {
    var payload = localStorage.getItem("payload");
    function LoadDailyExpense(params) {
       let date = new Date();
       let day = date.getDate();
       let month = String(date.getMonth() + 1).padStart(2, "0");
       let year = date.getFullYear();

       let fullDate = `${year}-${month}-${day}`;

       var data = {
         functionName: "today",
         username: JSON.parse(payload).username,
         date: fullDate,
       };
       $.ajax({
         type: "GET",
         contentType: "application/json; charset=utf-8",
         dataType: "json",
         url: "dashboard.php",
         data: data,
         success: function (response) {
             $("#display_todays_expense").html(response.daily);
            //console.log("Daily",response);
         },
       });
    }
    
    function LoadMonthlyExpense(params) {
    //  setInterval(() => {
      var data = {
        functionName: "month",
        username: JSON.parse(payload).username,
      };
      $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "dashboard.php",
        data: data,
        success: function (response) {
          $("#display_monthly_expense").html(response.daily);
          //console.log("M",response);
        },
      });
      // });
    }
    function LoadBalance(params) {
      var data = {
        functionName: "balance",
        username: JSON.parse(payload).username,
      };
      $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "dashboard.php",
        data: data,
        success: function (response) {
          $("#display_actual_balance").html(response.balance);
          //console.log("B", response);
        },
      });
    }
    function CountBookMarks(params) {
      var data = {
        functionName: "bookmarks",
        username: JSON.parse(payload).username,
      };
      $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "dashboard.php",
        data: data,
        success: function (response) {
          $("#display_bookmarks").html(response.bookmark_count);
          //console.log("Bm", response);
        },
      });
    }
    function listPersonalExpense() {
      var data = {
        functionName: "personalExpense",
        username: JSON.parse(payload).username,
      };
      $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "dashboard.php",
        data: data,
        success: function (response) {
          // $("#display_bookmark").html(response.bookmark_count);
          let display = "";
          let total_amount = 0;
          for (var i = 0; i < response.length; i++) {
             total_amount += +response[i].amount;
            display += `
            <tr>
               <td>${i + 1}</td>
               <td>${response[i].description}</td>
               <td>${response[i].category}</td>
               <td>${response[i].date}</td>
               <td>${response[i].amount}</td>
               <td><div class="d-grid gap-2 d-md-block">
 <button type="button" onclick="handleEditexpense('${response[i].id}')" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button>
<button type="button" onclick="handleDeleteExpense('${response[i].id}')" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg></button>
</div></td>
             </tr>`;
          }
 display += `<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Total Amount</td>
          <td> <i class="fas fa-rupee-sign"></i>&nbsp;${total_amount}</td>
          </tr>`;
          $("#display_personal_expense_list").html(display);
          // //console.log("Expense", display);
        },
      });
    }
    function list_ALL_PersonalExpense() {
      var data = {
        functionName: "allPersonal_expense",
        username: JSON.parse(payload).username,
      };
      $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "dashboard.php",
        data: data,
        success: function (response) {
          // $("#display_bookmark").html(response.bookmark_count);
          let display = "";
          let total_amount=0
          for (var i = 0; i < response.length; i++) {
            total_amount += (+response[i].amount);
            display += `
            <tr>
               <td>${i + 1}</td>
               <td>${response[i].description}</td>
               <td>${response[i].category}</td>
               <td>${response[i].date}</td>
               <td>${response[i].amount}</td>
               
             </tr>
            `;
          }
          display += `<tr>
          <td></td>
          <td></td>
          <td></td>
          <td onclick="alert('wow')">Total Amount</td>
          <td> <i class="fas fa-rupee-sign"></i>&nbsp;${total_amount}</td>
          </tr>`;


          $("#displayall_personal_expense_list").html(display);
          //console.log("ALLExpense", total_amount);
          
        },
      });
    }
    function list_Room() {
      var data = {
        functionName: "showRoom",
        username: JSON.parse(payload).username,
      };
      $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "dashboard.php",
        data: data,
        success: function (response) {
          localStorage.setItem('room_name',response.room_name);
          let display = `
          <a class="nav-link collapsed" id="add_room_protcol" href="#" data-toggle="modal" data-target="#addmembers">
           <i class="fas fa-users"></i>
           <span class="badge rounded-pill bg-primary">${response.room_name}</span>
          <span>Add Members</span>
         </a>
         <a class="clickme nav-link collapsed" id="sharing_protocol_v2" data-id="Sharing,${response.room_name}" href="#" data-toggle="modal" onclick="handlepost_v2()" data-target="#addexpense">
           <i class="fas fa-plus"></i>
           <span class="badge rounded-pill bg-primary">${response.room_name}</span>
          <span>Add Expense</span>
         </a>
          <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#managemodal">
           <i class="fas fa-users"></i>
           <span>Manage ${response.room_name}</span>
         </a>`;
         
          // var cc=$("#foo").data("foo");
          // $("#exampleModalLabel123").html("dd");
             

         if (
           response.owner_name == JSON.parse(payload).username &&
           response.room_name!=null
         ) {
           $("#room_protcol").html(display);
         }
            if (response.room_name !=null)
            { $("#create_room_protcol").hide();
        }
          //console.log("Room", response);
        },
      });
    }
    function list_notification() {
      setInterval(() => {
        var data = {
          functionName: "notification",
          username: JSON.parse(payload).username,
        };

        $.ajax({
          type: "GET",
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          url: "dashboard.php",
          data: data,
          success: function (response) {
            $("#count_notification").html(response.length);
            let response_display = "";
            for (var i = 0; i < response.length; i++) {
              response_display += `<div class="dropdown-item d-flex align-items-center" >
                   <div class="mr-3">
                     <div class="icon-circle bg-info">
                       <i class="fas fa-users text-white"></i>
                     </div>
                   </div>
                   <div>
                     <div class="small text-gray-500"> ${response[i].date}</div>
                     ${response[i].message}
                   </div>
                   <button type="button" class="btn btn-outline-primary btn-sm ml-2 float-left" onclick="handle_join('${response[i].room_id}','${response[i].member}','${response[i].owner}')">Join</button>
                 </div>`;
            }
            $("#displaying_notifications").html(response_display);
            //console.log("ALLNotification", response);
          },
        });
      }, 5000);
    }
     function list_Room() {
      var data = {
        functionName: "showRoom",
        username: JSON.parse(payload).username,
      };
      $.ajax({
        type: "GET",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: "dashboard.php",
        data: data,
        success: function (response) {
          localStorage.setItem('room_name',response.room_name);
          let display = `
          <a class="nav-link collapsed" id="add_room_protcol" href="#" data-toggle="modal" data-target="#addmembers">
           <i class="fas fa-users"></i>
           <span class="badge badge-primary text-uppercase">${response.room_name}</span>
          <span>Add Members</span>
         </a>
         <a class="clickme nav-link collapsed" id="sharing_protocol_v2" data-id="Sharing,${response.room_name}" href="#" data-toggle="modal" onclick="handlepost_v2()" data-target="#addexpense">
           <i class="fas fa-plus"></i>
           <span class="badge badge-secondary text-uppercase">${response.room_name}</span>
          <span>Add Expense</span>
         </a>
          <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#managemodal" onclick="load_listsOfUSers('${response.room_name}')">
           <i class="fas fa-users"></i>
          <span>Manage  <span class="badge badge-warning text-uppercase" >${response.room_name}</span></span>
         </a>`;
         
          // var cc=$("#foo").data("foo");
          // $("#exampleModalLabel123").html("dd");
             

         if (
           response.owner_name == JSON.parse(payload).username &&
           response.room_name!=null
         ) {
           $("#room_protcol").html(display);
         }
            if (response.room_name !=null)
            { $("#create_room_protcol").hide();
              $("#checkExist").removeAttr("hidden");

        }
          //console.log("RoomCreatd", response);
        },
      });
    }
    // function to display joined room
     function list_joined_Room() {
       var data = {
         functionName: "showJoinedRoom",
         username: JSON.parse(payload).username,
       };
       $.ajax({
         type: "GET",
         contentType: "application/json; charset=utf-8",
         dataType: "json",
         url: "dashboard.php",
         data: data,
         success: function (response) {
           localStorage.setItem("joined_room_name", response.room_name);
           let display = `
          
         <a class="clickme nav-link collapsed" id="sharing_protocol_v2" data-id="Sharing,${response.room_name}" href="#" data-toggle="modal" onclick="handlepost_v2()" data-target="#addexpense">
           <i class="fas fa-plus"></i>
           <span class="badge badge-primary text-uppercase">${response.room_name}</span>
          <span>Add Expense</span>
         </a>
          <a class="nav-link collapsed text-capitalize" href="#" data-toggle="modal" data-target="#managemodal" onclick="load_listsOfUSers('${response.room_name}')">
           <i class="fas fa-users"></i>
           <span>Manage  <span class="badge badge-primary text-uppercase" >${response.room_name}</span></span>
         </a>
         `;

           // var cc=$("#foo").data("foo");
           // $("#exampleModalLabel123").html("dd");

           if (
             response.room_owner == JSON.parse(payload).username &&
             response.room_name != null
           ) {
             $("#room_protcol").html(display);
           }
           if (response.room_name != null) {
             $("#create_room_protcol").hide();
              $("#checkExist").removeAttr("hidden");
           }
           //console.log("RoomJoined", response);
         },
       });
      //  callinf list ajax
     
     }

    //  function for showing bookmark
    function list_bookmarks(params) {
     
       var data = {
         functionName: "showbookMarks",
         username: JSON.parse(payload).username,
       };
       $.ajax({
         type: "GET",
         contentType: "application/json; charset=utf-8",
         dataType: "json",
         url: "dashboard.php",
         data: data,
         success: function (response) {
          //console.log("Bookmark",response);
          let bookmark=``;
          let date = new Date()
            let day = date.getDate();
            let month = String(date.getMonth() + 1).padStart(2, "0");
            let year = date.getFullYear();

            let fullDate = `${year}-${month}-${day}`;
            //console.log(fullDate);
            if(response.length===0)
            {
              bookmark += `<div class="alert alert-warning alert-dismissible fade show ml-4" role="alert">
  <strong>Nothing to show</strong>.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
            }

          for (let i = 0; i < response.length; i++) {
            bookmark += ` <div class="col mb-4"><div class="card mr-2">
                   <div class="card-body">
                     <h5 class="card-title">
                       ${
                         response[i].name
                       }<span class="badge badge-primary float-right">${
              response[i].date === fullDate
                ? `Today`
                : response[i].date > fullDate
                ? "Upcoming"
                : `Older`
            }</span>
                     </h5>
                     <h5 class="badge badge-success" px-2 py-2><i class="fas fa-rupee-sign"></i>${
                       response[i].amount
                     }</h5>
                     <h5 class="badge badge-info">${response[i].date}</h5>
                     <p class="card-text">
                       ${response[i].description}
                     </p>
                     <button class="btn btn-outline-danger float-right" onclick="deleteBookmark('${
                       response[i].id
                     }')"><i class="fas fa-trash"></i></button>
                   </div>
                 </div></div>`;
            
          }
          $("#listPersonalBookmark").html(bookmark);
         },
        
       });
      
    }
    
    function listSharingExpense(params) {
      var userRoom=""
      if(localStorage.getItem("room_name")==="null"){
          userRoom = localStorage.getItem("joined_room_name");
           //console.log("ROOOOOOOOOOOOOOOOOMJoined", userRoom);
      }
      else{
        userRoom = localStorage.getItem("room_name");
         //console.log("ROOOOOOOOOOOOOOOOOMOwner", userRoom);
      }
     
       var data = {
         functionName: "SharingExpense",
         username: JSON.parse(payload).username,
         groupName: userRoom,
       };
       $.ajax({
         type: "GET",
         contentType: "application/json; charset=utf-8",
         dataType: "json",
         url: "dashboard.php",
         data: data,
         success: function (response) {
           // $("#display_bookmark").html(response.bookmark_count);
           let display = "";
           let total_amount = 0;
           for (var i = 0; i < response.length; i++) {
             total_amount += +response[i].amount;
             display += `
            <tr>
               <td>${i + 1}</td>
               <td>${response[i].username}</td>
               <td>${response[i].description}</td>
               <td>${response[i].category}</td>
               <td>${response[i].date}</td>
               <td>${response[i].amount}</td>`
              if(response[i].username===data.username){
                display+=`<td><div class="d-grid gap-2 d-md-block">
 <button type="button" onclick="handleEditexpense('${response[i].id}')" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button>
<button type="button" onclick="handleDeleteExpense('${response[i].id}')" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg></button>
</div></td>`
              }

                 
             display+=`</tr>`;
           }
           display += `<tr>
          <td></td>
          <td></td>
          <td></td>
           <td></td>
           <hr>
          <td class="table-dark">Total Amount</td>
          <td class="table-dark"> <i class="fas fa-rupee-sign"></i>&nbsp;${total_amount}</td>
          </tr>`;
           $("#myTable").html(display);
           //console.log("SharingExpenseList", response);
         },
         error:function(response){
           //console.log("SharingExpenseList", response);
         }
       });
    }

function fetch_currentBalance(params) {
   var data = {
     functionName: "currentBalance",
     username: JSON.parse(payload).username,
   };
   //console.log(data);
   $.ajax({
     type: "GET",
     contentType: "application/json; charset=utf-8",
     dataType: "json",
     url: "dashboard.php",
     data: data,
     success: function (response) {
       $("#current_bal").html(response.cb);
      //  //console.log("Bhkdshfjsdf", response);
     },
   });
  
}
function fetch_profile()
{
   
   var dataProfile = {
     functionName: "viewProfle",
     username: JSON.parse(payload).username,
   };
   $.ajax({
     type: "get",
     url: "dashboard.php",
     data: dataProfile,
     dataType: "json",
     success: function (response) {
       let passdata = ` <h4 class="mb-0 mt-0">${response[0].name}<sup>${response[0].username}<sup></h4> <span class="text-uppercase">${response[0].role}</span><br>
                     <span>${response[0].email}</span>`;
                     $("#information").html(passdata);
                     $("#output").attr("src", `upload/${response[0].profile}`);
                     $("#upperDP").attr("src", `upload/${response[0].profile}`);


     },
     error:function (param) {
       //console.log(param);
       }
   });
}
fetch_profile();
    // calling entire function to display
    fetch_currentBalance();
listSharingExpense();
    list_bookmarks();
     list_joined_Room();
    list_notification();
list_Room();
    list_ALL_PersonalExpense();
    listPersonalExpense();
    CountBookMarks();
    LoadBalance();
    LoadDailyExpense();
    LoadMonthlyExpense();
});
function handleEditexpense(params) {
  //console.log(params);
  var EditFormData = {
    functionName: "LoadData",
    paramsa: params,
  };
  // $("#addexpense").modal("show");
var myModal = new bootstrap.Modal(document.getElementById("editExpense"), {
  keyboard: false,
});
myModal.show();
  $.ajax({
    type: "post",
    url: "edit.php",
    data: EditFormData,
    dataType: "json",
    encode: true,
  })

    .done(function (data) {
      //console.log("Editt",data);
      $("#edit_description").val(`${data[0].description}`);
      $("#edit_category").val(`${data[0].category}`);
       $("#edit_expense_date").val(`${data[0].date}`);
       $("#edit_expense_amount").val(`${data[0].amount}`);
       $("#edit_id_of_viewing_expense").val(`${data[0].id}`);
       $("#edit_id_of_viewing_expense_type").val(`${data[0].exp_type}`);

       


      
    })
    .fail(function (data) {
      //console.log("Failed");
    });

}
function handleDeleteExpense(id) {
  //console.log(id);
   var payload = localStorage.getItem("payload");
  var DeleteFormData = {
    functionName: "DeleteData",
    paramsa: id,
    username: JSON.parse(payload).username,
  };  
  $.ajax({
    type: "post",
    url: "deleteApi.php",
    data: DeleteFormData,
    dataType: "json",
    encode: true,
  })

    .done(function (data) {
      //console.log("Delete", data);
      if(data.Deletestatus=true)
      {
        $.getScript("js/dashboard.js", function () {
          // //console.log("Deleted");
        });
      }
    })
    .fail(function (data) {
      //console.log("Failed");
    });
}
