<?php
session_start();
require 'dbconnect.php';
if(isset($_POST['sno']))
{
    $sno=(testInput($_POST['sno']));
    $sql="update notifications set `type`='deleted' where `sno`=$sno";
    $query=mysqli_query($conn,$sql);
    if($query==false)
    {
        echo mysqli_error($conn);
    }
    else
    {
        $email=$_SESSION['email'];
        $sql2=mysqli_query($conn,"select * from `signup` where `email`='$email'");
        while($row=mysqli_fetch_assoc($sql2))
        {
            $emailsno=$row['sno'];
        }
        $no_of_notifications=mysqli_num_rows(mysqli_query($conn,"select * from notifications where `nfor`=$emailsno and `type`='!deleted' "));
        echo $no_of_notifications;
    }
}
function testInput($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>