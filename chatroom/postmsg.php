<?php
include "_dbconnect.php";
$ip=$_POST['ip'];
$msg=$_POST['text'];
$room=$_POST['room'];

$sql="INSERT INTO `messages` (`sno`, `ip`, `msg`, `room`, `dt`) VALUES ('$ip', '$msg', '$room', current_timestamp());";
$result=mysqli_query($conn,$sql);
mysqli_close($conn);


?>