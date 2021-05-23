<?php
$room=$_POST['room'];
$user=$_POST['username'];

if(strlen($room)>20 or strlen($room)<2){
    $message ="Please selecct the username between 2 to 20 character";
    echo '<script language="javascript">';
    echo 'alert("' . $message . '");';
    echo 'window.location="http://localhost:8080/chatroom";';  //not showing an alert box.
  echo '</script>';
  

}
else if(!ctype_alnum($room))
{
    $message ="Please select the alphanumeric between 2 to 20 character";
    echo '<script language="javascript">';
    echo 'alert("' . $message . '");';
    echo 'window.location="http://localhost:8080/chatroom";';  //not showing an alert box.
  echo '</script>';
}

else{
    include "_dbconnect.php";
}
$sql="SELECT * FROM `chat` WHERE roomname='$room'";
$result= mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result)>0){
        $message ="Please select diffrent room this is already occupied";
        echo '<script language="javascript">';
        echo 'alert("' . $message . '");';
        echo 'window.location="http://localhost:8080/chatroom";';  //not showing an alert box.
        echo '</script>';
    }
    else{
        $sql="INSERT INTO `chat` (`sno`, `username`, `roomname`, `dt`) VALUES (NULL, '$user', '$room', current_timestamp());";
        $result=mysqli_query($conn,$sql);
        $message ="You can now occupy the room";
        echo '<script language="javascript">';
        echo 'alert("' . $message . '");';
        echo 'window.location="http://localhost:8080/chatroom/room.php?room='. $room .'";';  //not showing an alert box.
        echo '</script>';
    }
}

?>