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

if(isset($_SESSION['addproduct'])){
	echo'<script> alert("Product added successfully"); </script>';
	unset($_SESSION['addproduct']);
}
if(isset($_SESSION['productupdate'])){
	echo'<script> alert("Product Details updated successfully"); </script>';
	unset($_SESSION['productupdate']);
}
if(isset($_SESSION['photoupdate'])){
	echo'<script> alert("Product photo updated successfully"); </script>';
	unset($_SESSION['photoupdate']);}
if(isset($_SESSION['productdelete'])){
	echo'<script> alert("Product deleted successfully"); </script>';
	unset($_SESSION['productdelete']);}

//normal products page
if(!(isset($_GET['from']))){

echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a href="manageproducts.php?from=addproduct"> Add Product</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';

$sql="select * from products where userid=".$_SESSION['userid'];
$res=mysqli_query($conn,$sql);

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>ProductPhoto</th><th>ProductName</th><th>Price</th><th>Quantity</th><th>Unit</th><th>ManageProduct</th></tr>';

while($row=mysqli_fetch_array($res)){

	echo'<tr><td><img width="100px" height="100px" src="'.$row['photo'].'" alt="img" /><br><a href="manageproducts.php?from=editphoto&productid='.$row['id'].'">Edit Photo</a>
	     </td><td>'.$row['productname'].'</td><td>'.$row['price'].'</td><td>'.$row['quantity'].'</td><td>'.$row['unit'].'</td><td>'.'<a href="manageproducts.php?from=edit&productid='.$row['id'].'">Edit</a>&nbsp; <a href="manageproducts.php?from=delete&productid='.$row['id'].'">Delete</a>';

}
}

//if they clicked any option add,edit,delete 

if(isset($_GET['from'])){

if($_GET['from']=="addproduct"){

echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


echo'<center><h2>Fill the product details</h2><br>
<form method="GET" action="">
<input type="hidden" name="from" value="addproductform" >

<label>Product Name :</label><input type="text" name="productname" required><br>
<label>Price :</label><input type="number" name="price" required><br>
<label>Quantity :</label><input type="number" name="quantity" required><br>
<label>Units(kg,item etc):</label><input type="text" name="unit" required><br>
<label>Upload Product Photo:</label><input type="file" name="productphoto" required><br>
<input type="submit" value="Submit">
</form>
</center>';
}

else if($_GET['from']=="addproductform"){


$sql="insert into products(productname,userid,quantity,price,unit,photo) values('".$_GET['productname']."','".$_SESSION['userid']."','".$_GET['quantity']."','".$_GET['price']."','".$_GET['unit']."','".$_GET['productphoto']."')";

	$result=mysqli_query($conn,$sql);
		        
	if($result){

	$_SESSION['addproduct']="True";
	header("Location:manageproducts.php");
	}

}

else if($_GET['from']=="edit"){

echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


$sql="select * from products where id=".$_GET['productid'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);

echo'<center><h2>Edit the product details and leave the remaining as it is</h2><br>
<form method="GET" action="">
<input type="hidden" name="from" value="editproductform" >
<input type="hidden" name="productid" value="'.$_GET['productid'].'" >
<label>Product Name :</label><input type="text" name="productname" value ="'.$row['productname'].'" required><br>
<label>Price :</label><input type="number" name="price" value ="'.$row['price'].'" required><br>
<label>Quantity :</label><input type="number" name="quantity" value ="'.$row['quantity'].'" required><br>
<label>Units(kg,item etc):</label><input type="text" name="units" value ="'.$row['unit'].'" required><br>
<input type="submit" value="Submit">
</form>
</center>';
}

else if($_GET['from']=="editproductform"){

$sql="update products set productname='".$_GET['productname']."', price='".$_GET['price']."',quantity='".$_GET['quantity']."',unit='".$_GET['units']."' where id=".$_GET['productid'];

 $res=mysqli_query($conn,$sql);

 if($res){
 	$_SESSION['productupdate']="True";
 	header("Location:manageproducts.php");
 }

}

else if($_GET['from']=="editphoto"){


echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';

$sql="select photo from products where id=".$_GET['productid'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);

echo '<center>
<img width="300px" height="300px" src="'.$row['photo'].'" alt="img" /><br>
<form method="GET" action="">
<input type="hidden" name="from" value="updateproductphoto" >
<input type="hidden" name="productid" value="'.$_GET['productid'].'" >
<h2>UPLOAD NEW PRODUCT PHOTO</h2>
<label>New Product Photo:</label><input type="file" name="productphoto" ><br>
<input type="submit" value="Submit">
</form><br>
</center>';

}

else if($_GET['from']=="updateproductphoto"){
$sql="update products set photo='".$_GET['productphoto']."' where id=".$_GET['productid'];

$res=mysqli_query($conn,$sql);

if($res){
 	$_SESSION['photoupdate']="True";
 	header("Location:manageproducts.php");
 }

}

else{

$sql="delete from products where id=".$_GET['productid'];

$res=mysqli_query($conn,$sql);

if($res){
 	$_SESSION['productdelete']="True";
 	header("Location:manageproducts.php");
 }
}



}

?>