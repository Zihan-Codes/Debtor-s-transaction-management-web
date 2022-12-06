<?php 

   include 'db.php';
   session_start();

   if (isset($_POST['submit'])) {
   	$user = $_POST['name'];
   	$_SESSION['name'] = $user;

   	if ($user === "admin") {
   		?>
<script type="text/javascript">
window.location.href = 'admin.php';
</script>
<?php


   	}else {
        $sql = "SELECT * FROM user WHERE u_name = '".$user."'";
        $res = mysqli_query($conn, $sql);

        if ($res) {
        	// code...
        	if(mysqli_num_rows($res) > 0){
        		
        		?>
<script type="text/javascript">
window.location.href = 'user view.php';
</script>
<?php
        	}else {
        	echo "You are not Registered for the service...";
                ?>
<script type="text/javascript">
window.location.href = 'index.php';
</script>
<?php
        }
        	
        }
   	}
   }
?>