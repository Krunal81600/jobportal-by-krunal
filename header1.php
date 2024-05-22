<?php include('config.php');
session_start();
?>
<?php
error_reporting(0);

if(isset($_POST['Login']))
{

$email=$_POST['email'];
$password=$_POST['password'];

$select=mysqli_query($con,"SELECT * FROM `user` where (email='".$email."' OR phone='".$email."') AND  password='".md5($password)."'");
$rew=mysqli_num_rows($select);
$row=mysqli_fetch_array($select);
$idu=$row['id'];

if($row['ac_dac']=="deactive")
{
	?>
<script>
	alert("Your Account has been deactivated by Admin, please contact the Admin to get your account activated. Thanks.");
</script>
   
<?php
	echo "<script type='text/javascript'>";
	echo "window.location='register'";
	echo "</script>";

}
else
{
	if($rew>0)
	{
		if(isset($_SESSION['url']))
		{
			if($row['rtype']=="Employer")
			{
				if($row['cactive']==1)
				{
					$_SESSION['member_id']=$row['id'];
					$_SESSION['member_email'] = $row['email'];
					$_SESSION['member_user'] = $row['user'];
					?>
					<script type='text/javascript'>
					window.location='<?php echo $_SESSION['url']; ?>'
					</script>
					<?php
				}
				else
				{
				?>
				<script>
					alert("Please Wait For Admin Approve..");
				</script>
				<?php
				}
			}
			else
			{
				$_SESSION['member_id']=$row['id'];
				$_SESSION['member_email'] = $row['email'];
				$_SESSION['member_user'] = $row['user'];
				?>
				<script type='text/javascript'>
				window.location='<?php echo $_SESSION['url']; ?>'
				</script>
				<?php
			}
		}
		else
		{
			if($row['rtype']=="Employer")
			{
				if($row['cactive']==1)
				{
					$_SESSION['member_id']=$row['id'];
					$_SESSION['member_email'] = $row['email'];
					$_SESSION['member_user'] = $row['user'];
					
					echo "<script type='text/javascript'>";
					echo "window.location='edit-profile-company'";
					echo "</script>";
				}
				else
				{
				?>
				<script>
					alert("Please Wait For Admin Approve..");
				</script>
				<?php
				}
			}
			else
			{
				$_SESSION['member_id']=$row['id'];
				$_SESSION['member_email'] = $row['email'];
				$_SESSION['member_user'] = $row['user'];
				
				echo "<script type='text/javascript'>";
				echo "window.location='user-edit-profile'";
				echo "</script>";
			}
		}
	}
	else
	{
		?>
	<script>
		alert("Your email or password is Wrong.");
	</script>
	<?php
	}
}
}

$sql1de = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='header2'");
$result1de = mysqli_fetch_array($sql1de);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="ScriptsBundle">
<title><?php echo $result1de['title1']; ?></title>
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<!-- BOOTSTRAPE STYLESHEET CSS FILES -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- JQUERY SELECT -->
<link href="css/select2.min.css" rel="stylesheet" />

<!-- JQUERY MENU -->
<link rel="stylesheet" href="css/mega_menu.min.css">

<!-- ANIMATION -->
<link rel="stylesheet" href="css/animate.min.css">

<!-- OWl  CAROUSEL-->
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/owl.style.css">

<!-- TEMPLATE CORE CSS -->
<link rel="stylesheet" href="css/style.css">

<!-- FONT AWESOME -->
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/et-line-fonts.css" type="text/css">

<!-- Google Fonts -->
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">
<style>
.mega-menu {
    margin: 0 auto;
    padding: 0;
    display: block;
    float: none;
    position: relative;
    z-index: 999;
    width: 100%;
    font-size: 16px;
    font-family: "Source Sans Pro",sans-serif;
    min-height: 60px;
    clear: both;
    box-sizing: border-box;
    background-color: #000;
}
.login-header-btn {
    background-color: transparent !important;
    color: #FFF !important;
    border: 1px solid;
}
.header-top-white .form-control {
    height: 35px;
    background-color:#F1F1F1 ;
    border: 1px solid #fff;
    border-radius: 0px;
}
.mega-menu .menu-links>li>a {
    margin: 0;
    padding: 0 20px;
    display: inline-block;
    float: none;
    width: 100%;
    color: #242424;
    font-weight: 600;
    font-size: 14px;
    line-height: 35px;
    position: relative;
    text-transform: uppercase;
}
section {
    padding: 30px 0px;
    position: relative;
    background-color: #607d8b;
}
label {
    font-size: 16px;
    font-weight: 600;
    text-transform: capitalize;
    color: white;
}
.login-header-btn {
	margin: 0 !important;
	padding: 0 20px;
	display: inline-block;
	float: none;
	font-weight: 600 !important;
	font-size: 14px !important;
	line-height: 40px !important;
	position: relative;
	text-transform: uppercase;
    border: 1px solid !important;
}
</style>
<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<div id="spinner">
        <div class="spinner-img"> <img alt="Opportunities Preloader" src="images/loader.gif" />
            <h2><?php echo $result1de['title2']; ?></h2>
        </div>
    </div>
    <div class="header-top-white">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="header-top-left header-top-info">
						<?php
							$log=mysqli_query($con,"SELECT * FROM `logo` WHERE id='1'");
							$rowlogo=mysqli_fetch_array($log);
							?>
                         <a href="index"><img src="images/<?php echo $rowlogo['logonm']; ?>" alt="logo" class="img-responsive"> </a>
                    </div>
                </div>
				<form method="POST" enctype="multipart/form-data">
                <div class="col-md-6 col-sm-5 col-xs-12">
				<div class="row">
					<div class="col-md-6 col-sm-3 col-xs-12">
						<div class="form-group">
                             <input type="text" name="email" placeholder="<?php echo $result1de['title3']; ?>" class="form-control">
                        </div>
					</div>					
					<div class="col-md-6 col-sm-3 col-xs-12">
						<div class="form-group">
                            <input type="password" name="password" placeholder="<?php echo $result1de['title4']; ?>" class="form-control">
                        </div>
					</div>
				</div>                
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
					<nav id="menu-1" class="mega-menu fa-change-black">
						<div class="header-top-right header-top-info">
							<ul class="menu-links pull-right">
								<li class="no-bg login-btn-no-bg"><input type="submit" name="Login" class="login-header-btn" value="<?php echo $result1de['title5']; ?>"></li>
								<p><a href="#" style="vertical-align: middle;padding-left:10px;color:#fff;"><?php echo $result1de['title6']; ?></a></p>
															
							</ul>
					   
					</div>
					</nav>
				</div>
			</form>
        </div>
    </div>
    </div>