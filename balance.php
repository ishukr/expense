<?php
sleep(3);
include('dbConnection.php');
$username = mysqli_real_escape_string($conn, $_POST['username']);
$balance = mysqli_real_escape_string($conn, $_POST['balance']);

$data = [];


if ($username != "" && $balance != "") {
        $update = "UPDATE `users` SET `balance`='$balance' WHERE username='$username'";

        if (mysqli_query($conn, $update)) {
            $data['status'] = true;
            $data['update'] = 'Success!';
        } else {
            $data['status'] = false;
            $data['update'] = 'Something Went Wrong';
        }
    }
 else {
    $data['status'] = false;
    $data['update'] = 'Amount Required';
}
echo json_encode($data);
