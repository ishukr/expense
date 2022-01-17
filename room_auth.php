<?php

include('dbConnection.php');
$functionName = filter_input(INPUT_POST, 'functionName');
if($functionName== "createRoom")
{
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$data = [];


if ($desc != "" && $username != "") {
$date_start = date('Y/m/d');

    $sql = "INSERT INTO `room`(`room_name`, `created_by`, `created_at`) 
    VALUES ('$desc','$username','$date_start')";
    if (mysqli_query($conn, $sql)) {
        $data['status'] = true;
        $data['message'] = 'Success!';
    } else {
        $data['status'] = false;
        $data['message'] = 'Room name taken';
    }
} else {
    $data['status'] = false;
    $data['message'] = 'No Response';
}
}

else if($functionName== "joinRoom"){
    $g_name = mysqli_real_escape_string($conn, $_POST['g_name']);
    $o_name = mysqli_real_escape_string($conn, $_POST['o_name']);
    $m_name = mysqli_real_escape_string($conn, $_POST['m_name']);
    $crossCheck = "select * from room where created_by = '$m_name'";
    $crossCheckresult = mysqli_query($conn, $crossCheck);
    $crossCheckStatus = mysqli_num_rows($crossCheckresult);
    if ($crossCheckStatus == 1) {
        $delete_notification = mysqli_query($conn, "DELETE FROM `notification`
         WHERE room_id='$g_name' and owner='$o_name' and member='$m_name'");
        if($delete_notification){
            $data['status'] = false;
            $data['message'] = 'Halt';
        }
    }
    else{
    $update_notification = "UPDATE `notification` SET `is_joined`=1 WHERE room_id='$g_name' and member='$m_name' and owner='$o_name'";
    if (mysqli_query($conn, $update_notification)) {
    $sql = "INSERT INTO `member`(`room_id`, `owner`, `member`) VALUES ('$g_name','$o_name','$m_name')";
    if (mysqli_query($conn, $sql)) {
        $data['status'] = true;
        $data['message'] = 'Joined';
    } else {
        $data['status'] = false;
        $data['message'] = 'Some Error Occured';
    }
    }
}
}

echo json_encode($data);
