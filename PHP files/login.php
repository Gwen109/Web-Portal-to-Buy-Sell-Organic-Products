<?php
session_start();

if(isset($_SESSION['Newregister'])){
	echo'<script> alert("Successfully Registered!! Kindly Login Now");</script>';
	unset($_SESSION['Newregister']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<style>
	.navbar {
  overflow: hidden;
  background-color: #096824;

}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.navbar a:hover{
  background-color: #074619;
}

	body{
		background-image: url("otherbg.png");
	}

</style>
<body>
	<div class="navbar">
  <a href="index.php">Home</a>
  
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a href="myorders.php">My Orders</a>
  <a class="logout" href="logout.php">Logout</a>
</div>
	
	
	<div class="container container-center" style="width: 350px; height: 400px;">
		<h1>Login</h1>
		<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST">
			<?php 
			/*if (isset($_POST['uname']))
				echo'<input type="text" name="uname" value="'.$_POST['uname'].'" required>';
			else
				echo '<input type="text" name="uname" placeholder="EmailID" required>'; 
				*/
			?>
			<input type="text" name="emailid" placeholder="EmailID" required>
			
			<input type="password" name="pwd" placeholder="Password" required>

			<button type="submit">Submit </button><br>

			<span>Didn't register yet? Then <a href="register.php">Register</a></span>
		</form>
	</div>

    <?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$emailid=$_POST['emailid'];
		$password=$_POST['pwd'];
		

		$dbServerName="localhost";
		$dbUserName="root";
		$dbPassword="";
		$dbName="organic";

		$conn=mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);

		
		$sql="SELECT * FROM users WHERE emailid='$emailid';";
		
		
		$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result) != 1){
			echo'<script> alert("EmailID not found!"); </script>';

				} 
		else{
			
			$row=mysqli_fetch_assoc($result); 


			if($password != $row['password']){
				echo'<script> alert("EmailID or Password is wrong!"); </script>';
				}
			else{
				

				$_SESSION['userid']=$row['id'];
				$_SESSION['LoginNow']=True;
				header("Location:index.php");
				
				
				exit(); 			
			}

		}



	}
    ?>
</body>
</html>