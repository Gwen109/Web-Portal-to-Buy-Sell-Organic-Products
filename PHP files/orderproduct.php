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

if(!isset($_GET['from'])){

	echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';

$psql="select * from products where id=".$_GET['productid'];
$pres=mysqli_query($conn,$psql);
$prow=mysqli_fetch_array($pres);


echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>ProductPhoto</th><th>ProductName</th><th>Price</th><th>Quantity</th><th>Unit</th></tr><tr><td><img width="100px" height="100px" src="'.$prow['photo'].'" alt="img" /></td><td>'.$prow['productname'].'</td><td>'.$prow['price'].'</td><td>'.$prow['quantity'].'</td><td>'.$prow['unit'].'</td></table>';

echo'<center>
<form method="GET" action="">
<input type="hidden" name="productid" value="'.$_GET['productid'].'" >
<input type="hidden" name="productname" value="'.$prow['productname'].'" >
<input type="hidden" name="productprice" value="'.$prow['price'].'" >
<input type="hidden" name="sellerid" value="'.$prow['userid'].'" >
<input type="hidden" name="from" value="afterorder" >
<label>Enter Quantity :</label><input type="number" name="orderquantity" required><br>
<input type="submit" value="Order">
</form>';

}

else if(isset($_GET['orderquantity'])){

if(isset($_SESSION['userid'])){

$orderprice=$_GET['productprice']*$_GET['orderquantity'];

$sql="insert into orders(customerid,sellerid,productid,productname,quantity,date,price,status) values(".$_SESSION['userid'].",".$_GET['sellerid'].",".$_GET['productid'].",'".$_GET['productname']."',".$_GET['orderquantity'].",'".date("d-m-Y")."',".$orderprice.","."'Ordered')";

$res=mysqli_query($conn,$sql);

   if($res){

   	$_SESSION['ordered']="True";
 	header("Location:buyproducts.php");

   }	

}

else{
	$_SESSION['ShouldLogin']="True";
	header("Location:index.php");
}










}

?>