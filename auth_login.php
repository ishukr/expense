<?php
sleep(3);
include('dbConnection.php');
$email = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['upassword']);

$data = [];


if ($email != "" && $password != "") {

    $mailCheck = "select * from users where email = '$email' or username = '$email'";
    $result = mysqli_query($conn, $mailCheck);
    $mailStatus = mysqli_num_rows($result);
    if ($mailStatus == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                // settting ip
                
                $_SESSION['name'] = $row['username'];
                $getemail = $row['email'];
                $string_to_encrypt = $getemail . $row['username'];
                $password = "expensev1";
                $encrypted_string = openssl_encrypt($string_to_encrypt, "AES-128-ECB", $password);
           
                $data['status'] = true;
                $data['email'] = $getemail;
                $data['username']= $row['username'];
                $data['token']= $encrypted_string;
                $data['role']= $row['role'];
            } else {
                $data['status'] = false;
                $data['message'] = 'Invalid Credentials';
            }
        }
    } else if ($mailStatus <= 0) {
        $data['status'] = false;
        $data['message'] = "Account not found";
    }
} else {
     $data['status'] = false;
        $data['message'] = 'Something Went Wrong';
}
echo json_encode($data);

