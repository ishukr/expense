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

</head>

<body style="background-color: #180f3b;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card mt-5">
                    <!-- Default form register -->
                    <form class="text-center border border-light p-5" method="post" id="login">

                        <p class="h4 mb-4">Sign in</p>
                        <div id="response_message" class="badge badge-danger"></div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <!-- First name -->

                                <input type="text" id="username" name="username" class="form-control" placeholder="Username or Email" required>
                            </div>
                        </div>
                        <!-- Password -->

                        <input type="password" id="upassword" name="upassword" class="form-control" placeholder="Password" aria-describedby="password" required>




                        <!-- Sign up button -->
                        <button class="btn my-4 btn-block text-white" style="background-color: #180f3b;" type="submit" id="login_submit">Sign in</button>
                        <div class="text-right"><a href="forgot-password.html">Forgot Password?</a>
                            <br>
                            <a href="register.php">Don't have account? Signup</a>
                        </div>


                    </form>
                    <!-- Default form register -->
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/Login.js"></script>
</body>

</html>