<?php
sleep(3);
include('dbConnection.php');
$username = mysqli_real_escape_string($conn, $_POST['username']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);

$data = [];


if ($name != "" && $username != "" && $date != "" && $desc != "") {
    $sql="INSERT INTO `bookmark`(`username`, `name`, `amount`, `date`, `description`)
     VALUES ('$username','$name','$amount','$date','$desc')";
    if (mysqli_query($conn, $sql)) {
        $data['status'] = true;
        $data['message'] = 'Success!';
    } else {
        $data['status'] = false;
        $data['message'] = 'Something Went Wrong';
    }

} else {
    $data['status'] = false;
    $data['message'] = 'No Response';
}
echo json_encode($data);
