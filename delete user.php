<?php
     include 'db.php';

       if (isset($_POST['delete'])){
           $uname = $_POST['uname'];

           $sql = "SELECT * FROM reload_amount WHERE u_name='".$uname."'";
             $res = mysqli_query($conn, $sql);

             if (mysqli_num_rows($res) > 0){
                echo "Delete the Transaction Records before Delete the User...";
             }else {
                 $sql = "DELETE FROM user WHERE u_name='".$uname."'";

           $res = mysqli_query($conn,$sql); 

           if ($res) {
    // code...
    header("location: admin.php");
  }
             }

          
       }
     ?>