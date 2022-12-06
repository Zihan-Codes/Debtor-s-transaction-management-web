<?php include 'db.php';
      session_start();
      $user = $_SESSION['name'];
      
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <style>
      * {
        box-sizing: border-box;
        background-color: #FED0D0;
        font-family: 'Roboto Slab', serif;
      }
      .openBtn {
        display: flex;
        justify-content: left;
      }
      .openButton {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 14px 20px;
        cursor: pointer;
        position: fixed;
      }
      .loginPopup {
        position: relative;
        text-align: center;
        width: 100%;
      }
      .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
      }
      .formPopup2 {
        display: none;
        position: fixed;
        left: 45%;
        top: 25%;
        transform: translate(-50%, 5%);
        border: 6px solid #999999;
        z-index: 9;
      }
      .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
      }
      .formContainer input[type=text],
      .formContainer input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
      }
      .formContainer input[type=text]:focus,
      .formContainer input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
      }
      .formContainer .cancel {
        background-color: #cc0000;
      }
      .formContainer .btn:hover,
      .openButton:hover {
        opacity: 1;
      }
    </style>

  <title>Admin User View</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container">
  <a style="float: right; margin-top: 20px;" href="index.php"><button class="btn btn-warning">Sign Out</button></a>
  <br>
  

  
    <center><h1><span style="font-size: 1.9em;"><?php $user = $_SESSION['name']; echo $user; ?></span>'s Transactions</h1></center>
  <br>

 
  <?php echo '<a style="float: right;" href="transactions.php?viewname='.$user.'"><button class="btn btn-success">All Transactions</button></a>'; ?>
  <br><br>
  

  
  
    <h1 class="text-primary">
  <?php 

      //session_start();
      //$user = $_SESSION['name'];  
   

      //echo "Welcome ".$user;
        ?> </h1>
        <br>
       
        <div class="col">
          <table style="border-bottom: 6px solid #7F328C;" class="table table-striped">
          <thead class="table-dark">
          <tr class="fs-5">
            <th>Purchased Date</th>
            <th>Purchased Time</th>
            <th>Purchased Amount</th>
            <th>Details</th>
            
          </tr>
          </thead>
          
          <?php 
             $sql = "SELECT * FROM reload_amount WHERE u_name='".$user."'";
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
                     <tr style="font-size: 1.2em;">
                      <td><?php echo $date; ?></td>
                      <td><?php echo $time; ?></td>
                      <td><?php echo $amount; ?></td>
                      <td><?php echo $details; ?></td>
                      
                     </tr>
                  <?php
                       $sum = $sum + $amount;
                }
             }

           ?>
        </table>
        </div>
        
        <div>
         <h1><span style="color: black;">Total = </span><span style="font-size: 3.2em; color: red;">
      <?php

        echo $sum;
      ?>
       </span>Rupees</h1>
       </div>

       
  
    <br><br><br>
    </div>
  
    

    

    
    
</body>
</html>