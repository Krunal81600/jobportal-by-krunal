<?php
session_start();
error_reporting(0);
include("../config.php");

if(isset($_POST['Login']))
{

	$email=$_POST['email'];
    $password=$_POST['password'];
	
  $select=mysqli_query($con,"SELECT * FROM `admin_user` where email='".$email."' AND password='".md5($password)."'");
   
   $row=mysqli_fetch_array($select);
   if($row['ac_dac']=="deactive")
	{
		?>
	<script>
		alert("Your Account has been deactivated by Admin, please contact the Admin to get your account activated. Thanks.");
	</script>
	   
	<?php
		echo "<script type='text/javascript'>";
		echo "window.location='login'";
		echo "</script>";

	}
	else
	{
		if($row>0)
		{
			$_SESSION['id']=$row[0];
			$_SESSION["email"] = $email;
			$_SESSION["user"] = $row['user'];
		   
			$_SESSION["password"] = $password;
			
			$id=$row['id'];
			mysqli_query($con,"UPDATE `admin_user` SET `online`='1' WHERE id='$id'");
			
			echo "<script type='text/javascript'>";
			echo "window.location='index'";
			echo "</script>";
		}
		else
		{
			?>
		<script>
			alert("Your email and password is Wrong.");
	   </script>
	<?php
		}
	}		
	
}	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Africa Global Network</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="assets/img/favicon.png">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/ui.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
    </head>
    <body class="account no-social boxed separate-inputs" data-page="login">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <i class="user-img icons-faces-users-03"></i>
                        <form class="form-signin" role="form" method="POST">
                            <div class="append-icon">
                                <input type="email" name="email" id="name" class="form-control form-white username" placeholder="Enter Email Id" required style="margin-bottom: 8px;">
                                <i class="icon-user"></i>
                            </div>
                            <div class="append-icon m-b-20">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Enter Password" required>
                                <i class="icon-lock"></i>
                            </div>
                            <button type="submit" name="Login" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Sign In</button>
                            <div class="clearfix">
                                <p class="pull-left m-t-20"><a href="#">Forgot password?</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p class="account-copyright">
                <span>Copyright © 2017 </span><span>Africa Global Network</span>.<span>All rights reserved.</span>
            </p>
            
        </div>
        <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/plugins/gsap/main-gsap.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/backstretch/backstretch.min.js"></script>
        <script src="assets/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="assets/js/pages/login-v1.js"></script>
    </body>
</html>