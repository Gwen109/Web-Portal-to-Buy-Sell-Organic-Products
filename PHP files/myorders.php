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
require "connection.php";
session_start();

if(isset($_SESSION['userid'])){


echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


echo'<center><h3>ORDER DETAILS</h3></center><br>
		<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Order No</th><th>ProductName</th><th>CompanyName</th><th>Quantity</th><th>Date</th><th>Status</th></tr>';
		
		$sql="select * from orders where customerid=".$_SESSION['userid']." order by id desc";
		$res=mysqli_query($conn,$sql);
		$nooforders=mysqli_num_rows($res);
              
              while($row=mysqli_fetch_array($res)){

                    $csql="select * from shops where userid=".$row['sellerid'];
		            $cres=mysqli_query($conn,$csql);
		            $crow=mysqli_fetch_array($cres);

			echo '<tr><td>'.$nooforders.'</td><td>'.$row['productname'].'</td><td>'.$crow['ShopName'].'</td><td>'.$row['quantity'].'</td><td>'.$row['date'].'</td><td>'.$row['status'].'</td></tr>';
			$nooforders=$nooforders-1;

		        }
		echo'</table>';

}

else{

$_SESSION['ordersviewlogin']="True";
header("Location:buyproducts.php");

}
?>