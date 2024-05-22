<?php include('config.php');
session_start(); 
error_reporting(0);
$session_id=$_SESSION['member_id'];
$sele=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$rowus=mysqli_fetch_array($sele);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='editco'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar2'");
$result123 = mysqli_fetch_array($sql123);
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
<title>Africa Global Network</title>
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
</head>
<body>
<div class="page">
    <div id="spinner">
        <div class="spinner-img"> <img alt="Opportunities Preloader" src="images/loader.gif" />
            <h2>Please Wait.....</h2>
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
				<li class="hidden-sm"><a href="index"><i class="fa fa-suitcase"></i> Jobs </a></li>
				<?php } ?>
                <?php
				if($_SESSION['member_user']=="")
				{ } else { ?> <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i> Notification </a>
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
                    <li><a href="#"><i class="fa fa-star" style="color:#ec8521;padding-right:7px;"></i> <?php echo $rowaa['notify'];?></a></li>
						<?php } } else { ?>
					<li><a href="#"><i class="fa fa-star" style="color:#ec8521;padding-right:7px;"></i> You Have 0 Notification.</a></li>
					<?php } ?>
                </ul>
				</li> <?php } ?>
				<?php
				if($rowus['rtype']=="Employer")
				{
				?>
				 <li class="no-bg"><a href="post-job" class="p-job"><i class="fa fa-plus-square"></i> Post a Job</a></li>
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
						<li><a href="company-dashboard"><i class="fa fa-user"></i> My Profile</a></li>
						<?php } else { ?>
						<li><a href="user-dashboard"><i class="fa fa-user"></i> My Profile</a></li>
						<?php } ?>
						<?php
						if($rowus['rtype']=="Employer")
						{
						?>
						<li><a href="create_ad"><i class="fa fa-dot-circle-o"></i> Create an Add</a></li>
						<?php } else { } ?>
						<li><a href="account_setting"><i class="fa fa-gear"></i> Account Setting</a></li>
						<li><a href="logout"><i class="fa fa-power-off"></i> Logout</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php
				if($_SESSION['member_user']=="")
				{ ?> <li class="hidden-sm"><a href="register"><i class="fa fa-registered"></i> Register </a></li>
					<li class="hidden-sm"><a href="login"><i class="fa fa-sign-in"></i> Login </a></li> <?php } else { ?>
					
				<?php } ?>
            </ul>
			</div>
        </section>
    </nav>
    <div class="clearfix"></div>
	</div>
	

<?php	
$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$session_id'");
$row=mysqli_fetch_array($sel);

$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$rowa=mysqli_fetch_array($sela);

$selab=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowsl=mysqli_fetch_array($selab);

if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$industry=$_POST['industry'];
    $bussiness_type=$_POST['bussiness_type'];
    $comp_established=$_POST['comp_established'];
    $no_emp=$_POST['no_emp'];
    $comp_phone=$_POST['comp_phone'];
    $comp_located=$_POST['comp_located'];
    $comp_address=$_POST['comp_address'];
    $comp_about=$_POST['comp_about'];
    $session_id=$_SESSION['member_id'];
	$social_fb="https://www.facebook.com/".$_POST['social_fb'];
	$social_tw="https://twitter.com/".$_POST['social_tw'];
	$social_li="https://www.linkedin.com/".$_POST['social_li'];
	$social_gp="https://plus.google.com/".$_POST['social_gp'];
	$comp_website=$_POST['comp_website'];
	
	$error = array();
	$accepteble = array
	(
		'image/jpg',
		'image/jpeg',
		'image/png'
	);
	if($_FILES['comp_logo']['name'])
	{
	$img = $_FILES['comp_logo']['name'];
	$tmp = $_FILES['comp_logo']['tmp_name'];
	$size = $_FILES['comp_logo']['size'];
	$type = $_FILES['comp_logo']['type'];
	
	if($size >= 2097152 || ($size == 0))
	{
		$error[] = "Logo Image too large. File must be less than 2 megabytes.$size";
	}
	if(!in_array($type,$accepteble) && (!empty($type)))
	{
		$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
	}
	
	$rnd = mt_rand(1,99999);
	$fnm = "img". $rnd . $img;
	$lfile = str_replace(' ','_',$fnm);
	$r = move_uploaded_file($tmp,'upload/'.$lfile);
	
	}
	else
	{
		$lfile=$row['comp_logo'];
	}
	
	if($_FILES['comp_profile']['name'])
	{
	$imga = $_FILES['comp_profile']['name'];
	$tmpa = $_FILES['comp_profile']['tmp_name'];
	$sizea = $_FILES['comp_profile']['size'];
	$typea = $_FILES['comp_profile']['type'];
	
	if($sizea >= 2097152 || ($sizea == 0))
	{
		$error[] = "Profile Image too large. File must be less than 2 megabytes.";
	}
	if(!in_array($typea,$accepteble) && (!empty($typea)))
	{
		$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
	}
	
	$rnda = mt_rand(1,99999);
	$fnma = "img". $rnda . $imga;
	$lfilea = str_replace(' ','_',$fnma);
	$r = move_uploaded_file($tmp,'upload/'.$lfilea);
	
	}
	else
	{
		$lfilea=$row['comp_profile'];
	}
	
	if(count($error) == 0)
	{
		
		mysqli_query($con,"UPDATE `company` SET `industry`='$industry',`bussiness_type`='$bussiness_type',`comp_established`='$comp_established',`no_emp`='$no_emp',`comp_logo`='$lfile',`comp_profile`='$lfilea',`comp_phone`='$comp_phone',`comp_located`='$comp_located',`comp_address`='$comp_address',`comp_about`='$comp_about',`comp_email`='$email',`comp_website`='$comp_website' WHERE comp_uid='$session_id'");
		
		mysqli_query($con,"UPDATE `user` SET `fname`='$fname',`lname`='$lname',`phone`='$phone' WHERE id='$session_id'");
		
	    mysqli_query($con,"UPDATE `social` SET `social_fb`='$social_fb',`social_tw`='$social_tw',`social_li`='$social_li',`social_gp`='$social_gp' WHERE social_uid='$session_id'");
		
		$notify="Update His Company/Profile Details";
		$type="user";
		$link="infoc?id=$session_id";
		$jct=date('Y-m-d H:i:s');
		
		$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
		?>
		<script>
			alert('Successfully Updated');
		</script>
		<?php
		echo "<script type='text/javascript'>";
		echo "window.location='company-dashboard'";
		echo "</script>";
	}
	else
	{
		foreach($error as $err)
		{
			echo '<script>alert("'.$err.'");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'edit-profile-company'";
			echo"</script>";
		}
		die();
	}
	 
}

?>
<style>
.user-avatar img {
    border: 10px solid;
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    width: 125px;
}
</style>
       <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="panel">
                                <div class="dashboard-logo-sidebar">
                                    <img class="img-responsive center-block" src="upload/<?php echo $row['comp_logo']; ?>" alt="Image">
                                </div>
                                <div class="text-center dashboard-logo-sidebar-title">
                                    <h4><?php echo $row['industry']; ?></h4>
                                </div>
                            </div>
                            <div class="profile-nav">
                                <div class="panel">
                                   <ul class="nav nav-pills nav-stacked">
                                        <li>
                                            <a href="company-dashboard"> <i class="fa fa-user"></i> <?php echo $result123['title1']; ?></a>
                                        </li>
                                        <li  class="active">
                                            <a href="edit-profile-company"> <i class="fa fa-edit"></i> <?php echo $result123['title2']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title3']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-active-jobs"> <i class="fa  fa-list-alt"></i> <?php echo $result123['title4']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-followers"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title5']; ?> </a>
                                        </li>
										<li>
                                            <a href="hire_candidate"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title6']; ?> </a>
                                        </li>
										<li>
                                            <a href="interest_in_candidate"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title7']; ?> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title1']; ?></p>
                            </div>

                            <div class="profile-edit row">
                                <form method="POST" enctype="multipart/form-data">
									<div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title2']; ?>: <span class="required">*</span></label>
                                            <input type="text" name="fname" placeholder="Employer First Name" class="form-control" value="<?php echo $rowa['fname']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title3']; ?>: <span class="required">*</span></label>
                                            <input type="text" name="lname" placeholder="Employer Last Name" value="<?php echo $rowa['lname']; ?>" class="form-control" required>
                                        </div>
                                    </div>
									<div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title4']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $rowa['user']; ?>" name="user"  placeholder="Employer User Name " class="form-control" required readonly>
                                        </div>
                                    </div>
									<div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title5']; ?>: <span class="required">*</span></label>
                                            <input type="text" name="email" placeholder="Email ID" class="form-control" value="<?php echo $rowa['email']; ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title6']; ?>: <span class="required">*</span></label>
                                            <input type="text" name="phone" placeholder="Employer Phone No" value="<?php echo $rowa['phone']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title7']; ?>: <span class="required">*</span></label>
                                            <input type="text" name="industry" placeholder="Company Name" class="form-control" value="<?php echo $row['industry']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title8']; ?> <span class="required">*</span></label>
                                            <input type="text" name="bussiness_type" placeholder="Type of Business Entity " value="<?php echo $row['bussiness_type']; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title9']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $row['comp_established']; ?>" name="comp_established" placeholder="Established In" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title10']; ?><span class="required">*</span></label>
                                            <input type="text" value="<?php echo $row['no_emp']; ?>" name="no_emp" placeholder="No. of Employees" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title11']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $row['comp_phone']; ?>" name="comp_phone" placeholder="Phone" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title12']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $row['comp_located']; ?>" name="comp_located" placeholder="Located" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title13']; ?> <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $row['comp_address']; ?>" name="comp_address"  placeholder="Located" class="form-control" required>
                                        </div>
                                    </div>
									<div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title14']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $rowsl['social_fb']; ?>" name="social_fb" placeholder="Ex. asquare41" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title15']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $rowsl['social_li']; ?>" name="social_li" placeholder="Ex. asquare41" class="form-control" required>
                                        </div>
                                    </div>
									<div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title16']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $rowsl['social_gp']; ?>" name="social_gp" placeholder="Ex. asquare41" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title17']; ?>: <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $rowsl['social_tw']; ?>" name="social_tw" placeholder="Ex. AFRICAGLOBALN" class="form-control" required>
                                        </div>
                                    </div>
									<div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title18']; ?> : <span class="required">*</span></label>
                                            <input type="text" value="<?php echo $row['comp_website']; ?>" name="comp_website"  placeholder="Company Website " class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title19']; ?> <span class="required">*</span></label>
                                            <textarea cols="6" rows="8" name="comp_about" placeholder="About Company" class="form-control" required><?php echo $row['comp_about']; ?></textarea>
                                        </div>
                                    </div>
									<div class="col-md-6 col-sm-12">
                                        <div class="input-group image-preview form-group">
											<div class="user-avatar " style="width:100%;float:left">
												<img src="upload/<?php echo $row['comp_logo']; ?>" id="blah" alt="" class="img-responsive center-block ">
											</div>
											<div style="width:100%;float:left;margin-top: 20px;text-align: center;">
											<label><?php echo $result12['title20']; ?>: <span class="required">*</span></label>
											<input type="text" placeholder="Upload Cover Image" class="form-control image-preview-filename" disabled="disabled" style="display: none;">
											<span class="input-group-btn" style="padding-top: 0px;">
												<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
													<span class="glyphicon glyphicon-remove"></span> Clear
												</button>
												<div class="btn btn-default image-preview-input">
													<span class="glyphicon glyphicon-folder-open"></span>
													<span class="image-preview-input-title">Browse</span>
													<input type="file" onchange="readURL(this);" name="comp_logo" accept="file_extension" name="input-file-preview" />
												</div>
											</span>
											</div>
										</div>
										</div>
										<div class="col-md-6 col-sm-12">
                                        <div class="input-group image-preview form-group">
											<div class="user-avatar " style="width:100%;float:left">
												<img src="upload/<?php echo $row['comp_profile']; ?>" id="blaha" alt="" class="img-responsive center-block ">
											</div>
											<div style="width:100%;float:left;margin-top: 20px;text-align: center;">
											<label><?php echo $result12['title21']; ?>: <span class="required">*</span></label>
											<input type="text" placeholder="Upload Cover Image" class="form-control image-preview-filename" disabled="disabled" style="display: none;">
											<span class="input-group-btn" style="padding-top: 0px;">
												<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
													<span class="glyphicon glyphicon-remove"></span> Clear
												</button>
												<div class="btn btn-default image-preview-input">
													<span class="glyphicon glyphicon-folder-open"></span>
													<span class="image-preview-input-title">Browse</span>
													<input type="file" onchange="readURLA(this);" name="comp_profile" accept="file_extension" name="input-file-preview" />
												</div>
											</span>
											</div>
										</div>
										</div>
                                    <div class="col-md-12 col-sm-12">
                                         <button class="btn btn-default pull-right" name="submit" type="submit"> <?php echo $result12['title22']; ?> <i class="fa fa-angle-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script>
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	
	function readURLA(inputa) {
        if (inputa.files && inputa.files[0]) {
            var readera = new FileReader();

            readera.onload = function (e) {
                $('#blaha')
                    .attr('src', e.target.result);
            };

            readera.readAsDataURL(inputa.files[0]);
        }
    }


   </script>
<?php
	include('footer.php');
?>