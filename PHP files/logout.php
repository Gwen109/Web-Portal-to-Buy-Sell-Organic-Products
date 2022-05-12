<?php

session_start();
session_unset();
session_destroy();/* <!--unsets the values in the variables and deletes them-->*/

header("Location:index.php");
exit();

?>

