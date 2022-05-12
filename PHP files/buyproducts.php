<?php
require 'connection.php';
session_start();

if(isset($_SESSION['nosearchdetails'])){
     echo'<script> alert("Please fill some details to search"); </script>';
     unset($_SESSION['nosearchdetails']);  
}

if(isset($_SESSION['ordered'])){
     echo'<script> alert("Sucessfully Ordered"); </script>';
     unset($_SESSION['ordered']);  
}

if(isset($_SESSION['ordersviewlogin'])){
     echo'<script> alert("Login to see your orders"); </script>';
     unset($_SESSION['ordersviewlogin']);  
}

// selecting all shop names ,product names to display as dropdown list while typing company name
$shopsql="select ShopName from shops";
$shopres=mysqli_query($conn,$shopsql);

$prodsql="select productname from products";
$prodres=mysqli_query($conn,$prodsql);


?>
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




<center>
<h3>Search by giving any of the following details </h3><br>

<form method="GET" action="">
<input type="hidden" name="aftersearch" value="yes"> 
<label>Product Name: </label>

<input list="productname" name="productname" ><br>
  
    <datalist id="productname">
      <?php
       while($prodrow=mysqli_fetch_array($prodres)){
          echo'<option value="'.$prodrow['productname'].'">';
      } ?> 
   </datalist>

<label>Company Name: </label>


<input list="companyname" name="companyname" ><br>
  
    <datalist id="companyname">
      <?php
       while($shoprow=mysqli_fetch_array($shopres)){
          echo'<option value="'.$shoprow['ShopName'].'">';
      } ?> 
   </datalist>

<label>Place (Area/City/District/State) : </label><input type="text" name="place" ><br>
<button type="submit">Submit </button>
</form>
</center>
</body></html>

<?php


if(isset($_GET['aftersearch'])){

//cond 1
if($_GET['productname']!="" && $_GET['companyname']=="" && $_GET['place']==""){


$sql="select * from products inner join shops on products.userid = shops.userid where productname='".$_GET['productname']."'";
$res=mysqli_query($conn,$sql);


if(mysqli_num_rows($res)==0){
  echo'<center><h2>No result found for : "'.$_GET['productname'].'"</h2></center>';
  exit();
}

echo'<br><h2>Showing the results for : "'.$_GET['productname'].'"</h2>'; 

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Product Name</th><th>Price</th><th>Company Name</th><th>Location</th><th>View</th></tr>';


while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['productname'].'</td><td>'.$row['price'].'</td><td>'.$row['ShopName'].'</td><td> '.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=productdetails&userid='.$row['userid'].'&productname='.$row['productname'].'">View Details</a>';

}

}


//cond 2
else if($_GET['productname']!="" && $_GET['companyname']!="" && $_GET['place']=="")
{

$sql="select * from products inner join shops on products.userid = shops.userid where productname='".$_GET['productname']."' and ShopName='".$_GET['companyname']."'";
$res=mysqli_query($conn,$sql);

if(mysqli_num_rows($res)==0){
  echo'<center><h2>No result found for : "'.$_GET['productname'].'" and "'.$_GET['companyname'].'"</h2></center>';
  exit();
}

echo'<br><h2>Showing the results  for : "'.$_GET['productname'].'" and "'.$_GET['companyname'].'"</h2>'; 

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Product Name</th><th>Price</th><th>Company Name</th><th>Location</th><th>View</th></tr>';

while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['productname'].'</td><td>'.$row['price'].'</td><td>'.$row['ShopName'].'</td><td> '.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=productdetails&userid='.$row['userid'].'&productname='.$row['productname'].'">View Details</a>';

}

}


//cond 3
else if($_GET['productname']!="" && $_GET['companyname']=="" && $_GET['place']!="")
{
  
$sql="select * from products inner join shops on products.userid = shops.userid where productname='".$_GET['productname']."' and (ShopArea='".$_GET['place']."' or ShopCity='".$_GET['place']."' or ShopDistrict='".$_GET['place']."' or ShopState='".$_GET['place']."')";
$res=mysqli_query($conn,$sql);

if(mysqli_num_rows($res)==0){
  echo'<center><h2>No result found  for : "'.$_GET['productname'].'" and "'.$_GET['place'].'"</h2></center>';
  exit();
}

echo'<br><h2>Showing the results  for : "'.$_GET['productname'].'" and "'.$_GET['place'].'"</h2>'; 

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Product Name</th><th>Price</th><th>Company Name</th><th>Location</th><th>View</th></tr>';

while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['productname'].'</td><td>'.$row['price'].'</td><td>'.$row['ShopName'].'</td><td> '.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=productdetails&userid='.$row['userid'].'&productname='.$row['productname'].'">View Details</a>';


}
}

//cond 4
else if($_GET['productname']!="" && $_GET['companyname']!="" && $_GET['place']!="")
{

$sql="select * from products inner join shops on products.userid = shops.userid where productname='".$_GET['productname']."' and (ShopName='".$_GET['companyname']."') and (ShopArea='".$_GET['place']."' or ShopCity='".$_GET['place']."' or ShopDistrict='".$_GET['place']."' or ShopState='".$_GET['place']."')";
$res=mysqli_query($conn,$sql);

if(mysqli_num_rows($res)==0){
  echo'<center><h2>No result found for : "'.$_GET['productname'].'" and "'.$_GET['companyname'].'" and "'.$_GET['place'].'"</h2></center>';
  exit();
}

echo'<br><h2>Showing the results  for : "'.$_GET['productname'].'" and "'.$_GET['companyname'].'" and "'.$_GET['place'].'"</h2>'; 

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Product Name</th><th>Price</th><th>Company Name</th><th>Location</th><th>View</th></tr>';

while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['productname'].'</td><td>'.$row['price'].'</td><td>'.$row['ShopName'].'</td><td> '.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=productdetails&userid='.$row['userid'].'&productname='.$row['productname'].'">View Details</a>';


}
}

//cond 5
else if($_GET['productname']=="" && $_GET['companyname']!="" && $_GET['place']=="")
{
  
$sql="select * from shops where ShopName='".$_GET['companyname']."'";
$res=mysqli_query($conn,$sql);


if(mysqli_num_rows($res)==0){
  echo'<center><h2>No result found for : "'.$_GET['companyname'].'"</h2></center>';
  exit();
}

echo'<br><h2>Showing the results  for : "'.$_GET['companyname'].'"</h2>'; 

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Company Name</th><th>Location</th><th>View</th></tr>';


while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['ShopName'].'</td><td> '.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=companydetails&id='.$row['id'].'">View Details</a>';

}
}


//cond 6
else if($_GET['productname']=="" && $_GET['companyname']!="" && $_GET['place']!="")
{
  
$sql="select * from shops where ShopName='".$_GET['companyname']."' and (ShopArea='".$_GET['place']."' or ShopCity='".$_GET['place']."' or ShopDistrict='".$_GET['place']."' or ShopState='".$_GET['place']."')";
$res=mysqli_query($conn,$sql);

if(mysqli_num_rows($res)==0){
  echo'<center><h2>No result found for : "'.$_GET['companyname'].'" and "'.$_GET['place'].'"</h2></center>';
  exit();
}

echo'<br><h2>Showing the results  for : "'.$_GET['companyname'].'" and "'.$_GET['place'].'"</h2>'; 

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Company Name</th><th>Location</th><th>View</th></tr>';


while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['ShopName'].'</td><td> '.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=companydetails&id='.$row['id'].'">View Details</a>';
  

}
}


//cond 7
else if($_GET['productname']=="" && $_GET['companyname']=="" && $_GET['place']!="")
{
$sql="select * from shops where ShopArea='".$_GET['place']."' or ShopCity='".$_GET['place']."' or ShopDistrict='".$_GET['place']."' or ShopState='".$_GET['place']."'";
$res=mysqli_query($conn,$sql);


if(mysqli_num_rows($res)==0){
  echo'<center><h2>No result found  for : "'.$_GET['place'].'"</h2></center>';
  exit();
}

echo'<br><h2>Showing the results  for : "'.$_GET['place'].'"</h2>'; 

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Company Name</th><th>Location</th><th>View</th></tr>';


while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['ShopName'].'</td><td> '.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=companydetails&id='.$row['id'].'">View Details</a>';

}
}  

else{
      $_SESSION['nosearchdetails']="True";
      header("Location:buyproducts.php");
}

}




else{  //didnt search itself , so default company names in ASC order 

$sql="select * from shops order by shopname asc";
$res=mysqli_query($conn,$sql);

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Company Name</th><th>Location</th><th>View</th></tr>';

while($row=mysqli_fetch_array($res)){

  echo'<tr><td>'.$row['ShopName'].'</td><td>'.$row['ShopCity'].' '.$row['ShopDistrict'].' '.$row['ShopState'].'</td><td> <a href="viewcompanyproductdetails.php?from=companydetails&id='.$row['id'].'">View Company Details</a>';

}

}

?>





















