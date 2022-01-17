<?php
sleep(3);
include('dbConnection.php');
$KEY = mysqli_real_escape_string($conn, $_POST['username']);
$NP = mysqli_real_escape_string($conn, $_POST['NPass']);
$CP = mysqli_real_escape_string($conn, $_POST['CPass']);


$data = [];


if ($NP != "" && $CP != "" && $KEY != "") {

    $mailCheck = "select * from users where email = '$KEY'";
    $result = mysqli_query($conn, $mailCheck);
    $mailStatus = mysqli_num_rows($result);
    if ($mailStatus == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($CP, $row['password'])) {
                // settting ip
                $secure_pass = password_hash($NP, PASSWORD_BCRYPT);
                $query = mysqli_query($conn, "UPDATE `users` SET `password`='$secure_pass' WHERE email='$KEY'");
                if ($query) {
                    $data['status'] = true;
                    $data['message'] = "Updated Succesfully";
                } else {
                    $data['status'] = false;
                    $data['message'] = "Failed";
                }
            } else {
                $data['status'] = false;
                $data['message'] = 'Current Password Wrong';
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
