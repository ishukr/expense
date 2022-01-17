<?php
sleep(3);
include('dbConnection.php');
$username = mysqli_real_escape_string($conn, $_POST['uname']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$SQ = mysqli_real_escape_string($conn, $_POST['Sq']);
$SA = mysqli_real_escape_string($conn, $_POST['Sa']);
$secure_ans = password_hash($SA, PASSWORD_BCRYPT);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$secure_pass = password_hash($password, PASSWORD_BCRYPT);
$date = date('Y-m-d');
$data = [];


if ($name != "" && $username != "" && $email != "" && $password != "") {

    $mailCheck = "select * from users where email = '$email' or username = '$username'";
    $result = mysqli_query($conn, $mailCheck);
    $mailStatus = mysqli_num_rows($result);
    if ($mailStatus == 1) {
        $data['status'] = false;
        $data['message'] = 'Username or Email Exist!';
    } else {

        $sql = "INSERT INTO `users`(`username`, `name`, `role`, `email`, `password`,`balance`,`profile`,`pr_token`,`pr_q`,`doj`) 
VALUES ('$username','$name','$type','$email','$secure_pass',0,'','$secure_ans','$SQ','$date')";

       
        if (mysqli_query($conn, $sql)) {
            $_SESSION['username'] = $email;
            $data['status'] = true;
            $data['message'] = 'Success!';
        } else {
            $data['status'] = false;
            $data['message'] = mysqli_error($conn);
        }
        
    }
} else {
     $data['status'] = false;
    $data['message'] = 'No Response';
}
echo json_encode($data);
