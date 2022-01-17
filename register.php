<?php
include "dbConnection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Expense Manager</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <!-- Custom styles for this template-->
  <link href="css/expense.css" rel="stylesheet">
  <script>
    $(document).ready(function() {

      $("#uname").keyup(function() {

        var username = $(this).val().trim();

        if (username != '') {
          $.ajax({
            url: 'username_search.php',
            type: 'POST',
            data: {
              username: username
            }

          }).done((data) => {
            $('#uname_response').html(data);
          }).fail((data) => {
            $('#uname_response').html(data);
          })
        } else {
          $("#uname_response").html("");
        }

      });

    });
  </script>
</head>

<body style="background-color: #180f3b;">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card mt-5">
          <!-- Default form register -->

          <form class="text-center border border-light p-5 " method="post" id="Signup">

            <p class="h4 mb-4">Sign up</p>

            <span id="response_message" class="badge badge-success mb-2" style="font-size: large;"></span>
            <div class="form-row mb-4">
              <div class="col-md-4 pt-1">
                <!-- First name -->
                <div id="uname_response"></div>
                <span id="userUname-info" class="text-danger float-left"></span>


                <input type="text" id="uname" name="uname" class="form-control" maxlength="8" placeholder="Username">
              </div>
              <div class="col-md-4 pt-1">
                <!-- Last name -->
                <span id="userName-info" class="text-danger float-left"></span>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
              </div>


              <div class="col-md-4 pt-1">
                <span id="usertype-info" class="text-danger float-left"></span>
                <select id="inputState" name="inputState" class="form-control">
                  <option selected disabled>Select Type</option>
                  <option value="student">Student</option>
                  <option value="working">Working</option>
                  <option value="company">Company</option>

                </select>

              </div>
            </div>

            <!-- E-mail -->
            <small>In case you forgot your password</small>
            <select id="securityQ" name="securityQ" class="form-control my-2" required>
              <option selected disabled>Select Question</option>
              <option value="1">What city were you born in?</option>
              <option value="2">What is the name of your first school?</option>
              <option value="3">What was your favorite food as a child?</option>

            </select>
            <input type="text" id="Sanswer" name="answer" class="form-control mb-4" placeholder="Answer" required>
            <span id="userEmail-info" class="text-danger float-left"></span>
            <input type="email" id="email" name="email" class="form-control mb-4" placeholder="E-mail">

            <!-- Password -->
            <span id="password-info" class="text-danger float-left"></span>
            <div class="input-group">

              <input type="password" class="form-control" placeholder="Password" id="password" name="password">

              <div class="input-group-prepend">
                <div class="btn btn-secondary" id="showPass">Show</div>
              </div>
            </div>
            <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
              At least 8 characters and 1 digit
            </small>





            <!-- Sign up button -->
            <button type="submit" id="Submit" class="btn my-4 btn-block text-white" style="background-color: #180f3b;" type="submit">Sign up</button>



          </form>
          <!-- Default form register -->
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>



  <script>
    $(document).ready(function() {

      $('#showPass').on('click', function() {
        var button = $("#showPass");
        var passInput = $("#password");
        if (passInput.attr('type') === 'password') {
          passInput.attr('type', 'text');
          button.html("Hide");
        } else {
          passInput.attr('type', 'password');
          button.html("Show");
        }
      })
    })
  </script>
  <script src="js/Signup.js"></script>
</body>

</html>