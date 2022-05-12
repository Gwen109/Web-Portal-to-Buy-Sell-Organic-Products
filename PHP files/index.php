<?php
session_start();

if(isset($_SESSION['LoginNow'])){
  echo'<script> alert("Successfully Logged in");</script>';
  unset($_SESSION['LoginNow']);
}
if(isset($_POST['becomeseller'])){
  echo'<script> alert("Login or Register to become a seller");</script>';
  unset($_POST['becomeseller']);
}
if(isset($_SESSION['ShouldLogin'])){
  echo'<script> alert("Login or Register to Order");</script>';
  unset($_SESSION['ShouldLogin']);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body {
  font-family: Arial, Helvetica, sans-serif;
}

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

body {
 background-image: url("landing2.gif");
background-repeat:no-repeat;
 background-size: 1400px 656px;


}

.logout{
  float: right;
}

</style>
<title>Organic Products Portal</title></head>
<body>

<div class="navbar">
  
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="buyproducts.php">Buy Products</a>
  <a href="sellproducts.php">Sell Products</a>
  <a href="expertpage.php">Experts Page</a>
  <a class="logout" href="logout.php">Logout</a>
</div>



</body>
</html>
