<?php include 'db.php';
      session_start();
     // $uname = $_SESSION['uname'];
      
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
  
  <?php
      if (isset($_GET['viewname'])) {
    // code...
    $uname = $_GET['viewname'];
    $_SESSION['uname'] = $uname;

  }

 


   if (isset($_POST['save'])) {
    // code...
    
      $uname = $_POST['uname'];
      $amount = $_POST['amount'];
      $dtls = $_POST['dtls'];
      date_default_timezone_set("Asia/Colombo");
      $date = date("d-m-Y");
      //$tdate = date("Y-m-d");
      $time = date("h:i:sa");





      if (is_numeric($amount)) {
        // code...
        //insert customer details

        $sql1 = "INSERT INTO transactions (u_name   , r_amount , details ,  r_date ,  r_time  )
        VALUES ('$uname','$amount','$dtls','$date', '$time')";

   $result1 = mysqli_query($conn, $sql1);
     
                $sql = "INSERT INTO reload_amount (u_name   , r_amount , details ,  r_date ,  r_time  )
                  VALUES ('$uname','$amount','$dtls','$date', '$time')";
     
             $result = mysqli_query($conn, $sql);
     
             if ($result) {
                 // code...
                 
                 ?>
<script type="text/javascript">
window.location.href = 'admin user view.php';
</script>
<?php
             
             }else {
                 echo "error.................";
             }
     
       }else {
        echo '<script type="text/javascript">',
     'alert("Add only Number for amount..!..");',
     '</script>'
;
        
      }
      }
  ?>

  <div class="container">
    <a href="admin.php"><button style="margin-top: 20px;" class="btn btn-success">Back</button></a>
    <center><h1><span style="font-size: 1.9em;"><?php $uname = $_SESSION['uname']; echo $uname; ?></span>'s Transactions</h1></center>
  <br>
  <button onclick="openForm()" class="btn btn-info">Add Amount</button>

  
  <button onclick="openForm1()" class="btn btn-info">Payment</button>
  <?php echo '<a style="float: right;" href="admin view transactions.php?viewname='.$uname.'"><button class="btn btn-success">All Transactions</button></a>'; ?>
  </div>



<div class="loginPopup">
      <div class="formPopup" id="popupForm">
        <form action="admin user view.php" class="formContainer" method="post">
          <h2 style="background-color: white;">Add Amount to <?php echo $uname; ?></h2>
          
          <label for="amount">
            <strong style="background-color: white;">Amount</strong>
          </label>

          <input type="text" id="amount" placeholder="Amount" name="amount" required>
          <span id="error"></span>

          <label for="dtls">
            <strong style="background-color: white;">Details</strong>
          </label>
          <input type="text" id="dtls" placeholder="Details" name="dtls">
          <input type="hidden" name="uname" value='<?=$uname?>'>
          
          <button onclick="errorMessage()" type="submit" class="btn" name="save">Save</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>
    </div>

    <div class="loginPopup">
      <div class="formPopup" id="popupForm1">
        <form action="admin user view.php" class="formContainer" method="post">
          <h2 style="background-color: white;">Add Payment of  <?php echo $uname; ?></h2>
          
          <label for="amount">
            <strong style="background-color: white;">Paid Amount</strong>
          </label>

          <input type="text" id="amount" placeholder="Amount" name="pamount" required>
          <span id="error"></span>

          <label for="dtls">
            <strong style="background-color: white;">Details</strong>
          </label>
          <input type="text" id="dtls" placeholder="Details" name="dtls">
          <input type="hidden" name="uname" value='<?=$uname?>'>
          
          <button onclick="errorMessage()" type="submit" class="btn" name="paid">Save</button>
          <button type="button" class="btn cancel" onclick="closeForm1()">Close</button>
        </form>
      </div>
    </div>
    <?php
      if (isset($_POST['paid'])){
         $pamount = $_POST['pamount'];
         $pdtls = $_POST['dtls'];
         $uname = $_POST['uname'];
         date_default_timezone_set("Asia/Colombo");
         $date = date("d-m-Y");
         $time = date("h:i:sa");
         $paid = $pamount;
         $givemoney = 0;

         if (is_numeric($pamount)){
          $sql2 = "INSERT INTO transactions (u_name   , payment , details ,  r_date ,  r_time  )
          VALUES ('$uname','$pamount','$pdtls','$date', '$time')";
  
     $result2 = mysqli_query($conn, $sql2);

          $sql = "SELECT * FROM reload_amount WHERE u_name='".$uname."'";
             $res = mysqli_query($conn, $sql);

              if (mysqli_num_rows($res) > 0){
                while ($row = $res->fetch_assoc()){
                  $did = $row["r_id"];
                  $amount = $row["r_amount"];
                  $balance = $pamount;
                  $pamount = $pamount-$amount;
                  $givemoney = $givemoney + $amount;

                  if ($pamount>0) {
                    // code...
                    $sql = "DELETE FROM reload_amount WHERE r_id = '".$did."'";
                    $res1 = mysqli_query($conn,$sql);


                  }else if ($pamount==0) {
                    // code...
                    $sql = "DELETE FROM reload_amount WHERE r_id = '".$did."'";
                    $res2 = mysqli_query($conn,$sql);
                    if ($res2) {
                      // code...
                     
                      ?>
<script type="text/javascript">
window.location.href = 'admin user view.php';
</script>
<?php
                    }
                  }else if ($pamount<0) {
                    
             $camount = $amount;
             $namount = $camount - $balance;

             $sql = "UPDATE reload_amount SET r_amount = $namount, details = 'Balance after paid : $givemoney - $paid = $namount' WHERE r_id = '".$did."'";

             $result = mysqli_query($conn,$sql);
              ?>
             <div class="text-danger">
              <p class="fs-5">
                <?php
              echo 'Payment ';
             echo $balance;
             echo ' is Recorded successfully... ';
               ?>
              </p>
              
             </div>
             <?php
             break;

                    }
                  }
                  if ($pamount>0) {
                    // code...
                    date_default_timezone_set("Asia/Colombo");
                    $date = date("d-m-Y");
                    $time = date("h:i:sa");
                    $sql = "INSERT INTO reload_amount (u_name   , r_amount , details ,  r_date ,  r_time  )
                  VALUES ('$uname','-$pamount','You paid more then your total amount','$date', '$time')";
     
             $result = mysqli_query($conn, $sql);

                   // echo 'Balance = ';
                   // echo $pamount;
                  }
                }else {
                  echo "There is no amount to reduce. Balance = ";
                echo $pamount;
                }

              }else {
                echo "Add only Number for amount....!";
              }

         

              }


      //}
     ?>

      <div class="loginPopup">
      <div class="formPopup2" id="popupForm2">
        <form action="admin user view.php" class="formContainer" method="post">
        <h2 style="background-color: white;">Do you want to <span style="color: red; background-color: white;">delete</span> <strong style="background-color: white;"><?php echo $uname; ?></strong></h2>
          
          <input type="hidden" name="uname" value='<?=$uname?>'>
          
          <button type="submit" class="btn" name="delete">Yes</button>
          <button type="button" class="btn cancel" onclick="closeForm2()">No</button>
        </form>
      </div>
    </div>

    <?php
     

       if (isset($_POST['delete'])){
           $uname = $_POST['uname'];

           $sql = "SELECT * FROM reload_amount WHERE u_name='".$uname."'";
             $res = mysqli_query($conn, $sql);

             if (mysqli_num_rows($res) > 0){
              ?>
              <div class="text-danger">
                <p class="fs-4"><?php echo "Delete the Transaction Records before Delete the User..."; ?></p>
              </div>
              <?php
                
             }else {
                 $sql = "DELETE FROM user WHERE u_name='".$uname."'";

           $res = mysqli_query($conn,$sql); 

           if ($res) {
    // code...
    ?>
<script type="text/javascript">
window.location.href = 'admin.php';
</script>
<?php

  }
             }

          
       }
     ?>

     <div class="loginPopup">
      <div class="formPopup2" id="popupForm3">
        <form action="admin user view.php" class="formContainer" method="post">
          <h2>Do you want to <span style="color: red;">delete</span> this record?? </h2>
          
          <input type="hidden" name="rdid" value='<?=$rdid?>'>
          
          <button type="submit" class="btn" name="rdelete">Yes</button>
          <button type="button" class="btn cancel" onclick="closeForm3()">No</button>
        </form>
      </div>
    </div>

    <?php
         
         
         if (isset($_POST['rdelete'])){
          $rdid = $_SESSION['rid'];
          //$rdid = $_POST['rdid'];

          $sql = "DELETE FROM reload_amount WHERE r_id= '".$rdid."'";

           $res = mysqli_query($conn,$sql);

           if ($res) {
             // code...
            ?>
<script type="text/javascript">
window.location.href = 'admin user view.php';
</script>
<?php
           }
         }
     ?>



    <div class="container">

  
  
    <h1 class="text-primary">
   </h1>
        <br>
        
        <div class="col">
          <table style="border-bottom: 6px solid #7F328C;" class="table table-striped">
          <thead class="table-dark">
          <tr>
            <th><h2 style="background-color: #191919;">Purchased Date</h2></th>
            <th><h2 style="background-color: #191919;">Purchased Time</h2></th>
            <th><h2 style="background-color: #191919;">Amount</h2></th>
            <th><h2 style="background-color: #191919;">Details</h2></th>
            
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
        

       
  
   
    </div>

    <div class="container">
      <div style="margin-top: 100px;">
      <button onclick="openForm2()" class="btn btn-danger">Delete this Person</button>
    </div>
    <div style="float: right;">
      <a href="delete reload record.php"><button class="btn btn-danger">Delete Records Manually</button></a>
    </div>
    </div>
     <br><br><br>


   

    <script>
    function errorMessage() {
        var error = document.getElementById("error")
        if (isNaN(document.getElementById("number").value)) 
        {
  
            // Changing HTML to draw attention
            error.innerHTML = "<span style='color: red;'>"+
                        "Please enter a valid number</span>"
        } else {
            error.innerHTML = ""
        }
    }
</script>

    <script>
      function openForm() {
        document.getElementById("popupForm").style.display = "block";
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
      }
    </script>
    <script>
      function openForm1() {
        document.getElementById("popupForm1").style.display = "block";
      }
      function closeForm1() {
        document.getElementById("popupForm1").style.display = "none";
      }
    </script>

    <script>
      function openForm2() {
        document.getElementById("popupForm2").style.display = "block";
      }
      function closeForm2() {
        document.getElementById("popupForm2").style.display = "none";
      }
    </script>

    <script>
      function openForm3() {
        document.getElementById("popupForm3").style.display = "block";
      }
      function closeForm3() {
        document.getElementById("popupForm3").style.display = "none";
      }
    </script>
 
 </div>   
</body>
</html>