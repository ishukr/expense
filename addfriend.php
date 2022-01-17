<?php

include 'dbConnection.php';
$descriptor = mysqli_real_escape_string($conn, $_POST['key']);
$oname = mysqli_real_escape_string($conn, $_POST['ownername']);
$roomName = mysqli_real_escape_string($conn, $_POST['roomName']);
   

    // $query = "select count(*) as cntUser from users where username='" . $descriptor . "'";
    $query = "SELECT username FROM users WHERE username LIKE '%" . $descriptor . "%' AND username !='$oname'";
    $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);
// $balance = $row['username'];
// $data_balance = [];
// $data_balance['status'] = true;
// $data_balance['users'] = $balance;
$data_table_personal_all = [];
while ($row = mysqli_fetch_array($result)) {
    array_push($data_table_personal_all, $row);
}
  

    echo json_encode($data_table_personal_all);

