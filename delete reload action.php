<?php
  session_start();
  include 'db.php';



  //***********GET id from delete************
  if (isset($_GET['did'])) {
    // code...
    $rdid = $_GET['did'];

  }
      

      

  //$rid = $_SESSION['id'];

  $sql = "DELETE FROM reload_amount WHERE r_id = '".$rdid."'";

  $res = mysqli_query($conn,$sql);

  if ($res) {
  	// code...
  	?>
<script type="text/javascript">
window.location.href = 'delete reload record.php';
</script>
<?php
  }else {
    echo "Something wrong";
  }




?>