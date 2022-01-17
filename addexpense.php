<?php
sleep(3);
include('dbConnection.php');
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$E_TYPE = mysqli_real_escape_string($conn, $_POST['expense_type']);
$G_NAME = mysqli_real_escape_string($conn, $_POST['g_name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$data = [];


if ($desc != "" && $type != "" && $date != "" && $amount != "" && $E_TYPE != "") {
    if ($E_TYPE == "Personal") {
        $sql = "INSERT INTO `expense`(`username`, `description`, `category`, `date`, `amount`,`exp_type`,`group_name`) 
    VALUES ('$username','$desc','$type','$date','$amount','$E_TYPE','')";
        if (mysqli_query($conn, $sql)) {
            $data['status'] = true;
            $data['message'] = 'Success!';
        } else {
            $data['status'] = false;
            $data['message'] = 'Something Went Wrong';
        }
    } else {

        if ($E_TYPE == "Sharing") {
            $queryforChecking = mysqli_query($conn, "SELECT * FROM `room` WHERE room_name='$G_NAME'");
            $CheckStatus = mysqli_num_rows($queryforChecking);
            if ((!$CheckStatus) == 1) {
                $data['status'] = "failed";
                $data['message'] = 'REload!';
            } else {
                $sql = "INSERT INTO `expense`(`username`, `description`, `category`, `date`, `amount`,`exp_type`,`group_name`) 
    VALUES ('$username','$desc','$type','$date','$amount','$E_TYPE','$G_NAME')";
                if (mysqli_query($conn, $sql)) {
                    $data['status'] = true;
                    $data['message'] = 'Success!';
                } else {
                    $data['status'] = false;
                    $data['message'] = 'Something Went Wrong';
                }
            }
        }
    }
}
echo json_encode($data);
