<?php include('config.php');
session_start(); 
error_reporting(0);
require_once 'fbConfig.php';
require_once 'User.php';

require_once 'inConfig.php';
//include_once 'User.class.php';

if(isset($accessToken)){
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		// Put short-lived access token in session
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
	  	// OAuth 2.0 client handler helps to manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		
		// Set default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	
	// Redirect the user back to the same page if url has "code" parameter in query string
	if(isset($_GET['code'])){
		header('Location: ./');
	}
	
	// Getting user facebook profile info
	try {
		$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// Redirect user back to app login page
		header("Location: ./");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	// Initialize User class
	$user = new User();
	
	// Insert or update user data to the database
	$fbUserData = array(
		'oauth_provider'=> 'facebook',
		'oauth_uid' 	=> $fbUserProfile['id'],
		'first_name' 	=> $fbUserProfile['first_name'],
		'last_name' 	=> $fbUserProfile['last_name'],
		'email' 		=> $fbUserProfile['email'],
		'gender' 		=> $fbUserProfile['gender'],
		'locale' 		=> $fbUserProfile['locale'],
		'picture' 		=> $fbUserProfile['picture']['url'],
		'link' 			=> $fbUserProfile['link']
	);
	//$insert_id="";
	$userData = $user->checkUser($fbUserData);
	
	// Put user data into session
	$_SESSION['userData'] = $userData;
	
	// Get logout url
	$logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'logout.php');
	
	// Render facebook profile data
	if(!empty($userData)){
		$output  = '<h1>Facebook Profile Details </h1>';
		$output .= '<img src="'.$userData['picture'].'">';
        $output .= '<br/>Facebook ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Facebook';
		$output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Facebook Page</a>';
        $output .= '<br/>Logout from <a href="'.$logoutURL.'">Facebook</a>'; 
		
		
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
	
	$email=$userData['email'];
	$sel=mysqli_query($con,"SELECT * FROM `user` WHERE email='$email'");
	$row=mysqli_fetch_array($sel);
	$_SESSION['member_id']=$row['id'];
	$_SESSION['member_user']=$row['user'];
	$_SESSION['member_email']=$row['email'];
	
}

$authUrl = $output = '';

//If user already verified 
if(isset($_SESSION['oauth_status']) && $_SESSION['oauth_status'] == 'verified' && !empty($_SESSION['userData']))
{
	//Prepare output to show to the user
	$userInfo = $_SESSION['userData'];

	$email=$userInfo['email'];
	$sel=mysqli_query($con,"SELECT * FROM `user` WHERE email='$email'");
	$row=mysqli_fetch_array($sel);
	$_SESSION['member_id']=$row['id'];
	$_SESSION['member_user']=$row['user'];
	$_SESSION['member_email']=$row['email'];
	
}elseif((isset($_GET["oauth_init"]) && $_GET["oauth_init"] == 1) || (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])))
{
	$client = new oauth_client_class;
	
	$client->client_id = $apiKey;
	$client->client_secret = $apiSecret;
	$client->redirect_uri = $redirectURL;
	$client->scope = $scope;
	$client->debug = false;
	$client->debug_http = true;
	$application_line = __LINE__;
	
	if(strlen($client->client_id) == 0 || strlen($client->client_secret) == 0){
		die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to Consumer key and client_secret with Consumer secret. '.
			'The Callback URL must be '.$client->redirect_uri.'. Make sure you enable the '.
			'necessary permissions to execute the API calls your application needs.');
	}
	
	//If authentication returns success
	if($success = $client->Initialize()){
		if(($success = $client->Process())){
			if(strlen($client->authorization_error)){
				$client->error = $client->authorization_error;
				$success = false;
			}elseif(strlen($client->access_token)){
				$success = $client->CallAPI('http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
				'GET',
				array('format'=>'json'),
				array('FailOnAccessError'=>true), $userInfo);
			}
		}
		$success = $client->Finalize($success);
	}
	
	if($client->exit) exit;
	
	if($success){
		//Initialize User class
		$user = new User();
		
		//Insert or update user data to the database
		$fname = $userInfo->firstName;
		$lname = $userInfo->lastName;
		$inUserData = array(
			'oauth_provider'=> 'linkedin',
			'oauth_uid'     => $userInfo->id,
			'first_name'    => $fname,
			'last_name'     => $lname,
			'email'         => $userInfo->emailAddress,
			'gender'        => '',
			'locale'        => $userInfo->location->name,
			'picture'       => $userInfo->pictureUrl,
			'link'          => $userInfo->publicProfileUrl,
			'username'		=> ''
		);
		
		$userData = $user->checkUser($inUserData);
		
		//Storing user data into session
		$_SESSION['userData'] = $userData;
		$_SESSION['oauth_status'] = 'verified';
		
		//Redirect the user back to the same page
		header('Location: ./');
	}else{
		 $output = '<h3 style="color:red">Error connecting to LinkedIn! try again later!</h3>';
	}
}elseif(isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> ""){
	$output = '<h3 style="color:red">'.$_GET["oauth_problem"].'</h3>';
}else{
	$authUrl = '?oauth_init=1';
}


$session_id=$_SESSION['member_id'];
$sele=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$rowus=mysqli_fetch_array($sele);

if($rowus['rtype']=="Employer" && $rowus['cactive']==0)
{
	?>
	<script>
		alert("Please fillup all fields and than wait for admin aaprove for further process.");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='edit-profile-company'";
	echo "</script>";
}

$sql1de = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='header1'");
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
<link rel="stylesheet" href="css/jquery.tagsinput.min.css">
<!-- FONT AWESOME -->
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/et-line-fonts.css" type="text/css">

<!-- Google Fonts -->
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">
<style>
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
    background-color: #fff;
}
.mega-menu>section.menu-list-items {
    padding: 20px 0;
    background-color: #000;
    padding-bottom: 10px;
}
.mega-menu .menu-links>li>a {
    margin: 0;
    padding: 0 20px;
    display: inline-block;
    float: none;
    width: 100%;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    line-height: 35px;
    position: relative;
    text-transform: uppercase;
}
.p-job {
    background-color: transparent !important;
    color: #FFF !important;
    font-weight: 600;
    border: 1px solid;
}
.mega-menu .menu-links>li:hover {
    background-color: rgba(41, 170, 254, 0) !important;
    color: #FFF !important;
}
.dropdown-menu {
    max-height: 320px;
    overflow-y: scroll;
	min-width: 250px;
    min-height: 250px;
}
.dropdown-menu li a
{
	padding: 12px 20px 6px 20px;
	border-bottom: 1px solid #eee;
}
.dropdown-menu li 
{
	border-bottom: 1px solid #eee;
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
    color: #262626;
    text-decoration: none;
    background-color: #000 !important;
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

<script type="text/javascript" src="http://africaglobalnetwork.com/livechat/php/app.php?widget-init.js"></script>

</head>
<body>
<div class="page">
    <div id="spinner">
        <div class="spinner-img"> <img alt="Opportunities Preloader" src="images/loader.gif" />
            <h2><?php echo $result1de['title13']; ?></h2>
        </div>
    </div>
	
    <nav id="menu-1" class="mega-menu fa-change-black" data-color=""> 
        <section class="menu-list-items container">
			<div class="container">		
            <ul class="menu-logo">
                        <li>
							<?php
							$log=mysqli_query($con,"SELECT * FROM `logo` WHERE id='1'");
							$rowlogo=mysqli_fetch_array($log);
							?>
							<a href="index"><img src="images/<?php echo $rowlogo['logonm']; ?>" alt="logo" class="img-responsive"> </a>
                        </li>
                    </ul>
            <ul class="menu-links pull-right">
               <?php
				if($rowus['rtype']=="Employer")
				{} else {
				?>
				<li class="hidden-sm"><a href="index"><i class="fa fa-suitcase"></i> <?php echo $result1de['title2']; ?> </a></li>
				<?php } ?>
				<!-- <li class="hidden-sm"><a href="create_resume"><i class="fa fa-suitcase"></i> <?php echo $result1de['title3']; ?></a></li> -->
                <?php
				if($_SESSION['member_user']=="")
				{ } else { ?> <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <?php echo $result1de['title12']; ?> </a>
				<ul class="dropdown-menu scrollable-menu" role="menu" style="left: inherit;">
					<?php
                        $iid=$_SESSION['member_id'];
                        $selectaa=mysqli_query($con,"SELECT * FROM `notification` where  noti_status='0' AND type='admin' AND byuser_id='$iid' ORDER BY  `id` DESC");
						$counter=mysqli_num_rows($selectaa);
						if($counter > 0)
						{
                        while($rowaa=mysqli_fetch_array($selectaa))
                        {
                    ?>
                    <li><a href="<?php echo $rowaa['link'];?>"><i class="fa fa-star" style="color:#ec8521;padding-right:7px;"></i> <?php echo $rowaa['notify'];?></a></li>
						<?php } } else { ?>
					<li><a href="#"><i class="fa fa-star" style="color:#ec8521;padding-right:7px;"></i> <?php echo $result1de['title5']; ?></a></li>
					<?php } ?>
                </ul>
				</li> <?php } ?>
				<?php
				if($rowus['rtype']=="Employer")
				{
				?>
				 <li class="no-bg"><a href="post-job" class="p-job"><i class="fa fa-plus-square"></i> <?php echo $result1de['title5']; ?></a></li>
				 <?php } else { } ?>
				<?php
				if($_SESSION['member_user']=="")
				{} else { ?>
				<li class="profile-pic">
					<a href="javascript:void(0)"> <img src="upload/<?php echo $rowus['profile']; ?>" alt="user-img" class="img-circle" width="36"><span class="hidden-xs hidden-sm"><?php echo $rowus['user']; ?> </span><i class="fa fa-angle-down fa-indicator"></i> </a>
					<ul class="drop-down-multilevel left-side">
					<?php
						if($rowus['rtype']=="Employer")
						{
					?>
						<li><a href="company-dashboard"><i class="fa fa-user"></i> <?php echo $result1de['title6']; ?></a></li>
						<?php } else { ?>
						<li><a href="user-dashboard"><i class="fa fa-user"></i> <?php echo $result1de['title6']; ?></a></li>
						<?php } ?>
						<?php
						if($rowus['rtype']=="Employer")
						{
						?>
						<li><a href="create_ad"><i class="fa fa-dot-circle-o"></i> <?php echo $result1de['title7']; ?></a></li>
						<?php } else { } ?>
						<li><a href="account_setting"><i class="fa fa-gear"></i> <?php echo $result1de['title8']; ?></a></li>
						<li><a href="logout"><i class="fa fa-power-off"></i> <?php echo $result1de['title9']; ?></a></li>
					</ul>
				</li>
				<?php } ?>
				<?php
				if($_SESSION['member_user']=="")
				{ ?> <li class="hidden-sm"><a href="register"><i class="fa fa-registered"></i> <?php echo $result1de['title10']; ?> </a></li>
					<li class="hidden-sm"><a href="login"><i class="fa fa-sign-in"></i> <?php echo $result1de['title11']; ?> </a></li> <?php } else { ?>
					
				<?php } ?>
            </ul>
			</div>
        </section>
    </nav>
    <div class="clearfix"></div>
	</div>
	