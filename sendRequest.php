<?php
include('dbConnection.php');
sleep(5);
$member = mysqli_real_escape_string($conn, $_POST['member']);
$g_name=mysqli_real_escape_string($conn,$_POST['gname']);
$owner = mysqli_real_escape_string($conn, $_POST['owner']);
$data = [];
$msg= $owner." has requested you to join ".$g_name;
if ($member != "" && $g_name != "" && $owner!="") {
    $result = mysqli_query($conn, "SELECT is_requested from notification where room_id='$g_name' and 
    member='$member' and owner='$owner' ");
    $Status = mysqli_num_rows($result);
   if($Status==1)
   {
       
        $detailed = 'Already Sent request to ' . $member;
        $data['status'] = false;
        $data['message'] = $detailed;
   }
   else{
        $result_group = mysqli_query($conn, "SELECT created_by from room where created_by='$member'");
        $Status_Owner = mysqli_num_rows($result_group);
        $date = date('Y/m/d');
        if ($Status_Owner == 1) {
            $detailed = $owner.' is Managing Other Room';
            $data['status'] = false;
            $data['message'] = $detailed;
        }else{
    $sql = "INSERT INTO `notification`(`room_id`, `member`, `owner`, `message`, `is_requested`, `is_joined`,`date`) 
    VALUES ('$g_name','$member','$owner','$msg',1,0,'$date')";
    if (mysqli_query($conn, $sql)) {
        $detailed='Sent request to '.$member;
        $data['status'] = true;
        $data['message'] = $detailed;
    } else {
        $data['status'] = false;
        $data['message'] = 'Failed';
    }
}
}
} else {
    $data['status'] = false;
    $data['message'] = 'No Response';

}
echo json_encode($data);
