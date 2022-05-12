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
session_start();
require "connection.php";

if(isset($_GET['user'])){

echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';	


$sql="select * from orders where id=".$_GET['orderid'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);

echo'<h3>DATE :</h3>'.$row['date'].'<br><br><h3>Product Name:</h3>'.$row['productname'].'<br><h3>Quantity ordered:</h3>'.$row['quantity'].'<br><h3>Order Price:</h3>'.$row['price'].'<br><h3>Status:</h3>'.$row['status'];

echo'<br><hr><h3>CUSTOMER DETAILS</h3>';

$csql="select * from users where id=".$row['customerid'];
$cres=mysqli_query($conn,$csql);
$crow=mysqli_fetch_array($cres);

echo'<br><h3>Customer Name:</h3>'.$crow['name'].'<br><h3>Phone No:</h3>'.$crow['phoneno'].'<br><h3>Email ID:</h3>'.$crow['emailid'].'<br><h3>Address:</h3>'.$crow['address'];

echo'<center><br><hr><h3>CHANGE STATUS </h3><br>
<form  method="GET" action="">
<input type="hidden" name="orderid" value="'.$_GET['orderid'].'" >
<input type="hidden" name="sellerid" value="'.$row['sellerid'].'" >
<select name="status">
<option value="ordered">Ordered</option>
<option value="transported">Transported</option>
<option value="delivered">Delivered</option>
</select><br>
<input type="submit" value="Change Status">
</form></center>';

}


else{   //update the status of the order

$sql="update orders set status='".$_GET['status']."' where id=".$_GET['orderid'];
$res=mysqli_query($conn,$sql);


if($res){

   $_SESSION['statuschange']="True";
   header("Location:sellproducts.php");

}

}

?>