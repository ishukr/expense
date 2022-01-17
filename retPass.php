<?php
sleep(3);
include('dbConnection.php');
$KEY = mysqli_real_escape_string($conn, $_POST['username']);
$SQ = mysqli_real_escape_string($conn, $_POST['securityQ']);
$SA = mysqli_real_escape_string($conn, $_POST['answer']);


$data = [];


if ($SQ != "" && $SA != "" && $KEY !="") {

    $mailCheck = "select * from users where email = '$KEY'";
    $result = mysqli_query($conn, $mailCheck);
    $mailStatus = mysqli_num_rows($result);
    if ($mailStatus == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($SQ == $row['pr_q']){
            if (password_verify($SA, $row['pr_token'])) {
                    // settting ip
                    function rand_string($length)
                    {

                        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                        return substr(str_shuffle($chars), 0, $length);
                    }
                    $temp_pass= rand_string(8);
                    $secure_pass = password_hash($temp_pass, PASSWORD_BCRYPT);
                    $query=mysqli_query($conn, "UPDATE `users` SET `password`='$secure_pass' WHERE email='$KEY'");
                    if($query)
                    {
                        $data['status'] = true;
                        $data['message'] = $temp_pass;
                    }
                    else{
                         $data['status'] = false;
                        $data['message'] = "Failed";
                    }
                    
                    
               
            } else {
                    $data['status'] = false;
                    $data['message'] = 'Wrong Answer';

            }
        }else{
                $data['status'] = false;
                $data['message'] = 'Wrong Question/Answer';
        }
        }
    } else if ($mailStatus <= 0) {
        $data['status'] = false;
        $data['message'] = "Account not found";
    }
} else {
    $data['status'] = false;
    $data['message'] = 'Something Went Wrong';
}
echo json_encode($data);
