<?php
include('dbConnection.php');
$functionName = filter_input(INPUT_POST, 'functionName');
if($functionName== "LoadData")
{
    $p1 = mysqli_real_escape_string($conn, $_POST['paramsa']);
    $date_start = date('Y/m/1');
    $date_end = date('Y/m/31');
    $query = mysqli_query($conn, "SELECT * from expense where id='$p1'");


    $data_table_display = [];
    while ($row = mysqli_fetch_array($query)) {
        array_push($data_table_display, $row);
    }

    // $data_table_personal['status'] = true;
    // $data_table_personal['daily'] = $row;
    
    
}
if($functionName== "editChange")
{
    $d1 = mysqli_real_escape_string($conn, $_POST['id']);
    $d2 = mysqli_real_escape_string($conn, $_POST['desc']);
    $d3 = mysqli_real_escape_string($conn, $_POST['type']);
    $d4 = mysqli_real_escape_string($conn, $_POST['date']);
    $d5 = mysqli_real_escape_string($conn, $_POST['amount']);
    $d6 = mysqli_real_escape_string($conn, $_POST['username']);
    $d7 = mysqli_real_escape_string($conn, $_POST['catagory']);

    $d8 = mysqli_real_escape_string($conn, $_POST['gname']);

    

    
    $query = mysqli_query($conn, "UPDATE `expense` SET `description`='$d2',`category`='$d7',
    `date`='$d4',`amount`='$d5',`exp_type`='$d3',`group_name`='$d8' WHERE id='$d1' and username='$d6'");
        

    $data_table_display = [];
    if ($query) {
        $data_table_display['status'] = true;
    }
    
    // while ($row = mysqli_fetch_array($query)) {
    //     array_push($data_table_display, $row);
    // }
}
echo json_encode($data_table_display); 
?>