<?php
include('dbConnection.php');
$name = mysqli_real_escape_string($conn, $_POST['roomName']);
$query = mysqli_query($conn, "SELECT * FROM `member` where room_id='$name'");

$data_personal_list = [];
while ($row = mysqli_fetch_array($query)) {
    array_push($data_personal_list, $row);
}

// $data_table_personal['status'] = true;
// $data_table_personal['daily'] = $row;
echo json_encode($data_personal_list);

     
    