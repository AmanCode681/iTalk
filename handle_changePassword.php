<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
require 'dbconnect.php';

$email=$_POST['email'];
$correctEmail=$_SESSION['email'];
if($email==$correctEmail)
{
$newPassword=$_POST['newPassword'];
$cnewPassword=$_POST['cnewPassword'];
$sql="select * from `signup` where `email`='$email'";
$result=mysqli_query($conn,$sql);
$noofrows=mysqli_num_rows($result);
echo $noofrows;
if($noofrows>=1)
{
if($newPassword==$cnewPassword)
{
    while($rows=mysqli_fetch_assoc($result))
    {
        $newPasswordHash=password_hash($newPassword,PASSWORD_DEFAULT);
       $update="update `signup` set `password`='$newPasswordHash'";
       $sql=mysqli_query($conn,$update);
       if($update==true)
       {
           $query=mysqli_query($conn,"select * from `signup` where `email`='$correctEmail'");
           while($r=mysqli_fetch_assoc($query))
           {
               $sno=$r['sno'];
           }
           //insert notification
           $ndesc="Password Changed Successfully On";
           $nfor=$sno;
           $nby=$sno;
           $insert=mysqli_query($conn,"insert into `notifications`(`ndesc`,`nfor`,`nby`,`dt`,`type`) values ('$ndesc',$sno,$sno,now(),'!deleted')");
           if($insert=false)
           {
               echo mysqli_error($conn);
           }
        header("Location:index.php?changePasswordSuccess=true");
        exit();
       }
    
    }
}
else
{
$showerror="Password does not matches";
}
}
else
{
    $showerror="Password is incorrect";
}
}
else
{
    $showerror="Email is incorrect";
}
header("Location:index.php?changePasswordFailed=true&error='.$showerror.'");
}
?>