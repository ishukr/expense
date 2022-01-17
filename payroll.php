<?php
include('dbConnection.php');

$data=[];
// if($functionName== "FetchRecord")
// {
  $query_pf = mysqli_query($conn, "SELECT * FROM `organisation_expense`");
  $data = [];
  while ($row = mysqli_fetch_array($query_pf)) {
    array_push($data, $row);
  }


echo json_encode($data);
// }

?>