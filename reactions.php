<?php
session_start();
if(isset($_GET['react']))
{
    require 'dbconnect.php';
    $cmtid=$_GET['cmtid'];
    $email=$_SESSION['email'];
    $type=$_GET['type'];
    $usersno=mysqli_query($conn,"select `sno` from `signup` where `email`='$email'");
    while($rows=mysqli_fetch_assoc($usersno))
    {
        $userid=$rows['sno'];
    }
    // Add notification to database table
    $cmtby=mysqli_query($conn,"select * from `comments` where `cmtid`=$cmtid");
    while($r=mysqli_fetch_assoc($cmtby))
        {
            $nfor=$r['cmtby'];
        }
    $nby=$userid;
    $ndesc='Hey your comment is '.$type.'d by <strong>'.$email.'<strong> at';
    $check=mysqli_num_rows(mysqli_query($conn,"Select * from `notifications` where `ndesc`='$ndesc' and `nfor`=$nfor and `nby`=nby"));
    if($check==0)
    {
        $insertion=mysqli_query($conn,"insert into `notifications` (`ndesc`,`nfor`,`nby`,`dt`) values ('$ndesc',$nfor,$nby,now())");
        if($insertion==false)
        {
            echo mysqli_error($conn);
        }
    }
    else
    {
        $updation=mysqli_query($conn,"update `notifications` set `dt`=now() where `ndesc`='$ndesc' and `nfor`=$nfor and `nby`=$nby");
        if($updation==false)
        {
            echo mysqli_error($conn);
        }
    }

    
    $select=mysqli_num_rows(mysqli_query($conn,"select `rid` from `reactions` where `userid`=$userid  && `cmtid`=$cmtid "));
    if($select>0)
    {
        $update=mysqli_query($conn,"update `reactions` set `type`='$type' where `userid`=$userid && `cmtid`=$cmtid ");
        if($update==false)
        {
            echo mysqli_error($conn);
        }
        else
        {
            $status="updated";
        }
    }
    else
    {
       
        $insert=mysqli_query($conn,"insert into `reactions` (`type`,`userid`,`cmtid`) values ('$type',$userid,$cmtid)");
        if($insert==false)
        {
            echo mysqli_error($conn);
        }
        else
        {
            $status="inserted";
        }
    }
    
    $likes=mysqli_num_rows(mysqli_query($conn,"select `rid` from `reactions` where `type`='like' and `cmtid`=$cmtid "));
    $dislikes=mysqli_num_rows(mysqli_query($conn,"select `rid` from `reactions` where `type`='dislike' and `cmtid`=$cmtid "));

    $rating = [
        'status' => $status,
        'likes' => $likes,
        'dislikes' => $dislikes
    ];
    $current=mysqli_num_rows(mysqli_query($conn,"select `rid` from `reactions` where `type`='$type' and `cmtid`=$cmtid "));
echo $dislikes;
echo $likes;
    
}
?>