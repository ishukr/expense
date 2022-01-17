<?php
include('dbConnection.php');
$functionName = filter_input(INPUT_POST, 'functionName');
// sleep(5);
if ($functionName == "KickOut") {
    $p1 = mysqli_real_escape_string($conn, $_POST['paramsa']);
    $p2 = mysqli_real_escape_string($conn, $_POST['paramsb']);
    $p3 = mysqli_real_escape_string($conn, $_POST['paramsc']);
    $data = [];

    $result = mysqli_query($conn, "DELETE FROM `member` WHERE room_id='$p1' and owner='$p3' and member='$p2'");

    $data_room = [];
    if ($result) {
        $delete_notofication = mysqli_query($conn, "DELETE FROM `notification` WHERE room_id='$p1' and owner='$p3' and member='$p2'");
        if ($delete_notofication) {
            $data_room['status'] = true;
        }

        // $data_room['room_name'] = $room_details;
        // $data_room['room_owner'] = $room_member;

    }
} else if ($functionName == "LeaveRoom") {
    $p1 = mysqli_real_escape_string($conn, $_POST['paramsa']);
    $p2 = mysqli_real_escape_string($conn, $_POST['paramsb']);
    if ($p1 != "" && $p2 != "") {
        $result = mysqli_query($conn, "DELETE FROM `member` WHERE room_id='$p1' and member='$p2'");

        $data_room = [];
        if ($result) {
            $delete_notofication = mysqli_query($conn, "DELETE FROM `notification` WHERE room_id='$p1'and member='$p2'");
            if ($delete_notofication) {
                $deleteExpense = mysqli_query($conn, "DELETE FROM `expense` WHERE group_name='$p1'");
                if ($deleteExpense) {
                    $data_room['Leavestatus'] = true;
                }
            }
        }
        // $data_room['room_name'] = $room_details;
        // $data_room['room_owner'] = $room_member;

    }
} else if ($functionName == "DeleteRoom") {
    $p1 = mysqli_real_escape_string($conn, $_POST['paramsa']); //prototyppe
    $p2 = mysqli_real_escape_string($conn, $_POST['paramsb']); #username
    if ($p1 != "" && $p2 != "") {
        $result = mysqli_query($conn, "DELETE FROM `room` WHERE room_name='$p1' and created_by='$p2'");

        $data_room = [];
        if ($result) {
            $delete_notofication = mysqli_query($conn, "DELETE FROM `notification` WHERE room_id='$p1'");
            if ($delete_notofication) {
                $delete_member = mysqli_query($conn, "DELETE FROM `member` WHERE room_id='$p1' and owner='$p2'");
                if ($delete_member) {
                    $deleteExpense = mysqli_query($conn, "DELETE FROM `expense` WHERE group_name='$p1'");
                    if ($deleteExpense) {
                        $data_room['Deletestatus'] = true;
                        $data_room['message'] = "Deleted";
                    }
                    
                }
            }
        }
        // $data_room['room_name'] = $room_details;
        // $data_room['room_owner'] = $room_member;

    }
} else if ($functionName == "deleteBookmark") {
    $bookmark_id = mysqli_real_escape_string($conn, $_POST['deletKey']);
    $p2 = mysqli_real_escape_string($conn, $_POST['paramsb']);
    if ($bookmark_id != "") {
        $result = mysqli_query($conn, "DELETE FROM `bookmark` WHERE id='$bookmark_id' and username='$p2'");

        $data_room = [];
        if ($result) {

            $data_room['Deletestatus'] = true;
            $data_room['message'] = "Deleted Bookmark";
        } else {
            $data_room['Deletestatus'] = false;
        }
    }
}
else if($functionName= "DeleteData")
{
    $deleteid = mysqli_real_escape_string($conn, $_POST['paramsa']);
    $userkey = mysqli_real_escape_string($conn, $_POST['username']);

    if ($deleteid != "") {
        $result = mysqli_query($conn, "DELETE FROM `expense` WHERE id='$deleteid' and username='$userkey'");

        $data_room = [];
        if ($result) {

            $data_room['Deletestatus'] = true;
            $data_room['message'] = "Deleted Expense";
        } else {
            $data_room['Deletestatus'] = false;
        }
    }
}


echo json_encode($data_room); 

// echo json_encode($data);
