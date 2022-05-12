<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
	
	<div class="container container-center" style="width: 400px; height: 530px;">
		<h1>Register</h1>
		<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST">
			<?php 
			if (isset($_POST['name']))	/*<!--storing the value-->*/
				echo'<input type="text" name="name" value="'.$_POST['name'].'" required>';
			else
				echo '<input type="text" name="name" placeholder="Name" required>';
			?>

			<?php 
			if (isset($_POST['Phoneno']))
				echo'<input type="text" name="phoneno" value="'.$_POST['phoneno'].'" required>';
			else
				echo '<input type="text" name="phoneno" placeholder="Phone Number" required>';
			?>
			
			<?php 
			if (isset($_POST['emailid']))
				echo'<input type="text" name="emailid" value="'.$_POST['emailid'].'" required>';
			else
				echo '<input type="text" name="emailid" placeholder="EmailID" required>';
			?>
			<?php 
			if (isset($_POST['address']))
				echo'<input type="text" name="address" value="'.$_POST['address'].'" required>';
			else
				echo '<input type="text" name="address" placeholder="Address" required>';
			?>
			<input type="password" name="pwd" placeholder="Password" required>
			<button type="submit">Register</button>
			<span>Already an user ? <a href="login.php">Login</a></span>
		</form>
	</div>
	<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$name=$_POST['name'];
		$phoneno=$_POST['phoneno'];
		$emailid=$_POST['emailid'];
		$address=$_POST['address'];
		$password=$_POST['pwd'];

		$dbServerName="localhost";
		$dbUserName="root";
		$dbPassword="";
		$dbName="organic";

		$conn=mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);

		
		$sql="SELECT * FROM users WHERE emailid='$emailid';";
		$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)>0){
				echo'<script> alert("EmailID already registered!"); </script>';
				}
		else{
				$sql="INSERT INTO users(name,phoneno,emailid,address,password) VALUES ('$name','$phoneno','$emailid','$address','$password')";
				mysqli_query($conn,$sql);

				$sql="SELECT id FROM users WHERE emailid='$emailid';";
		        $result=mysqli_query($conn,$sql);
		        $row=mysqli_fetch_array($result);

				$_SESSION['userid']=$row['id'];
				
				if($result){
					$_SESSION['Newregister']=True;
					header("Location:login.php"); /*<!--redirects to this file-->*/
					//echo'<script> alert("Successfully Registered"); </script>';
				}
                 
				
				exit(); /*<!-- closes the current pg-->*/
			}

		}



	?>

</body>
</html>