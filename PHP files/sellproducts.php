<html>
<head>
<title>Buy Products</title>
<link rel="stylesheet" type="text/css" href="commonstyle.css">
<style>
	body{
		background-image: url("otherbg.png");
	}
</style>
</head>
<?php
require 'connection.php';
session_start();

if(isset($_SESSION['companyupdate'])){
	echo'<script> alert("Company details updated successfully"); </script>';
	unset($_SESSION['companyupdate']);
}
if(isset($_SESSION['certificateupdate'])){
	echo'<script> alert("Certificate updated successfully"); </script>';
	unset($_SESSION['certificateupdate']);
}
if(isset($_SESSION['statuschange'])){
	echo'<script> alert("Order Status changed successfully"); </script>';
	unset($_SESSION['statuschange']);

}


if(isset($_SESSION['userid'])){




	$sql="select * from shops where userid=".$_SESSION['userid'];
	$res=mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)==0){ //logged in but not a seller

echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';

		echo'Benefits and procedures,verification for selling
		<center><form method="GET" action="becomesellerpage.php" >
		<input type="hidden" name="from" value="becomeseller" >
    	<button type="submit">Become a seller</button> </form></center>';

	}
	else{    //logged in and a seller

       echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a href="becomesellerpage.php?from=managecertificatephoto">Manage Organic Certificate</a>
  <a href="becomesellerpage.php?from=managecompany">Manage Company Details</a>
  <a href="manageproducts.php">Manage Products</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


		echo'
		<br><center>
		<h2>ORDER DETAILS</h2></center><br>
		<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Order No</th><th>ProductName</th><th>Quantity</th><th>Date</th><th>Status</th></tr>';
		
		$sql="select * from orders where sellerid=".$_SESSION['userid']." order by id desc";
		$res=mysqli_query($conn,$sql);
		$nooforders=mysqli_num_rows($res);
              
              while($row=mysqli_fetch_array($res)){
			echo '<tr><td>'.$nooforders.'<br><a href="orderdetails.php?user=seller&orderid='.$row['id'].'">Details</a></td><td>'.$row['productname'].'</td><td>'.$row['quantity'].'</td><td>'.$row['date'].'</td><td>'.$row['status'].'</td></tr>';
			$nooforders=$nooforders-1;

		        }
		echo'</table>';

              
	}
}
else{ //didnt login/register

	echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div><br>';

	echo'Benefits and procedures,verification for selling
		<center><form method="POST" action="index.php" >
		<input type="hidden" name="becomeseller" value="becomeseller" >
    	<button type="submit">Become a seller</button></form></center>';

}

?>
