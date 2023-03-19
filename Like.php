<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    require 'dbconnect.php';
    $cuserid=$_GET['cuserid'];
    $select="select * from `commentsparameters` where `cuserid`=$cuserid";
    $sql=mysqli_query($conn,$select);
    $nums_of_rows=mysqli_num_rows($sql);
    if($nums_of_rows===0)
    {
        $insert="insert into `commentsparameters` (`likes`,`dislikes`,`cuserid`) values (1,0,'$cuserid')";
        $sql=mysqli_query($conn,$insert);
        if($sql)
        {
            header("location:threadsolve.php?$threadid=$cuserid");
            exit();
        }
    }
    else
    {
        $select="select likes from `commentsparameters` where `cuserid`=$cuserid";
        $sql=mysqli_query($conn,$select);
        $likes=$sql+1;
        $update="update `commentsparameters` set likes=$likes";
        $sql2=mysqli_query($conn,$update);
        if($sql2)
        {
            header("location:threadsolve.php?$threadid=$cuserid");
            exit();
        }
    }
}
?>