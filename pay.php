<?php
sleep(5);
include('dbConnection.php');
$username = $_POST['eid'];
$date = date('Y/m/d');
$arr = [];
$result = mysqli_query($conn, "UPDATE `organisation_expense` SET `dop`='$date',`pay_status`='1' WHERE employeeCode='$username'");
if($result)
{
    $arr['Pstatus'] = true;
}



echo json_encode($arr);


?>