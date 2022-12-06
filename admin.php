<?php include 'db.php';
     

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
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

</head>
<body>
    <div class="container">
      <a style="float: right; margin-top: 20px;" href="signout.php"><button class="btn btn-warning">Sign Out</button></a>
      <br>
        <center><h1 style="font-family: 'Roboto Slab', serif; font-size: 3.2em;">Customers</h1></center>

        <center>
            <table style="border-bottom: 6px solid #7F328C;" class="table table-striped">
            <thead class="table-dark">
    <tr>
      <th scope="col"><h1 style="background-color: #191919;">Full Name</h1></th>
      <th scope="col"><h1 style="background-color: #191919;">Name</h1></th>

      
      <th scope="col"><h1 style="background-color: #191919;">Total</h1></th>
      <th scope="col"><h1 style="background-color: #191919;">View</h1></th>
      
    </tr>
    </thead>

        <tbody>
           <?php
           $sql = "SELECT * FROM user";
           $res = mysqli_query($conn, $sql);
           $total_reload = 0;

           if (mysqli_num_rows($res) > 0){
            while ($row = $res->fetch_assoc()) {

              $id = $row["u_id"];
              $fname = $row["full_name"];
              $uname = $row["u_name"];



              //******************Calculating the Total Amount************

              $sql = "SELECT * FROM reload_amount WHERE u_name='".$uname."'";
             $reslt = mysqli_query($conn, $sql);
             $sum = 0;

             if (mysqli_num_rows($reslt) > 0){
              while ($row = $reslt->fetch_assoc()){
                $amount = $row["r_amount"];
                 $sum = $sum + $amount;
              }
             }
             $total_reload = $total_reload + $sum;
             echo ' <tr style="font-size: 1.2em;">
                <td>'.$fname.'</td>
                <td>'.$uname.'</td>
               
                <td>'.$sum.'</td>
                <td>
            <a class="text-light" href="admin user view.php?viewname='.$uname.'"><button class="btn btn-danger">View</button></a>
            
            
          </td>
            </tr>';

              
            }
           }

           ?>
            
          
        </tbody>
            </table>

            <br>
<h2>Your debtors' total amount is = <span style="color: red; font-weight: 300; font-size: 3.2em; font-family: 'Roboto Slab', serif; "><?php echo $total_reload; ?></span> Rupees</h2>

  
<br>

  
<button onclick="openForm()" class="btn btn-info">Add Customer</button>
  </center>
  <br><br>
    




<br>
<br>
<center><h1>*******************************************</h1></center>


 
  
 
 
    
    <div class="loginPopup">
      <div class="formPopup" id="popupForm">
        <form action="admin.php" class="formContainer" method="post">
          <h2 style="background-color: white;">Add Customer</h2>
          <label for="fname">
            <strong style="background-color: white;">Full Name</strong>
          </label>
          <input type="text" id="fname" placeholder="Full Name" name="fname" required>
          <label for="uname">
            <strong style="background-color: white;">Username</strong>
          </label>

          <input type="text" id="uname" placeholder="Username" name="uname" required>
          
          <button onclick="errorMessage()" type="submit" class="btn" name="save">Save</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>
    </div>

    <?php 

       if (isset($_POST['save'])) {
    // code...
    
      $fname = $_POST['fname'];
      $uname = $_POST['uname'];

           $sql = "SELECT * from user WHERE u_name = '$uname'";
           $res = mysqli_query($conn, $sql);

           if($res){
            if (mysqli_num_rows($res) > 0){
              
             echo '<script type="text/javascript">',
     'alert("Username is Already Exist..!..");',
     '</script>'
;

               
            }else {

                //insert customer details
     
                $sql = "INSERT INTO user (full_name  , u_name )
                  VALUES ('$fname','$uname')";
     
             $result = mysqli_query($conn, $sql);
     
             if ($result) {
                 // code...
                 ?>
                 <script type="text/javascript">
                 window.location.href = 'admin.php';
                </script>
                <?php
              echo "beebi";
             }else {
                 echo "error.................";
             }
     
     
       }
               
           }
}

    ?>

    <script>
      function openForm() {
        document.getElementById("popupForm").style.display = "block";
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
      }
    </script>

   
</body>
</html>