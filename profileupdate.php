<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
include 'dbconnect.php';
$name=$_POST['name'];
$email=$_SESSION['email'];
$Address=$_POST['Address'];
$Address2=$_POST['Address2'];
$city=$_POST['city'];
$gender=$_POST['gender'];
$emailsno=mysqli_query($conn,"select * from  signup where `email`='$email'");





while($row1=mysqli_fetch_assoc($emailsno))
$sno=$row1['sno'];

# notification for update profile
$nfor=$sno;
$nby=$sno;
$ndesc="You updated your profile at ";
$check=mysqli_num_rows(mysqli_query($conn,"Select * from `notifications` where `ndesc`='$ndesc' and `nfor`=$nfor and `nby`=nby"));
    if($check==0)
    {
        $insertion=mysqli_query($conn,"insert into `notifications` (`ndesc`,`nfor`,`nby`,`dt`,`type`) values ('$ndesc',$nfor,$nby,now(),'!deleted')");
        if($insertion==false)
        {
            echo mysqli_error($conn);
        }
    }
    else
    {
        $updation=mysqli_query($conn,"update `notifications` set `dt`=now() and `type`='!deleted' where `ndesc`='$ndesc' and `nfor`=$nfor and `nby`=$nby");
        if($updation==false)
        {
            echo mysqli_error($conn);
        }
    }

//echo $sno;
$no_of_result=mysqli_num_rows(mysqli_query($conn,"select * from  profile where `emailsno`=$sno"));
//echo $no_of_result;


if($no_of_result==0)
{
$insert=mysqli_query($conn,"insert into `profile`(`name`,`Address`,`Address2`,`city`,`gender`,`emailsno`) values('$name','$Address','$Address2','$city','$gender',$sno)");
if($insert)
{
header("location:index.php?status=inserted");
exit();
}
else
 {
     echo mysqli_error($conn);
 }
}
else
{
 $update=mysqli_query($conn,"update `profile` SET `name`='$name',`Address`='$Address',`Address2`='$Address',`city`='$city',`gender`='$gender' where `emailsno`=$sno");
 if($update)
 {
 header("location:index.php?status=updated");
 exit();
 }
 else
 {
     echo mysqli_error($conn);
 }
}
}
?>