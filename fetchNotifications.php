<?php
session_start();
        require 'dbconnect.php';
        $email=$_SESSION['email'];
        $emailfind=mysqli_query($conn,"select * from `signup` where `email`='$email' and deleted=0");
        while($row=mysqli_fetch_assoc($emailfind))
        {
          $emailid=$row['sno'];
        }
        
        $select=mysqli_query($conn,"select * from `notifications` where `nfor`=$emailid and `type`='!deleted' ORDER BY dt DESC");
        while($rows=mysqli_fetch_assoc($select))
        {
          $cmtby=$rows['nby'];
          $imgdest=mysqli_query($conn,"select * from `signup` where `sno`=$cmtby");
          while($r2=mysqli_fetch_assoc($imgdest))
          {
            $imgdestination=$r2['image'];
          }
          echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>New Notification</strong>
          <br>
          <img class="mr-3 mt-2 rounded-circle float-left" src="'.$imgdestination.'" alt="some error" width="50px" style="overflow:hidden;">
          <span class="media-body" style="color:green;">
            '.$rows['ndesc'].' <strong>'.$rows['dt'].'</strong>
          </span>
          <button type="button" class="close" onclick="deleteNotification('.$rows['sno'].')" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

          ';
        }


        ?>