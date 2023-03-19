<?php
session_start();
include 'dbconnect.php';
$email=$_SESSION['email'];
$emailsno=mysqli_query($conn,"select * from  signup where `email`='$email'");
while($row1=mysqli_fetch_assoc($emailsno))
$sno=$row1['sno'];
$no_of_notifications=mysqli_num_rows(mysqli_query($conn,"select * from  notifications where `nfor`=$sno and `type`='!deleted'"));
echo $no_of_notifications;
?>