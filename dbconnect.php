<?php
$servername="localhost";
$username="root";
$password="mySQL";
$database="forum";
$conn=mysqli_connect($servername,$username,$password,$database);
if($conn==false)
{
    echo "failed".mysqli_connect_error();
}
?>