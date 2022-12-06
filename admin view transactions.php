<?php 
   include 'db.php';
 

  if (isset($_GET['viewname'])) {
    // code...
    $uname = $_GET['viewname'];
    $_SESSION['uname'] = $uname;

  }
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Transactions</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <div style="border-bottom: 6px solid red;">
    <div>
        <a href="admin user view.php"><button style="margin-top: 10px;" class="btn btn-success">Back</button></a>
    </div>
       <center><h1><?php echo $uname; ?>'s Transactions</h1></center>
       <table style="border-bottom: 6px solid #7F328C;" class="table table-striped">
           <thead class="table-dark">
               <tr>
               <th>Purchased Date</th>
               <th>Purchased Time</th>
               <th>Amount </th>
               <th>Payment</th>
               <th>Details</th>
               </tr>
           </thead>

          
           <?php
            $sql = "SELECT * FROM transactions WHERE u_name='".$uname."'";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0){
                while ($row = $res->fetch_assoc()){
                    date_default_timezone_set("Asia/Colombo");
                  $date = $row["r_date"];
                  $time = $row["r_time"];
                  $amount = $row["r_amount"];
                  $payment = $row["payment"];
                  $details = $row["details"];
                  $rdid = $row["t_id"];
                 



                  ?>
                     <tr style="font-size: 1.2em;">
                      <td><?php echo $date; ?></td>
                      <td><?php echo $time; ?></td>
                      <td><?php echo $amount; ?></td>
                      <td><?php echo $payment; ?></td>
                      <td><?php echo $details; ?></td>
                      
                     </tr>
                  <?php
                       
                }
             }
            ?>
           

       </table>

       <br><br><br>

       </div>

       <br><br>
   </div>
  
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

 </body>
 </html>