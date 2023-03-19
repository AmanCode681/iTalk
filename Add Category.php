<?php
require 'dbconnect.php';
if($conn==true)
{
    $sql="insert into `category` (`cname`,`cdesc`,`dt`) values ('C++','C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language.',now())";
    $result=mysqli_query($conn,$sql);
    if($result==true)
    {
        echo"inserted";
    }
    else
    {
        echo "failed".mysqli_connect_error();
    }
}
?>