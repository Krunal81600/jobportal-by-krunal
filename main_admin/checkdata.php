<?php

include('../config.php');

if(isset($_POST['user_name']))
{
 $name=$_POST['user_name'];

 $checkdata=" SELECT * FROM user WHERE user='$name' ";

 $query=mysqli_query($con,$checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "User Name Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}

if(isset($_POST['user_email']))
{
 $emailId=$_POST['user_email'];

 $checkdata=" SELECT * FROM user WHERE email='$emailId' ";

 $query=mysqli_query($con,$checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "Email Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}
?>