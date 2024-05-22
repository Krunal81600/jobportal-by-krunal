<?php
include('config.php');
session_start();

$id=$_SESSION['member_id'];
mysqli_query($con,"UPDATE `user` SET `online`='0' WHERE id='$id'");

session_destroy();
echo "<script type='text/javascript'>";
echo "window.location='index'";
echo "</script>";
?>