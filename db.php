<?php 

  $host = "localhost";
  $user = "root";
  $password = "";
  $db = "money_transaction";

  $conn = mysqli_connect($host, $user, $password, $db);

  if ($conn === false) {
  die("Connection failed: " . $conn -> connect_error);
}



 ?>