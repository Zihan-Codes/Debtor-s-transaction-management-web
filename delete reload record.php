<?php include 'db.php';
       session_start();
      $uname = $_SESSION['uname'];
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>deleting</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style type="text/css">
    * {
        box-sizing: border-box;
        background-color: #FED0D0;
        font-family: 'Roboto Slab', serif;
      }
  </style>
</head>
<body>
  

  <div class="container">
    <a href="admin user view.php"><button style="margin-top: 20px;" class="btn btn-info">Back</button></a>

    <br><br>
    <h1>Welcome to delete page</h1>

  
  
    <h1 class="text-primary">
  <?php 

      //session_start();
      //$user = $_SESSION['name'];  
   

      //echo "Welcome ".$user;
        ?> </h1>
        <br>
        <h3>Your Records...</h3>
        <div class="col">
          <table style="border-bottom: 6px solid #7F328C;" class="table table-striped">
          <thead class="table-dark">
          <tr>
            <th>Purchased Date</th>
            <th>Purchased Time</th>
            <th>Amount</th>
            <th>Details</th>
            <th>Delete</th>
            
          </tr>
          </thead>
          
          <?php 
             $sql = "SELECT * FROM reload_amount WHERE u_name='".$uname."'";
             $res = mysqli_query($conn, $sql);
             $sum = 0;

             if (mysqli_num_rows($res) > 0){
                while ($row = $res->fetch_assoc()){
                  $date = $row["r_date"];
                  $time = $row["r_time"];
                  $amount = $row["r_amount"];
                  $details = $row["details"];
                  $rdid = $row["r_id"];
                 // $_SESSION['rid'] = $rid;
                 // $bcd = $_SESSION['rid'];



                  ?>
                     <tr>
                      <td><?php echo $date; ?></td>
                      <td><?php echo $time; ?></td>
                      <td><?php echo $amount; ?></td>
                      <td><?php echo $details; ?></td>


                      
                      <?php
                      echo '<td><a class="text-light" href="delete reload action.php?did='.$rdid.'"><button class="btn btn-danger">Delete</button></a></td>'; ?>
                     </tr>
                  <?php
                       $sum = $sum + $amount;
                }
             }

           ?>
        </table>
        </div>
        
        <h1 class="text-danger">
           <?php

        echo "Total = ".$sum;


   ?>
        </h1>

       <br><br><br>
  
   
    </div>

</body>
</html>