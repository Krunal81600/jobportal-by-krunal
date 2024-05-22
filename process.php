<?php
include('config.php');

//Check if form submitted
if(isset($_POST['submit']))
{

	$user_by = $_POST['user_by'];
	$user_to = $_POST['user_to'];
	$message = $_POST['message'];
	$type_us = $_POST['type_us'];
	
	//Set timezone
	$time = date('h:i:s',time());
	
	//Validate input
	if($message == '')
	{
		$error = "Please fill in a message";
		//header("Location: chat?error=".urlencode($error));
		echo "<script type='text/javascript'>";
		echo "window.location='chat?error=$error'";
		echo "</script>";
	} 
	else 
	{
		$query = mysqli_query($con,"INSERT INTO chatf (user_by,user_to, message, time,type_us)
				VALUES ('$user_by','$user_to','$message','$time','$type_us')");
		if(!$query)
		{
			die('Error: '.mysqli_error($con));
		} 
		else 
		{
			echo "<script type='text/javascript'>";
			echo "window.location='chat?id=$user_to'";
			echo "</script>";
			
		}
	}
}
?>