 <?php
  session_start();
  include('dbConnection.php');
  // ((!($_SESSION['name'])) == true)?header('Location: login.php'):"";        
  ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description" content="" />
   <meta name="author" content="" />

   <title>Expense</title>

   <!-- Custom fonts for this template-->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

   <!-- Custom styles for this template-->
   <link href="css/expense.min.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <!-- exporting -->

   <style>
     table * {
       white-space: nowrap;
     }
   </style>
   <script>
     var data = localStorage.getItem('payload');
     var d = JSON.parse(data);
     //console.log(d.email)
   </script>
   <style>
     input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
       -webkit-appearance: none;
       margin: 0;
     }

     input[type=number] {
       -moz-appearance: textfield;
     }
   </style>
   <script src="js/enctype.js"></script>
 </head>

 <body id="page-top">
   <!-- Page Wrapper -->
   <div id="wrapper">
     <!-- Sidebar -->
     <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #180f3b" id="accordionSidebar">
       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
           <i class="fas fa-wallet"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Expense<sup>Manager </sup></div>
       </a>

       <!-- Divider -->
       <hr class="sidebar-divider my-0" />

       <!-- Nav Item - Dashboard -->
       <li class="nav-item active">
         <a class="nav-link" href="index.php">
           <i class="fab fa-dashcube"></i>
           <span>Dashboard</span></a>
       </li>

       <!-- Divider -->
       <hr class="sidebar-divider" />

       <!-- Heading -->
       <div class="sidebar-heading">Interface</div>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="#" id="sharing_protocol_v1" data-id="Personal" onclick="handlepost_v1()" data-toggle="modal" data-target="#addexpense">
           <i class="fas fa-plus-square"></i>
           <span>Add Expense</span>
         </a>
       </li>
       <li class="nav-item">
         <a class="nav-link collapsed" href="allexpense.php">
           <i class="fas fa-eye"></i>
           <span>View all expense</span>
         </a>
       </li>


       <!-- Divider -->
       <hr class="sidebar-divider" />

       <!-- Heading -->
       <div class="sidebar-heading">Extras</div>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#bookmark">
           <i class="fas fa-bookmark"></i>
           <span>Bookmark</span>
         </a>
       </li>
       <hr class="sidebar-divider" />
       <div class="sidebar-heading" id="gro">Extras</div>
       <li class="nav-item">
         <a class="nav-link collapsed" id="create_room_protcol" href="#" data-toggle="modal" data-target="#createroom">
           <i class="fas fa-users"></i>
           <span>Create Room</span>
         </a>




         <span id="room_protcol"></span>

       </li>

       <!-- Divider -->
       <hr class="sidebar-divider d-none d-md-block" />

       <!-- Sidebar Toggler (Sidebar) -->
       <div class="text-center  d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>
     </ul>
     <!-- End of Sidebar -->
     <div class="modal fade" id="managemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Members</h5>

             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div id="alertme"></div>
           <div class="modal-body" id="render_modal">
             <span class="badge badge-warning" id="removedmsg"></span>

             <div class="card-body shadow" id="display_members_list">

             </div>
             <ul class="list-group" id="display_members_list_owner">
             </ul>
             <hr>


           </div>

           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           </div>
         </div>
       </div>
     </div>
     <!-- modal fro add friends -->
     <div class="modal fade" id="createroom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Create Room</h5>

           </div>
           <div class="modal-body">
             <form method="POST" id="api_createRoom">
               <div class="form-floating mb-3">
                 <span class="badge bg-danger text-white" id="span_group_name"></span>
                 <label for="floatingInput">Group name <span id="idHolder"></span> </label>
                 <input type="text" class="form-control" id="group_name" placeholder="EnterGroup name">
                 <button type="submit" id="create_room" class="btn btn-primary mt-3 float-right">Create</button>
                 <button class="btn btn-secondary mt-3" data-dismiss="modal">Close</button>
               </div>
             </form>
           </div>

         </div>
       </div>
     </div>
     <!-- room maodal -->
     <div class="modal fade" id="addmembers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Add members</h5>

           </div>
           <div class="modal-body">
             <div id="already_sent"></div>
             <form id="searching_users" method="post">
               <div class="search-box form-floating mb-3">
                 <label for="floatingInput">Search </label>
                 <input type="text" id="users_search_members" autocomplete="off" class="form-control mb-2" id="floatingInput" placeholder="Search users">
                 <div id="loadingScreen"></div>
                 <span id="displayallusers_list"></span>

               </div>
             </form>

             <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
           </div>
         </div>
       </div>
     </div>
     <!-- addmembers -->
     <div class="modal fade" id="bookmark" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog modal-xl modal-dialog-scrollable">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">
               Expense Bookmark
             </h5>

             <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target="#addbookmark" aria-expanded="false" aria-controls="addbookmark">
               Add Bookmark
             </button>
           </div>
           <div class="modal-body">
             <div class="collapse" id="addbookmark">
               <div class="card card-body">
                 <form method="POST" id="form_bookmark">
                   <div class="row">

                     <div class="col">
                       <span class="badge bg-danger text-white" id="span_name_bookmark"></span>
                       <label>Name</label>
                       <input type="text" id="name" class="form-control" placeholder="Name" />
                     </div>

                     <div class="col">
                       <span class="badge bg-danger text-white" id="span_amount_bookmark"></span>
                       <label>Amount</label>
                       <input type="number" id="amount" class="form-control" placeholder="Amount" />
                     </div>
                   </div>
                   <div class="row py-2">

                     <div class="col">
                       <span class="badge bg-danger text-white" id="span_date_bookmark"></span>
                       <label>Date</label>
                       <input type="date" id="date" class="form-control" placeholder="Date" />
                     </div>

                     <div class="col">
                       <span class="badge bg-danger text-white" id="span_desc_bookmark"></span>
                       <label>Note</label>
                       <input type="text" id="desc" class="form-control" placeholder="Enter Note" />
                     </div>
                   </div>
                   <button type="submit" id="add_bookmark" class="btn btn-primary float-right">
                     Add
                   </button>
                 </form>
               </div>
             </div>

             <!-- card data -->
             <div class="row row-cols-1 row-cols-md-2" id="listPersonalBookmark">



             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">
               Close
             </button>
           </div>
         </div>
       </div>
     </div>
     <!-- modal for book mark -->

     <div class="modal fade" id="addexpense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header py-2">
             <h5 class="modal-title">Add Expense <small id="id_of_viewing_expense_type_text"></small>
             </h5>

             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <div id="response_message" class="badge bg-warning text-dark mb-3 ms-4"></div>
             <form class="row" id="categoryFrom">
               <div class="col-auto">
                 <span class="badge bg-danger text-white" id="span_error"></span>
                 <input type="text" class="form-control" id="Acategory" placeholder="Add Category">
               </div>

               <div class="col-auto">

                 <button class="btn btn-primary mb-3" id="addCategory">Add</button>
               </div>
               <div class="container card-body shadow" id="list_categories">

               </div>
             </form>
             <form method="post" id="ExpenseFrom">
               <div class="row">
                 <div class="col">
                   <input type="hidden" name="" value="" id="id_of_viewing_expense_type">
                   <span class="badge bg-danger text-white" id="span_desc"></span>
                   <label for="description">Description</label>

                   <input type="text" name="description" id="description" class="form-control" placeholder="Enter Note" aria-label="Enter Note">
                 </div>
                 <div class="col">
                   <span class="badge bg-danger text-white" id="span_type"></span>
                   <label for="description">Category</label>
                   <select id="select_category" name="select_category" class="form-control">

                   </select>
                 </div>
               </div>
               <div class="row pt-2">
                 <div class="col">
                   <span class="badge bg-danger text-white" id="span_date"></span>
                   <label for="date">Date</label>
                   <input type="date" name="expense_date" id="expense_date" class="form-control" placeholder="Enter Date" aria-label="Enter Date">
                 </div>
                 <div class="col">
                   <span class="badge bg-danger text-white" id="span_amount"></span>
                   <label for="amount">Amount</label>
                   <input type="number" id="expense_amount" name="expense_date" class="form-control" placeholder="Enter Amount" aria-label="Enter Amount">
                 </div>
               </div>
               <div class="float-right pt-2">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="(e)=>{dispose()}">Close</button>
                 <button type="submit" id="add_expense" class="btn btn-primary">
                   Add
                 </button>
               </div>
             </form>
           </div>

         </div>
       </div>
     </div>
     <!-- expense for sharing -->

     <!-- add members -->
     <div class="modal fade" id="editExpense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <!-- <h5 class="modal-title" id="exampleModalLabel">Editing</h5> -->
             <h5 class="badge bg-danger text-white" style="align-self: center;" id="edit_span_type"></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           </div>
           <div class="modal-body">
             <form method="post" id="EditExpenseFrom">

               <div class="row">
                 <div class="col">
                   <input type="hidden" name="" value="" id="edit_id_of_viewing_expense">
                   <input type="hidden" name="" value="" id="edit_id_of_viewing_expense_type">
                   <span class="badge bg-danger text-white" id="span_desc"></span>
                   <label for="description">Description</label>

                   <input type="text" name="description" id="edit_description" class="form-control" placeholder="Enter Note" aria-label="Enter Note">
                 </div>
                 <div class="col">

                   <label for="description">Category</label>
                   <input type="text" name="description" id="edit_category" class="form-control" placeholder="Enter Category">
                 </div>
               </div>
               <div class="row pt-2">
                 <div class="col">
                   <span class="badge bg-danger text-white" id="span_date"></span>
                   <label for="date">Date</label>
                   <input type="date" name="expense_date" id="edit_expense_date" class="form-control" placeholder="Enter Date" aria-label="Enter Date">
                 </div>
                 <div class="col">
                   <span class="badge bg-danger text-white" id="span_amount"></span>
                   <label for="amount">Amount</label>
                   <input type="number" id="edit_expense_amount" name="expense_date" class="form-control" placeholder="Enter Amount" aria-label="Enter Amount">
                 </div>
               </div>
               <div class="float-right pt-2">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="(e)=>{dispose()}">Close</button>
                 <button type="submit" id="add_expense" class="btn btn-primary">
                   Edit
                 </button>
               </div>
             </form>
           </div>

         </div>
       </div>
     </div>
     <!-- view expenses -->

     <!-- Content Wrapper -->
     <div id="content-wrapper" class="d-flex flex-column">
       <!-- Main Content -->
       <div id="content">
         <!-- Topbar -->
         <nav class="
              navbar navbar-expand navbar-light
              bg-white
              topbar
              mb-4
              static-top
              shadow
            ">
           <!-- Sidebar Toggle (Topbar) -->
           <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
             <i class="fa fa-bars"></i>
           </button>

           <!-- Topbar Navbar -->
           <ul class="navbar-nav ml-auto">
             <!-- Nav Item - Search Dropdown (Visible Only XS) -->


             <!-- Nav Item - Alerts -->
             <li class="nav-item dropdown no-arrow mx-1">
               <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-bell fa-fw"></i>
                 <!-- Counter - Alerts -->
                 <span class="badge badge-danger badge-counter" id="count_notification"></span>
               </a>
               <!-- Dropdown - Alerts -->
               <div class="
                    dropdown-list dropdown-menu dropdown-menu-right
                    shadow
                    animated--grow-in
                  " id="displaying_notifications" aria-labelledby="alertsDropdown">
                 <h6 class="dropdown-header">Notifications</h6>


               </div>
             </li>




             <div class="topbar-divider d-none d-sm-block"></div>

             <!-- Nav Item - User Information -->
             <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                 <img class="img-profile rounded-circle" id="upperDP" onerror="this.src='images/user.png';">
               </a>
               <!-- Dropdown - User Information -->
               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" data-toggle="modal" data-target="#profileModal">
                   <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                   Profile
                 </a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cpModal">
                   <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                   Change Password
                 </a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                   <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                   Logout
                 </a>
               </div>
             </li>
           </ul>
         </nav>
         <!-- End of Topbar -->
         <div class="modal fade" id="cpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">

                 <h5 class="modal-title" id="exampleModalLabel">Change Password<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form method="post" id="changePassword">
                   <span id="Cpassword-info" class="badge bg-info text-white"></span>
                   <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i></span>
                     </div>
                     <input type="text" aria-label="CP" id="CPass" class="form-control" placeholder="Current Password">
                     <input type="text" aria-label="NP" id="NPass" class="form-control" placeholder="New Password">
                   </div>
                   <button type="submit" class="btn btn-primary mt-2 float-right" id="updating">Update</button>

                 </form>
               </div>


               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

               </div>
             </div>
           </div>
         </div>
         <div class="modal fade" id="profileModal" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-body">

                 <div class="d-flex align-items-center">
                   <div class="image"> <img id="output" src="upload/" class="rounded" width="155" onerror="this.src='images/user.png';"> </div>
                   <div class="ml-3 w-100">
                     <div id="information"></div>
                     <div class="button mt-2 d-flex flex-row align-items-center">
                       <!--default html file upload button-->
                       <form id="callingUpload" method="post">
                         <input type="hidden" name="username" id="uploadUsername">
                         <input type="file" id="actual-btn" name="photo" hidden accept="image/*" onchange="loadFile(event)" />


                         <!--our custom file upload button-->
                         <label for="actual-btn" style="background-color: indigo;color: white;padding: 0.5rem;font-family: sans-serif;border-radius: 0.3rem;cursor: pointer;margin-top: 1rem;">Change Pic</label>
                         <input type="submit" id="submit" value="Upload" disabled class="btn btn-info" />
                       </form>
                     </div>
                   </div>

                 </div>
               </div>
               <div class="modal-footer p-0">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
             </div>
           </div>
         </div>
         <!-- Begin Page Content -->
         <div class="container-fluid">
           <!-- Page Heading -->
           <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

           </div>
           <input type="hidden" name="user_name" value="ishu">
           <!-- Content Row -->

           <div class="row">
             <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-primary shadow h-100 py-2">
                 <div class="card-body">
                   <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                       <div class="
                            text-xs
                            font-weight-bold
                            text-primary text-uppercase
                            mb-1
                          ">
                         Expenditures(Today's)
                       </div>
                       <div class="h5 mb-0 font-weight-bold text-gray-800">
                         <i class="fas fa-rupee-sign"></i><span id="display_todays_expense"></span>
                       </div>
                     </div>
                     <div class="col-auto">
                       <i class="fas fa-calendar-day fa-3x text-gray-300"></i>


                     </div>
                   </div>
                 </div>
               </div>
             </div>

             <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-primary shadow h-100 py-2">
                 <div class="card-body">
                   <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                       <div class="
                            text-xs
                            font-weight-bold
                            text-primary text-uppercase
                            mb-1
                          ">
                         Expenditures(Monthly)
                       </div>
                       <div class="h5 mb-0 font-weight-bold text-gray-800">
                         <i class="fas fa-rupee-sign"></i><span id="display_monthly_expense"></span>
                       </div>
                     </div>
                     <div class="col-auto">
                       <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                     </div>
                   </div>
                 </div>
               </div>
             </div>




             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-info shadow h-100 py-2">
                 <div class="card-body">
                   <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                       <div class="
                            text-xs
                            font-weight-bold
                            text-info text-uppercase
                            mb-1
                          ">
                         Budget
                       </div>
                       <div class="row no-gutters align-items-center">
                         <div class="col-auto">
                           <div class="
                                h5
                                mb-0
                                mr-3
                                font-weight-bold
                                text-gray-800
                              ">
                             <i class="fas fa-rupee-sign"></i> <span id="display_actual_balance"></span>

                           </div>
                         </div>


                       </div>
                       <div class="
                            text-xs
                            font-weight-bold
                            text-info text-uppercase
                            mb-1
                          ">
                         Current Balance
                         <div class="
                              h6
                                mb-0
                                mr-3
                                font-weight-bold
                                text-gray-800
                              ">
                           <i class="fas fa-rupee-sign"></i> <span id="current_bal"></span>

                         </div>
                       </div>
                       <a href="#" class="badge bg-primary text-white" data-bs-toggle="modal" data-bs-target="#addMoney" style=" position: absolute;bottom: -20px; left: 160px;">Add Budget</a>
                       <!-- modal for add  money -->
                       <div class="modal fade" id="addMoney" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Add Your Budget</h5>
                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             </div>
                             <div class="modal-body">

                               <form id="add_balance" method="POST">
                                 <span class="badge bg-warning text-white mb-2" id="span_error_balance"></span>
                                 <div class="col-auto">

                                   <label for="balance" class="visually-hidden">Add Budget</label>
                                   <input type="number" class="form-control" id="input_balance" placeholder="Enter Budget ">
                                 </div>
                                 <button type="submit" id="add_my_balance" class="btn btn-primary mt-3 float-right">Add</button>

                               </form>
                             </div>

                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="col-auto">
                       <i class="fas fa-wallet fa-2x text-gray-300"></i>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <!-- Bookmarks Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-warning shadow h-100 py-2">
                 <div class="card-body" data-toggle="modal" data-target="#bookmark">
                   <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                       <div class="
                            text-xs
                            font-weight-bold
                            text-warning text-uppercase
                            mb-1
                          ">
                         Bookmarks
                       </div>
                       <div class="h5 mb-0 font-weight-bold text-gray-800">
                         <span id="display_bookmarks"></span>

                       </div>
                     </div>
                     <div class="col-auto">
                       <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>

           <!-- Content Row -->

           <div class="row">
             <!-- Area Chart -->
             <div class="col-xl col-lg-7">
               <div class="card shadow mb-4">
                 <!-- Card Header - Dropdown -->
                 <div class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">
                   <h6 class="m-0 font-weight-bold text-primary">
                     Monthly Expenditure Overview
                   </h6>
                   <div class="dropdown no-arrow">
                     <div class="dropdown no-arrow">
                       <div class="d-grid gap-2 d-md-block">

                         <button class="btn btn-primary btn-sm" type="button" id="generatePersonal" onclick="generate()">
                           <i class="fas fa-download fa-sm text-white-50"></i>Monthly Report</button>

                       </div>
                     </div>

                   </div>
                 </div>
                 <!-- Card Body -->

                 <!-- monthly data -->
                 <div class="table-responsive" style="max-height:300px;">
                   <table class=" table" id="dataPersonal">
                     <thead>
                       <tr class="table-info">
                         <th>#</th>
                         <th>Description</th>
                         <th>Category</th>
                         <th>Date</th>
                         <th>Amount</th>
                       </tr>
                     </thead>
                     <tbody id="display_personal_expense_list">


                     </tbody>
                   </table>
                 </div>

               </div>
             </div>

             <!-- Pie Chart -->
             <div class="col-xl col-lg-7">
               <div class="card shadow mb-4" id="checkExist" hidden="true">
                 <!-- Card Header - Dropdown -->
                 <div class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">

                   <h6 class="m-0 font-weight-bold text-primary">
                     Monthly Sharing Expenditure Overview


                   </h6>

                   <div class="dropdown no-arrow">
                     <a class="
                  d-sm-inline-block
                  btn btn-sm btn-primary
                  shadow-sm
                  float-right
                " id="generateSharing"><i class="fas fa-download fa-sm text-white-50" onclick="generate()"></i> Generate
                       Report</a>
                   </div>
                 </div>
                 <!-- Card Body -->

                 <!-- monthly data -->

                 <div class="table-responsive" id="sharing" style="max-height:300px;">
                   <table class="table table-bordered" id="tab_sharing" cellspacing="0">
                     <thead>
                       <tr class="table-info">
                         <th scope="col">#</th>
                         <th scope="col">Name</th>
                         <th scope="col">Description</th>
                         <th scope="col">Category</th>
                         <th scope="col">Date</th>
                         <th scope="col">Amount</th>
                       </tr>
                     </thead>
                     <tbody id="myTable">
                     </tbody>
                   </table>
                 </div>

               </div>
             </div>
           </div>


         </div>
         <!-- /.container-fluid -->
       </div>
       <!-- End of Main Content -->

       <!-- Footer -->
       <footer class="sticky-footer bg-white">
         <div class="container my-auto">
           <div class="copyright text-center my-auto">
             <span>Copyright &copy; Expense Manager 2022</span>
           </div>
         </div>
       </footer>
       <!-- End of Footer -->
     </div>
     <!-- End of Content Wrapper -->
   </div>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">
           Select "Logout" below if you are ready to leave.
         </div>
         <div class="modal-footer">
           <button class="btn btn-secondary" type="button" data-dismiss="modal">
             Cancel
           </button>
           <a class="btn btn-primary" onclick="logmeOut()">Logout</a>
         </div>
       </div>
     </div>
   </div>
   <!-- toast modal -->
   <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; top: 0;">
     <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
       <div class="toast-header">

         <strong class="mr-auto">Hey there</strong>
         <small></small>
         <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="toast-body">
         You Cannot Join Any Room,Since Your are already in room<br>
         Thank You!!
       </div>
     </div>
   </div>


   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="js/category.js"></script>
   <script src="js/expense.js"></script>
   <script src="js/bookmark.js"></script>
   <script src="js/dashboard.js"></script>
   <script src="js/balance.js"></script>
   <script src="js/Room.js"></script>
   <script src="js/Adduser.js"></script>
   <script src="js/request.js"></script>
   <script src="js/editExpense.js"></script>
   <script src="js/showlist.js"></script>
   <script src="js/fileUpload.js"></script>
   <script src="js/logout.js"></script>

   <script>
     var loadFile = function(event) {
       var output = document.getElementById('output');
       output.src = URL.createObjectURL(event.target.files[0]);
       output.onload = function() {
         URL.revokeObjectURL(output.src) // free memory
       }
     };
     $(document).ready(
       function() {
         $('input:file').change(
           function() {
             if ($(this).val()) {
               $('input:submit').attr('disabled', false);
             }
           }
         );
         $("#changePassword").submit(function(e) {

           if (
             !$("#CPass")
             .val()
             .match(
               /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/
             ) && !$("#NPass")
             .val()
             .match(
               /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/
             )
           ) {
             $("#Cpassword-info").html(
               "Password Must contain 8 letters with Alphanum and Symbols"
             );

           } else {
             $("#updating").html("Updating..");
             $("#Cpassword-info").html(
               ""
             );
             var payload_r0 = localStorage.getItem("payload");
             var resetData = {
               CPass: $("#CPass").val(),
               NPass: $("#NPass").val(),
               username: JSON.parse(payload_r0).email
             }

             $.ajax({
               type: "post",
               url: "reset.php",
               data: resetData,
               dataType: "json",
               success: function(response) {
                 $("#updating").html("Update");
                 //console.log(response);
                 if (response.status == false) {
                   $("#Cpassword-info").html(response.message);
                 } else {
                   $("#Cpassword-info").html(response.message);
                  
                 }

               }
             });
           }

           e.preventDefault();

         });

       });
     //  _deleteRoom
     function deleteBookmark(params) {
       var payload_r0 = localStorage.getItem("payload");
       var deleteme = {
         functionName: "deleteBookmark",
         deletKey: params,
         paramsb: JSON.parse(payload_r0).username


       }
       //console.log(deleteme)
       $.ajax({
           type: "post",
           url: "deleteApi.php",
           data: deleteme,
           dataType: "json",
           encode: true,
         })

         .done(function(data) {
           $.getScript('js/dashboard.js', function() {
             //console.log("Deleted");
           });

           //console.log(data);

         })
         .fail(function(data) {
           //console.log("faild");
         });

     }




     function handle_deleteRoom(params1, params2) {

       var params1 = localStorage.getItem("room_name")
       var payload_r1 = localStorage.getItem("payload");
       var DeleteRoomData = {
         functionName: "DeleteRoom",
         paramsa: params1,
         paramsb: JSON.parse(payload_r1).username
       }

       $.ajax({
           type: "post",
           url: "deleteApi.php",
           data: DeleteRoomData,
           dataType: "json",
           encode: true,
         })

         .done(function(data) {
           if (data.Deletestatus == true) {
             localStorage.removeItem("room_name");
             window.location.reload();

           }

           //console.log("Rororo", data);

         })
         .fail(function(data) {
           //console.log("faild");
         });
     }

     function handle_leaveRoom() {

       var params1 = localStorage.getItem("joined_room_name")
       var payload_r1 = localStorage.getItem("payload");
       var LeaveFormData = {
         functionName: "LeaveRoom",
         paramsa: params1,
         paramsb: JSON.parse(payload_r1).username
       }


       $.ajax({
           type: "post",
           url: "deleteApi.php",
           data: LeaveFormData,
           dataType: "json",
           encode: true,
         })

         .done(function(data) {
           if (data.Leavestatus == true) {
             window.location.reload();

           }
           //console.log(data);

         })
         .fail(function(data) {
           //console.log("faild");
         });
       //console.log(params1, payload_r1);
     }
     //  delete or kick members function
     function handle_kick(params1, params2, params3) {
       //console.log(params1, params2, params3);
       var KickFormData = {
         functionName: "KickOut",
         paramsa: params1,
         paramsb: params2,
         paramsc: params3
       }
       $.ajax({
           type: "post",
           url: "deleteApi.php",
           data: KickFormData,
           dataType: "json",
           encode: true,
         })

         .done(function(data) {
           if (data.status == true) {
             $("#removedmsg").html(`Removed ${KickFormData.paramsb}`)

           }
           //console.log(data);

         })
         .fail(function(data) {
           //console.log("faild");
         });

     }

     function handle(params) {
       //  alert(params);
       var payload_r1 = localStorage.getItem("payload");
       var ResquestData = {
         member: params,
         gname: localStorage.getItem("room_name"),
         owner: JSON.parse(payload_r1).username
       };
       //  $("#isaddedRequest").hide();
       $("#loadingScreen").html(`<div class="spinner-border spinner-border-sm" role="status">
  <span class="sr-only">Loading...</span>
</div>`);
       //console.log(ResquestData);

       $.ajax({
         url: 'sendRequest.php',
         type: 'POST',
         dataType: "JSON",
         data: ResquestData

       }).done((data) => {
         $("#isaddedRequest").show();
         $("#loadingScreen").html("");

         //console.log(data);
         $('#already_sent').html(`<div class="alert alert-danger alert-dismissible fade show" id="already_sent" role="alert">
               <strong>${data.message}</strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>`)

         //  $('#uname_response').html(data);
       }).fail((data) => {
         //console.log("Fail", data);
         //  $('#uname_response').html(data);
       })
     }

     function handle_join(params1, params2, params3) {
       //console.log(params1, params2, params3);
       var member_data = {
         functionName: "joinRoom",
         g_name: params1,
         m_name: params2,
         o_name: params3
       }
       //console.log(member_data);
       $.ajax({
         url: 'room_auth.php',
         type: 'POST',
         dataType: "JSON",
         data: member_data

       }).done((data) => {

         //  alert(data.message);
         if (data.message === "Halt") {
           $('#liveToast').toast('show')
         }
         setTimeout(() => {
           window.location.reload()
         }, 2000);
         //console.log(data);


         //  $('#uname_response').html(data);
       }).fail((data) => {
         //console.log("Fail", data);
         //  $('#uname_response').html(data);
       })

     }
   </script>
   <script>
     function handlepost_v2(params) {
       var userid = $("#sharing_protocol_v2").data("id");
       $("#id_of_viewing_expense_type").val(userid)
       $("#id_of_viewing_expense_type_text").html(userid.split(','))
       //console.log(userid);


     }
   </script>
   <script>
     function handlepost_v1(params) {
       var userid = $("#sharing_protocol_v1").data("id");

       $("#id_of_viewing_expense_type").val(userid);
       $("#id_of_viewing_expense_type_text").html(userid.split(','))
       $("#addexpense").modal('dispose');
       //console.log(userid);
     }
   </script>
   <!-- Core plugin JavaScript-->
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="js/expenseComponent.js"></script>

   <!-- Page level plugins -->
   <script src="vendor/chart.js/Chart.min.js"></script>

   <!-- Page level custom scripts -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
   <script>
     $('#generatePersonal').on('click', function() {

       var doc = new jsPDF('p', 'pt', 'letter');
       var htmlstring = '';
       var tempVarToCheckPageHeight = 0;
       var pageHeight = 0;
       pageHeight = doc.internal.pageSize.height;
       specialElementHandlers = {
         // element with id of "bypass" - jQuery style selector  
         '#bypassme': function(element, renderer) {
           // true = "handled elsewhere, bypass text extraction"  
           return true
         }
       };
       margins = {
         top: 150,
         bottom: 60,
         left: 40,
         right: 40,
         width: 600
       };
       var y = 20;
       doc.setLineWidth(2);
       doc.text(200, y = y + 30, "Expense of Month");
       doc.autoTable({
         html: '#dataPersonal',
         startY: 70,
         theme: 'grid',
         columnStyles: {
           0: {
             cellWidth: 80,
           },
           1: {
             cellWidth: 80,
           },
           2: {
             cellWidth: 80,
           }
         },
         styles: {
           minCellHeight: 40
         }
       })
       var today = new Date();
       var dd = String(today.getDate()).padStart(2, '0');
       var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
       var yyyy = today.getFullYear();

       today = dd + "-" + mm + "-" + yyyy;
       doc.save(`ExpensePersonal-${today}.pdf`);

     })
   </script>
   <script>
     $('#generateSharing').on('click', function() {
       var roomOwnerdata = "";
       if (roomOwnerdata == "null") {
         roomOwnerdata = localStorage.getItem("joined_room_name");
       } else {
         roomOwnerdata = localStorage.getItem("room_name");
       }

       var doc = new jsPDF('p', 'pt', 'letter');
       var htmlstring = '';
       var tempVarToCheckPageHeight = 0;
       var pageHeight = 0;
       pageHeight = doc.internal.pageSize.height;
       specialElementHandlers = {
         // element with id of "bypass" - jQuery style selector  
         '#bypassme': function(element, renderer) {
           // true = "handled elsewhere, bypass text extraction"  
           return true
         }
       };
       margins = {
         top: 150,
         bottom: 60,
         left: 40,
         right: 40,
         width: 600
       };
       var y = 20;
       doc.setLineWidth(2);
       doc.text(200, y = y + 30, `${roomOwnerdata} Sharing Expense of Month`);
       doc.autoTable({
         html: '#tab_sharing',
         startY: 70,
         theme: 'grid',
         columnStyles: {
           0: {
             cellWidth: 80,
           },
           1: {
             cellWidth: 80,
           },
           2: {
             cellWidth: 80,
           }
         },
         styles: {
           minCellHeight: 40
         }
       })
       var today = new Date();
       var dd = String(today.getDate()).padStart(2, '0');
       var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
       var yyyy = today.getFullYear();

       today = dd + "-" + mm + "-" + yyyy;
       doc.save(`${roomOwnerdata}-Sharing-Expense-${today}.pdf`);

     })
   </script>

 </body>

 </html>