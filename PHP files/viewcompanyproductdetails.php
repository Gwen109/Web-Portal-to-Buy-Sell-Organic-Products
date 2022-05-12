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

if($_GET['from']=="companydetails"){
    echo'<div class="navbar">
  <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


$sql="select * from shops where id=".$_GET['id'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);

echo'<center><h3>COMPANY DETAILS</h3></center>';
echo'<div style="width:100%;">';

echo'<div style="width: 50%; float:left;">
    <label>Company Name:</label>'.$row['ShopName'].'<br><label>Company EmailID:</label>'.$row['ShopEmailId'].'<br><label>Company PhoneNo:</label>'.$row['ShopPhoneNo'].'<br><label>Company EmailID:</label>'.$row['ShopEmailId'].'<br><label>Certificate Link :</label>';
    if($row['CertificateLink']!=""){
    echo'<a href="'.$row['CertificateLink'].'">'.$row['CertificateLink'].'</a>';
     }
    else{
        echo'Certificate Link not available';
    }

    echo'<br><label>Certificate Photo :</label>'; 
    if($row['CertificatePhoto']!=""){
        echo'<a href="viewcompanyproductdetails.php?from=viewcertificate&id='.$row['id'].'">View Organic Certificate Photo</a>';}
    else{ echo'Certificate not available';}
    echo'</div>';
echo'<div style="width: 50%; float:right;">
    <label>PlotNo,Street:</label>'.$row['ShopNoStreet'].'<br><label>Area:</label>'.$row['ShopArea'].'<br><label>City:</label>'.$row['ShopCity'].'<br><label>District:</label>'.$row['ShopDistrict'].'<br><label>State:</label>'.$row['ShopState'].'
    </div>';
echo'</div>';

$psql="select * from products where userid=".$row['userid']." order by productname asc";
$pres=mysqli_query($conn,$psql);

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>ProductPhoto</th><th>ProductName</th><th>Price</th><th>Quantity</th><th>Unit</th><th>Order</th></tr>';

while($prow=mysqli_fetch_array($pres)){

	echo'<tr><td><img width="100px" height="100px" src="'.$prow['photo'].'" alt="img" />
	     </td><td>'.$prow['productname'].'</td><td>'.$prow['price'].'</td><td>'.$prow['quantity'].'</td><td>'.$prow['unit'].'</td><td>'.'<a href="orderproduct.php?productid='.$prow['id'].'">Order</a>';

}
}

else if($_GET['from']=="productdetails"){
    echo'<div class="navbar">
  <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


$sql="select * from shops where userid=".$_GET['userid'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);

echo'<center><h3>COMPANY DETAILS</h3></center>';
echo'<div style="width:100%;">';

echo'<div style="width: 50%; float:left;">
    <label>Company Name:</label>'.$row['ShopName'].'<br><label>Company EmailID:</label>'.$row['ShopEmailId'].'<br><label>Company PhoneNo:</label>'.$row['ShopPhoneNo'].'<br><label>Company EmailID:</label>'.$row['ShopEmailId'].'<br><label>Certificate Link :</label>';
    if($row['CertificateLink']!=""){
    echo'<a href="'.$row['CertificateLink'].'">'.$row['CertificateLink'].'</a>';
     }
    else{
        echo'Certificate Link not available';
    }

    echo'<br><label>Certificate Photo :</label>'; 
    if($row['CertificatePhoto']!=""){
        echo'<a href="viewcompanyproductdetails.php?from=viewcertificate&id='.$row['id'].'">View Organic Certificate Photo</a>';}
    else{ echo'Certificate not available';}
    echo'</div>';
echo'<div style="width: 50%; float:right;">
    <label>PlotNo,Street:</label>'.$row['ShopNoStreet'].'<br><label>Area:</label>'.$row['ShopArea'].'<br><label>City:</label>'.$row['ShopCity'].'<br><label>District:</label>'.$row['ShopDistrict'].'<br><label>State:</label>'.$row['ShopState'].'
    </div>';
echo'</div>';

$psql="select * from products where userid=".$_GET['userid']." and productname='".$_GET['productname']."'";
$pres=mysqli_query($conn,$psql);

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>ProductPhoto</th><th>ProductName</th><th>Price</th><th>Quantity</th><th>Unit</th><th>Order</th></tr>';

while($prow=mysqli_fetch_array($pres)){

    echo'<tr><td><img width="100px" height="100px" src="'.$prow['photo'].'" alt="img" />
         </td><td>'.$prow['productname'].'</td><td>'.$prow['price'].'</td><td>'.$prow['quantity'].'</td><td>'.$prow['unit'].'</td><td>'.'<a href="orderproduct.php?productid='.$prow['id'].'">Order</a>';

}


}


else if($_GET['from']=="viewcertificate"){

    echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


$sql="select CertificatePhoto from shops where id=".$_GET['id'];
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);
if($row['CertificatePhoto']){

echo '<center>
<h2>ORGANIC CERTIFICATE</h2>

<img width="900px" height="1000px" src="'.$row['CertificatePhoto'].'" alt="img" />
</center>';

}
else{
    $_SESSION['certificate']="found";
    header("Location:viewcompanyproductdetails.php");
}
}


?>