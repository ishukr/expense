<?php
include('dbConnection.php');
$functionName = filter_input(INPUT_GET, 'functionName');
$Username = filter_input(INPUT_GET, 'username');
$date = filter_input(INPUT_GET, 'date');
$groupName=filter_input(INPUT_GET, 'groupName');
// $RoomName = filter_input(INPUT_GET, 'roomName');
 
function db()
{
    static $conn;
    if ($conn === NULL) {
        $conn = mysqli_connect("localhost", "root", "", "expense");
    }
    return $conn;
}

if($functionName =="today")
{
return_dailyexpense($Username,$date);
}
if($functionName=="month")
{
return_monthlyexpense($Username);
}
if($functionName =="balance")
{
return_balance($Username);
}
if($functionName =="currentbalance")
{

}
if($functionName =="bookmarks")
{
return_bookmark($Username);
}
if($functionName== "personalExpense")
{
    return_table_exp_personal($Username);
}
if($functionName=="allPersonal_expense")
{
    return_table_exp_personal_display_all($Username);
}
if ($functionName == "showRoom") {
    return_room_data($Username);
}
if($functionName=="notification")
{
 return_notification($Username);   
}
if($functionName == "showJoinedRoom")
{
    return_joined_Room($Username);   
}
if($functionName== "showbookMarks")
{
    return_bookmark_list($Username);
}
if($functionName== "SharingExpense")
{
    return_sharing_expense_list($Username,$groupName);
}
if($functionName == "currentBalance")
{
    return_cBalance($Username);
}
if($functionName== "viewProfle"){
    return_profile($Username);
}
function return_profile($username)
{
    $conn = db();
    $query_pf = mysqli_query($conn, "SELECT username,role,email,name,profile FROM `users` WHERE username='$username'");


    $data_profile_personal = [];
    while ($row = mysqli_fetch_array($query_pf)) {
        array_push($data_profile_personal, $row);
    }

    // $data_table_personal['status'] = true;
    // $data_table_personal['daily'] = $row;
    echo json_encode($data_profile_personal);
}
function return_cBalance($username)
{
    $conn = db();
    $result = mysqli_query($conn, "SELECT SUM(amount) AS daily_sum FROM expense WHERE username='$username' ");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['daily_sum'];
    $query_bm = mysqli_query($conn, "SELECT balance FROM `users` WHERE username='$username'");
    $cBalance=mysqli_fetch_assoc($query_bm);
    $Balance= $cBalance['balance'];
    if ($Balance-$sum == 0) {
        $Rsum = 0;
    }
    else{
        $Rsum= $Balance - $sum;
    }
    $data_daily = [];
    $data_daily['status'] = true;
    $data_daily['cb'] = $Rsum;
    echo json_encode($data_daily);
}
function return_bookmark_list($username)
{
    $conn = db();
    $query_bm = mysqli_query($conn, "SELECT * FROM `bookmark` WHERE username='$username' ORDER BY id DESC");


    $data_bookmark_personal = [];
    while ($row = mysqli_fetch_array($query_bm)) {
        array_push($data_bookmark_personal, $row);
    }

    // $data_table_personal['status'] = true;
    // $data_table_personal['daily'] = $row;
    echo json_encode($data_bookmark_personal);

}
function return_sharing_expense_list($username,$gpname)
{
     $conn=db();
      $date_start = date('Y/m/1');
    $date_end = date('Y/m/31');
    $query = mysqli_query($conn, "SELECT * FROM `expense` WHERE group_name='$gpname' and exp_type='Sharing' and date BETWEEN '$date_start' and '$date_end'");


    $data_Sharing_personal = [];
    while ($row = mysqli_fetch_array($query)) {
        array_push($data_Sharing_personal, $row);
    }

    // $data_table_personal['status'] = true;
    // $data_table_personal['daily'] = $row;
    echo json_encode($data_Sharing_personal);
}
function return_joined_Room($username)
{
    $conn = db();

    $result = mysqli_query($conn, "SELECT * from member where member='$username'");
    $row = mysqli_fetch_assoc($result);
    $room_details = $row['room_id'];
    $room_member=$row['member'];

    $data_room = [];
    $data_room['status'] = true;
    $data_room['room_name'] = $room_details;
    $data_room['room_owner'] = $room_member;
    

    echo json_encode($data_room);   
}
function return_notification($username)
{
    $conn=db();
    $query = mysqli_query($conn, "SELECT * FROM `notification` WHERE member='$username' and is_joined=0");


    $data_notification_personal = [];
    while ($row = mysqli_fetch_array($query)) {
        array_push($data_notification_personal, $row);
    }

    // $data_table_personal['status'] = true;
    // $data_table_personal['daily'] = $row;
    echo json_encode($data_notification_personal);
}
function return_room_data($username)
{
    $conn = db();

    $result = mysqli_query($conn, "SELECT * from room where created_by='$username'");
    $row = mysqli_fetch_assoc($result);
    $room_details = $row['room_name'];
    
    $data_room = [];
    $data_room['status'] = true;
    $data_room['room_name'] = $room_details;
    $data_room['owner_name'] = $username;

    echo json_encode($data_room);

}
function return_table_exp_personal($username)
{
    $conn = db();
    $date_start = date('Y/m/1');
    $date_end = date('Y/m/31');
    $query=mysqli_query($conn,"SELECT * from expense where username='$username' and exp_type='Personal' and date BETWEEN '$date_start' and '$date_end'");
    
    
    $data_table_personal = [];
    while ($row = mysqli_fetch_array($query)) {
        array_push($data_table_personal, $row);
    }
   
    // $data_table_personal['status'] = true;
    // $data_table_personal['daily'] = $row;
    echo json_encode($data_table_personal);
}
function return_table_exp_personal_display_all($username)
{
    $conn = db();
    $date_start = date('Y/m/1');
    $date_end = date('Y/m/31');
    $query = mysqli_query($conn, "SELECT * from expense where username='$username' and exp_type='Personal'");


    $data_table_personal_all = [];
    while ($row = mysqli_fetch_array($query)) {
        array_push($data_table_personal_all, $row);
    }

    // $data_table_personal_all['status'] = true;
    // $data_table_personal_all['daily'] = $row;
    echo json_encode($data_table_personal_all);
}
function return_dailyexpense($username,$Tdate)
{
    $conn =db();
    $datee= date('Y/m/d');
    $result = mysqli_query($conn, "SELECT SUM(amount) AS daily_sum FROM expense WHERE username='$username' and date='$Tdate'");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['daily_sum'];
   
    if($sum==null)
    {
       $sum=0; 
    }
    $data_daily = [];
        $data_daily['status'] = true;
        $data_daily['daily'] = $sum;
        echo json_encode($data_daily);
    

}
function return_monthlyexpense($username)
{
    $conn = db();
    $date_start = date('Y/m/1');
    $date_end=date('Y/m/31');
    $result = mysqli_query($conn, "SELECT SUM(amount) AS monthly_sum FROM expense WHERE username='$username' and date BETWEEN '$date_start' and '$date_end'");
    $row = mysqli_fetch_assoc($result);
    $monthly_sum = $row['monthly_sum'];
    $data_monthly = [];
    if ($monthly_sum == null) {
        $monthly_sum = 0;
    }
    $data_monthly['status'] = true;
    $data_monthly['daily'] = $monthly_sum;
    echo json_encode($data_monthly);
}

function return_balance($username)
{
    $conn = db();
    
    $result = mysqli_query($conn, "SELECT balance from users where username='$username'");
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance'];
    if ($balance == null) {
        $balance = 0;
    }
    $data_balance = [];
    $data_balance['status'] = true;
    $data_balance['balance'] = $balance;
    echo json_encode($data_balance);
}
function return_bookmark($username)
{
    $conn = db();

    $result = mysqli_query($conn, "SELECT * from bookmark where username='$username'");
    $row = mysqli_num_rows($result);
    if ($row == null) {
        $row = 0;
    }
    
    $data_bookmark = [];
    $data_bookmark['status'] = true;
    $data_bookmark['bookmark_count'] = $row;
    echo json_encode($data_bookmark);
}
