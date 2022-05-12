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


if(isset($_SESSION['Expertadded'])){
	echo'<script> alert("Successfully added as Expert"); </script>';
	unset($_SESSION['Expertadded']);
}


if(isset($_GET['topics'])){


$sql="insert into experts(userid,topics) values(".$_SESSION['userid'].",'".$_GET['topics']."')";
echo $sql;
$res=mysqli_query($conn,$sql);
if($res){
	$_SESSION['Expertadded']="True";
	header("Location:expertpage.php");
}

}


if(isset($_SESSION['userid'])){ //logged in

echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


$sql="select * from experts where userid=".$_SESSION['userid'];
$res=mysqli_query($conn,$sql);

if(mysqli_num_rows($res)!=0) {  //already expert

echo"<center><h3>You are already Registered as Expert</h3></center>";

$sql="select * from experts";
$res=mysqli_query($conn,$sql);

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Name</th><th>Phone No.</th><th>EmailID</th><th>Topics</th></tr>';
      while($row=mysqli_fetch_array($res)){
          $esql="select * from users where id=".$row['userid'];
         $eres=mysqli_query($conn,$esql);
         $erow=mysqli_fetch_array($eres);

         echo '<tr><td>'.$erow['name'].'</td><td>'.$erow['phoneno'].'</td><td>'.$erow['emailid'].'</td><td>'.$row['topics'].'</td></tr>';

   }  echo"</table>";

}

else{  //logged in but not a expert


echo'<center><form action="expertpage.php" method="GET">
<h3>Enter the topics on which you are an expert</h3><br>
<textarea rows="4" cols="35" name="topics" required></textarea><br><br>
<input type="submit" value="Become Expert">
</form>     
</center><br><br>';

$sql="select * from experts";
$res=mysqli_query($conn,$sql);

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Name</th><th>Phone No.</th><th>EmailID</th><th>Topics</th></tr>';
      while($row=mysqli_fetch_array($res)){
      	 $esql="select * from users where id=".$row['userid'];
         $eres=mysqli_query($conn,$esql);
         $erow=mysqli_fetch_array($eres);

         echo '<tr><td>'.$erow['name'].'</td><td>'.$erow['phoneno'].'</td><td>'.$erow['emailid'].'</td><td>'.$row['topics'].'</td></tr>';

   }  echo"</table>";


}

}

else{

echo'<div class="navbar">
    <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>';


echo'<script> alert("Kindly Login/Register to become an Expert");  </script>';

$sql="select * from experts";
$res=mysqli_query($conn,$sql);

echo'<table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><tr><th>Name</th><th>Phone No.</th><th>EmailID</th><th>Address</th><th>Topics</th></tr>';
      while($row=mysqli_fetch_array($res)){
      	 $esql="select * from users where id=".$row['userid'];
         $eres=mysqli_query($conn,$esql);
         $erow=mysqli_fetch_array($eres);

         echo '<tr><td>'.$erow['name'].'</td><td>'.$erow['phoneno'].'</td><td>'.$erow['emailid'].'</td><td>'.$erow['address'].'</td><td>'.$row['topics'].'</td></tr>';

   }  echo"</table>";


}



?>