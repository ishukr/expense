<?php
include('dbConnection.php');
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'upload/'; // upload directory
if($_FILES['photo'])
{
$img = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
$username=$_POST['username'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$img;

// check's valid format
 $res =mysqli_query($conn,"select * from users where username = '$username'");
while($row=mysqli_fetch_array($res))
{
    $img =$row["profile"];    
}
unlink("upload/".$img);
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
if(move_uploaded_file($tmp,$path)) 
{
$query = mysqli_query($conn, "UPDATE `users` SET `profile`='$final_image' WHERE username='$username'");
if($query)
{
    $response=[];
    $response["uploaded"]=true;
                echo json_encode($response);
}
}
} 
}
else 
{
    $response = [];
    $response["uploaded"] = false;
    echo json_encode($response);
}


?>