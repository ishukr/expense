<?php

include 'dbConnection.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $query = "select count(*) as cntUser from users where username='" . $username . "'";

    $result = mysqli_query($conn, $query);
    $response = "<span class='badge badge-primary' >Username  Available.</span>";
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if ($count > 0) {
            $response = "<span class='badge badge-danger'> Username Not Available.</span>";
        }
    }

    echo $response;
    die;
}
