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

if($_GET['from']=="becomeseller"){

	echo'<div class="navbar">
  <a href="index.php">Home</a>  
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


echo'<center><h2>Fill the below details</h2><br>
<form method="GET" action="">
<input type="hidden" name="from" value="sellerregisterform" >

<label>Company Name :</label><input type="text" name="shopname" required><br>
<label>Company PhoneNo :</label><input type="number" name="shopphoneno" required><br>
<label>Company EmailID :</label><input type="email" name="shopemail" required><br>
<h3>Address of Company</h3><br>
<label>Plot No & Street:</label><input type="text" name="noStreet" ><br>
<label>Area :</label><input type="text" name="area" ><br>
<label>City :</label><input type="text" name="city" ><br>
<label>District :</label><input type="text" name="district" required ><br>
<label>State :</label><input type="text" name="state" required ><br>
<label>Organic Certificate Photo:</label><input type="file" name="certificatephoto" ><br>
<label>Organic Certificate link :</label><input type="text" name="certificatelink" ><br>
<input type="submit" value="Submit">
</form>
</center>';
}
else if($_GET['from']=="sellerregisterform"){
	echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


	$sql="insert into shops(userid,ShopName,ShopPhoneNo,ShopEmailId,ShopNoStreet,ShopArea,ShopCity,ShopDistrict,ShopState,CertificateLink,CertificatePhoto) values('".$_SESSION['userid']."','".$_GET['shopname']."','".$_GET['shopphoneno']."','".$_GET['shopemail']."','".$_GET['noStreet']."','".$_GET['area']."','".$_GET['city']."','".$_GET['district']."','".$_GET['state']."','".$_GET['certificatelink']."','".$_GET['certificatephoto']."')";

	$result=mysqli_query($conn,$sql);
		        
	if($result){
		echo'<center><h2>Company Registered Successfully</h2><a href="index.php">HomePage</a></center>';
	}
}
else if($_GET['from']=="managecompany"){

//Manage company details

	echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


$sql="select * from shops where userid=".$_SESSION['userid'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);


echo'<center><h2>Edit the details to be changed and leave the remaining as it is.</h2><br>
<form method="GET" action="">
<input type="hidden" name="from" value="managecompanyform" >

<label>Company Name :</label><input type="text" name="shopname" value ="'.$row['ShopName'].'" required><br>
<label>Company PhoneNo :</label><input type="number" name="shopphoneno" value ="'.$row['ShopPhoneNo'].'"required><br>
<label>Company EmailID :</label><input type="email" name="shopemail" value ="'.$row['ShopEmailId'].'" required><br>
<h3>Address of Company</h3><br>
<label>Plot No & Street:</label><input type="text" name="noStreet" value ="'.$row['ShopNoStreet'].'" ><br>
<label>Area :</label><input type="text" name="area" value ="'.$row['ShopArea'].'"><br>
<label>City :</label><input type="text" name="city" value ="'.$row['ShopCity'].'"><br>
<label>District :</label><input type="text" name="district" value ="'.$row['ShopDistrict'].'" required ><br>
<label>State :</label><input type="text" name="state" value ="'.$row['ShopState'].'" required ><br>

<label>Organic Certificate link :</label><input type="text" name="certificatelink" value ="'.$row['CertificateLink'].'"><br>
<input type="submit" value="Submit">
</form>
</center>';

}
else if($_GET['from']=="managecompanyform"){
 
 $sql="update shops set ShopName='".$_GET['shopname']."', ShopPhoneNo='".$_GET['shopphoneno']."',ShopEmailId='".$_GET['shopemail']."',ShopNoStreet='".$_GET['noStreet']."',ShopArea='".$_GET['area']."',ShopCity='".$_GET['city']."',ShopDistrict='".$_GET['district']."',ShopState='".$_GET['state']."',CertificateLink='".$_GET['certificatelink']."' where userid=".$_SESSION['userid'];

 $res=mysqli_query($conn,$sql);

 if($res){
 	$_SESSION['companyupdate']="True";
 	header("Location:sellproducts.php");
 }

}

else if($_GET['from']=="managecertificatephoto"){

	echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


$sql="select CertificatePhoto from shops where userid=".$_SESSION['userid'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);

echo '<center>
<form method="GET" action="">
<input type="hidden" name="from" value="uploadnewcertificate" >
<h2>UPLOAD NEW ORGANIC CERTIFICATE</h2>
<label>New Organic Certificate Photo:</label><input type="file" name="certificatephoto" ><br>
<input type="submit" value="Submit">
</form><br>
<img width="900px" height="1000px" src="'.$row['CertificatePhoto'].'" alt="img" /><br>


</center>';

}

else{

$sql="update shops set CertificatePhoto='".$_GET['certificatephoto']."' where userid=".$_SESSION['userid'];

$res=mysqli_query($conn,$sql);

if($res){
 	$_SESSION['certificateupdate']="True";
 	header("Location:sellproducts.php");
 }

}

?>