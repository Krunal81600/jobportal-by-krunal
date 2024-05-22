<?php session_start();
include('../config.php');
error_reporting(0);
if($_SESSION["email"]=="")
{
	echo "<script type='text/javascript'>";
	echo "window.location='logout.php'";
	echo "</script>";
}
if($_REQUEST['noti'])
{
	$notiid=$_GET['notiid'];
	mysqli_query($con,"UPDATE `notification` SET `noti_status`='1' WHERE id='$notiid'");
}
?>
<?php 
$id=$_SESSION['id'];
$select=mysqli_query($con,"SELECT * FROM `admin_user` where id='$id'");
$rowad=mysqli_fetch_array($select);

$id=$_SESSION['id'];
$selectac=mysqli_query($con,"SELECT * FROM `access` where subadmin_id='$id'");
$access=mysqli_fetch_array($selectac);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <title>Africa Global Network</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <!-- BEGIN PAGE STYLE -->
    <link href="assets/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="assets/plugins/maps-amcharts/ammap/ammap.min.css" rel="stylesheet">
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
	<link href="assets/plugins/summernote/summernote.min.css" rel="stylesheet">
    <!-- END PAGE STYLE -->
    <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <!-- LAYOUT: Apply "submenu-hover" class to body element to have sidebar submenu show on mouse hover -->
  <!-- LAYOUT: Apply "sidebar-collapsed" class to body element to have collapsed sidebar -->
  <!-- LAYOUT: Apply "sidebar-top" class to body element to have sidebar on top of the page -->
  <!-- LAYOUT: Apply "sidebar-hover" class to body element to show sidebar only when your mouse is on left / right corner -->
  <!-- LAYOUT: Apply "submenu-hover" class to body element to show sidebar submenu on mouse hover -->
  <!-- LAYOUT: Apply "fixed-sidebar" class to body to have fixed sidebar -->
  <!-- LAYOUT: Apply "fixed-topbar" class to body to have fixed topbar -->
  <!-- LAYOUT: Apply "rtl" class to body to put the sidebar on the right side -->
  <!-- LAYOUT: Apply "boxed" class to body to have your page with 1200px max width -->

  <!-- THEME STYLE: Apply "theme-sdtl" for Sidebar Dark / Topbar Light -->
  <!-- THEME STYLE: Apply  "theme sdtd" for Sidebar Dark / Topbar Dark -->
  <!-- THEME STYLE: Apply "theme sltd" for Sidebar Light / Topbar Dark -->
  <!-- THEME STYLE: Apply "theme sltl" for Sidebar Light / Topbar Light -->
  
  <!-- THEME COLOR: Apply "color-default" for dark color: #2B2E33 -->
  <!-- THEME COLOR: Apply "color-primary" for primary color: #319DB5 -->
  <!-- THEME COLOR: Apply "color-red" for red color: #C9625F -->
  <!-- THEME COLOR: Apply "color-green" for green color: #18A689 -->
  <!-- THEME COLOR: Apply "color-orange" for orange color: #B66D39 -->
  <!-- THEME COLOR: Apply "color-purple" for purple color: #6E62B5 -->
  <!-- THEME COLOR: Apply "color-blue" for blue color: #4A89DC -->
  <!-- BEGIN BODY -->
  <body class="fixed-topbar color-blue theme-sdtl bg-clean">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div class="logopanel">
          <h1>
            <a href="dashboard.html"></a>
          </h1>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
            <div class="userlogged clearfix">
              <i class="icon icons-faces-users-01"></i>
              <div class="user-details">
                <h4><?php echo $rowad['user']; ?></h4>
                <div class="dropdown user-login">
                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                  <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="menu-title">
            Navigation 
          </div>
          <ul class="nav nav-sidebar">
		  
            <li class=" nav-active active"><a href="index"><i class="icon-home"></i><span data-translate="dashboard">Dashboard</span></a></li>
			<li><a href="http://africaglobalnetwork.com/" target="_blank"><i class="fa fa-globe"></i><span data-translate="Open Site">Open Site</span></a></li>
			<li><a href="http://africaglobalnetwork.com/livechat/php/app.php?login" target="_blank"><i class="fa fa-globe"></i><span data-translate="Open Chat App">Open Chat App</span></a></li>
			
			<?php
			  if($access['can_list']==0 || $access['can_list']==0 || $access['comp_list']==0 || $access['bcomp_list']==0 || $access['ucomp_list']==0 || $access['pcan_list']==0 || $access['upcan_list']==0 || $access['app_can_list']==0 || $access['foll_can_list']==0)
			  {
			  ?>
			<li class="nav-parent">
              <a href="#"><i class="fa fa-user-plus"></i><span data-translate="Admin User">All List</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
			  <?php
			  if($access['can_list']==0)
			  {
			  ?>
                <li><a href="user"> Candidate List</a></li>
			  <?php } else {} ?>
			  <?php
			  if($access['bcan_list']==0)
			  {
			  ?>
                <li><a href="buser"> Block Candidate List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['comp_list']==0)
			  {
			  ?>
                <li><a href="company"> Company List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['bcomp_list']==0)
			  {
			  ?>
                <li><a href="bcompany"> Block Company List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['ucomp_list']==0)
			  {
			  ?>
                <li><a href="uncompany"> Unapprove Company List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['pcan_list']==0)
			  {
			  ?>
                <li><a href="puser"> Paid Candidate List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['upcan_list']==0)
			  {
			  ?>
                <li><a href="upuser"> Unpaid Candidate List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['app_can_list']==0)
			  {
			  ?>
                <li><a href="job_apply"> Applied By Candidate List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['foll_can_list']==0)
			  {
			  ?>
                <li><a href="job_follow"> Follow By Candidate List</a></li>
				<?php } else {} ?>
              </ul>
            </li>
			  <?php } else {} ?>
			  <?php
			  if($access['add_post']==0 || $access['app_post']==0 || $access['unapp_post']==0 )
			  {
			  ?>
			<li class="nav-parent">
              <a href="#"><i class="fa fa-tasks"></i><span data-translate="Post Job List">Post Job List</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
			  <?php
			  if($access['add_post']==0)
			  {
			  ?>
                <li><a href="add_post"> Add Post</a></li>
				<?php } else {} ?>
				<?php
			  if($access['app_post']==0)
			  {
			  ?>
                <li><a href="apppost"> Approved Post Job List</a></li>
				<?php } else {} ?>
				<?php
			  if($access['unapp_post']==0)
			  {
			  ?>
                <li><a href="unapppost"> Unapproved Post Job List</a></li>
				<?php } else {} ?>
              </ul>
            </li>
			<?php } else {} ?>
			<?php
			  if($access['location']==0)
			  {
			  ?>
            <li><a href="location"><i class="icon-map"></i><span data-translate="Location">Location</span></a></li>
			<?php } else {} ?>
				<?php
			  if($access['payment']==0)
			  {
			  ?>
            <li><a href="payment"><i class="fa fa-money"></i><span data-translate="Payment List">Payment List</span></a></li>
			<?php } else {} ?>
			<?php
			  if($access['make_resume']==0)
			  {
			  ?>
            <li><a href="make_resume"><i class="fa fa-money"></i><span data-translate="Request for Make Resume">Request for Make Resume</span></a></li>
			<?php } else {} ?>
				<?php
			  if($access['ad']==0)
			  {
			  ?>
            <li><a href="ad"><i class="fa fa-plus-circle"></i><span data-translate="Request for Ad">Request for Ad</span></a></li>
			<?php } else {} ?>
			<?php
		  if($access['category']==0)
		  {
		  ?>
            <li class="nav-parent">
              <a href="#"><i class="fa fa-tasks"></i><span data-translate="Category">Category</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="category"> Category List</a></li>
                 <!--<li><a href="subcategory"> Add Sub Category</a></li>-->
              </ul>
            </li>
			<?php } else {} ?>
			<?php
			  if($access['in_in_can']==0 || $access['in_in_comp']==0)
			  {
			  ?>
			<li class="nav-parent">
              <a href="#"><i class="fa fa-tasks"></i><span data-translate="Interested In List">Interested In List</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
			  <?php
		  if($access['in_in_can']==0)
		  {
		  ?>
                <li><a href="interest_post"> Interested In Candidate</a></li>
			<?php } else {} ?>
			<?php
		  if($access['in_in_comp']==0)
		  {
		  ?>
                <li><a href="interest_resume"> Interested In Company</a></li>
				<?php } else {} ?>
              </ul>
            </li>
			<?php } else {} ?>
			<?php
		  if($access['hire']==0)
		  {
		  ?>
			<li><a href="hire"><i class="fa fa-tasks"></i><span data-translate="Hire">Hired By Company List</span></a></li>
			<?php } else {} ?>
			<!--<li><a href="chat"><i class="fa fa-comments"></i><span data-translate="Chat">Chat for employee</span></a></li>
			<li><a href="chat_cc"><i class="fa fa-comments"></i><span data-translate="Chat">Chat for candidate & company</span></a></li>-->
			<?php
			if($rowad['admin_type']=="subadmin")
			{
				
			}
			else
			{
			?>
			<li class="nav-parent">
              <a href="#"><i class="fa fa-user-plus"></i><span data-translate="Subadmin">Subadmin</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="subadmin"> Add Subadmin</a></li>
                <li><a href="subadmin_list"> List Of Subadmin</a></li>
              </ul>
            </li>
			<li class="nav-parent">
              <a href="#"><i class="fa fa-newspaper-o"></i><span data-translate="Blog">Blog</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="add_blog"> Add Blog</a></li>
                <li><a href="list_blog"> List Of Blog</a></li>
              </ul>
            </li>
			<?php } ?>
			<li class="nav-parent">
              <a href="#"><i class="fa fa-cogs"></i><span data-translate="Front End Setting">Front End Setting</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="logo"> Change Logo</a></li>
                <li><a href="home_content"> Home Content</a></li>
                <li><a href="aboutus">About Us</a></li>
                <li><a href="brand">Brand List</a></li>
                <li><a href="team">Team List</a></li>
                <li><a href="create_resume">Create Resume Page</a></li>
                <li><a href="testimonial">Teastimonial List</a></li>
                <li><a href="terms_condition">Terms & Condition</a></li>
                <li><a href="privacy">Privacy</a></li>
                <li><a href="footer1">Footer One</a></li>
                <li><a href="footer2">Footer two</a></li>
                <li><a href="footer4">Footer three</a></li>
				<li><a href="user_sidebar"> User Dashboard Sidebar</a></li>
                <li><a href="account_setting"> Account Setting</a></li>
                <li><a href="ad_title"> Create Ad</a></li>
                <li><a href="all_category"> All Category</a></li>
                <li><a href="blog_view"> BLog View</a></li>
                <li><a href="build-resume"> build-resume</a></li>
                <li><a href="by_country"> by_country Search</a></li>
                <li><a href="sidebar2"> Company Dashboard Sidebar</a></li>
                <li><a href="active-jobs"> Company Active-jobs</a></li>
                <li><a href="followers"> Company followers</a></li>
                <li><a href="coresume"> Company Resume</a></li>
                <li><a href="codashboard"> Company Dashboard</a></li>
                <li><a href="company_details"> Company Details</a></li>
                <li><a href="contactus"> Contact Us</a></li>
                <li><a href="create_ad"> create_ad</a></li>
                <li><a href="editco"> Edit Company Details</a></li>
                <li><a href="hire_candidate"> Hire Candidate</a></li>
                <li><a href="hire_company"> Hire Company</a></li>
                <li><a href="interest_in_company"> Interest In Company</a></li>
                <li><a href="interest_in_candidate"> Interest In Candidate</a></li>
                <li><a href="job-category"> Job Category List</a></li>
                <li><a href="job_details"> Job Details</a></li>
                <li><a href="job_listing"> Job Listing</a></li>
                <li><a href="login_title"> login</a></li>
                <li><a href="paid_resume"> Paid Resume</a></li>
                <li><a href="register"> Register</a></li>
                <li><a href="post-job"> Post Job</a></li>
                <li><a href="search"> Search Job</a></li>
                <li><a href="search_result"> Search User</a></li>
                <li><a href="usdashboard"> User Dashboard</a></li>
                <li><a href="useredit"> User Edit Profile</a></li>
                <li><a href="usfollowed"> User Follower</a></li>
                <li><a href="usapplied"> User Applied Job</a></li>
                <li><a href="user-resume"> User save Resume</a></li>
                <li><a href="user_listing"> User Listing</a></li>
                <li><a href="user_resume"> User Details</a></li>
                <li><a href="header1"> Header1</a></li>
                <li><a href="header2"> Header2</a></li>
                <li><a href="footer_title"> Footer1</a></li>
              </ul>
            </li>
          </ul>
          <!-- SIDEBAR WIDGET FOLDERS -->
          <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
            <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left" href="#" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
            <i class="icon-lock"></i></a>
            <a class="pull-left btn-effect" href="logout" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <!-- END SIDEBAR -->
	  
	  <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
             
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <!-- BEGIN NOTIFICATION DROPDOWN -->
              <li class="dropdown" id="notifications-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-bell"></i>
                <span class="badge badge-danger badge-header"><?php 	
						   $qry_row=mysqli_query($con,"SELECT * FROM `notification` WHERE noti_status='0' AND type='user'"); echo mysqli_num_rows($qry_row)
						?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header clearfix">
                    <p class="pull-left"><?php 	
						   $qry_row=mysqli_query($con,"SELECT * FROM `notification` WHERE noti_status='0' AND type='user'"); echo mysqli_num_rows($qry_row)
						?> Pending Notifications</p>
                  </li>
                  <li>
                    <ul class="dropdown-menu-list withScroll" data-height="220">
					 <?php
						$selectaa=mysqli_query($con,"SELECT * FROM `notification` where  noti_status='0' AND type='user' ORDER BY  `id` DESC");
						while($rowaa=mysqli_fetch_array($selectaa))
						{
							$user_id=$rowaa['user_id'];
							$selectaaa=mysqli_query($con,"SELECT * FROM `user` where id='$user_id'");
						  $rowaaa=mysqli_fetch_array($selectaaa);
						
						?>
                      <li>
                        <a href="<?php echo $rowaa['link']; ?>?&noti=noti&notiid=<?php echo $rowaa['id']; ?>">
                        <i class="fa fa-star p-r-10 f-18 c-orange"></i>
                      <?php echo $rowaaa['user'];?>  <?php echo $rowaa['notify'];?>
                        <span class="dropdown-time"><?php echo $rowaa['noti_time'];?></span>
                        </a>
                      </li>
                      <?php } ?>
                    </ul>
                  </li>
                  <li class="dropdown-footer clearfix">
                    <a href="notification" class="pull-left">See all notifications</a>
                    <a href="#" class="pull-right">
                    <i class="icon-settings"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- END NOTIFICATION DROPDOWN -->
              <!-- BEGIN MESSAGES DROPDOWN -->
             <?php /* <li class="dropdown" id="messages-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-paper-plane"></i>
                <span class="badge badge-primary badge-header">
                <?php 	$id=$_SESSION['id'];
						   $qry_row=mysqli_query($con,"SELECT * FROM `chatf` WHERE user_to='$id' AND chat_show='0' AND type_us='user'"); echo mysqli_num_rows($qry_row)
						?>
                </span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header clearfix">
                    <p class="pull-left">
                      You have <?php 	
							$id=$_SESSION['id'];
						   $qry_row=mysqli_query($con,"SELECT * FROM `chatf` WHERE user_to='$id' AND chat_show='0' AND type_us='user'"); echo mysqli_num_rows($qry_row)
						?> Messages
                    </p>
                  </li>
                  <li class="dropdown-body">
                    <ul class="dropdown-menu-list withScroll" data-height="220">
					<?php
						$id=$_SESSION['id'];
						$select=mysqli_query($con,"SELECT * FROM `chatf` WHERE user_to='$id' AND chat_show='0' AND type_us='user' ORDER BY  `id` DESC");
						while($rowa=mysqli_fetch_array($select))
						{
							$user_by=$rowa['user_by'];
							$selecta=mysqli_query($con,"SELECT * FROM `user` where id='$user_by'");
							$row=mysqli_fetch_array($selecta);
						
						?>
						<a href="chat_cc?id=<?php echo $row['id']?>&chatid=<?php echo $rowa['id']?>&clear=clear">
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="../upload/<?php echo $row['profile']?>" alt="user">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong><?php echo $row['user']?></strong> 
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span><?php echo $rowa['time']; ?>
                            </small>
                          </div>
                          <p><?php echo $rowa['message']; ?></p>
                        </div>
                      </li>
					  </a>
                      <?php } ?>
                    </ul>
                  </li>
                  <li class="dropdown-footer clearfix">
                    <a href="chat_cc" class="pull-left">See all messages</a>
                    <a href="#" class="pull-right">
                    <i class="icon-settings"></i>
                    </a>
                  </li>
                </ul>
              </li> */?>
              <!-- END MESSAGES DROPDOWN -->
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="images/<?php echo $rowad['img']; ?>" alt="user image">
                <span class="username">Hi, <?php echo $rowad['user']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="profile"><i class="icon-user"></i><span>My Profile</span></a>
                  </li>
                  <li>
                    <a href="logout"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
            </ul>
          </div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->