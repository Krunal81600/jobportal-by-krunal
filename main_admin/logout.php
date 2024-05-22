<?php
include('../config.php');
session_start();

$id=$_SESSION['id'];
mysqli_query($con,"UPDATE `admin_user` SET `online`='0' WHERE id='$id'");

session_destroy();
echo "<script type='text/javascript'>";
echo "window.location='login'";
echo "</script>";
?>