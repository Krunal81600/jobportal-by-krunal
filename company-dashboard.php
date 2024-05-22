<?php
	include('header.php');	
$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$session_id'");
$row=mysqli_fetch_array($sel);

$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$rowa=mysqli_fetch_array($sela);

$selab=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowsl=mysqli_fetch_array($selab);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar2'");
$result123 = mysqli_fetch_array($sql123);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='codashboard'");
$result12 = mysqli_fetch_array($sql12);
?>
        <section class="company-dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="dashboard-header">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="dashboard-header-logo-box">
                                    <div class="company-logo">
                                        <img src="upload/<?php echo $row['comp_logo']; ?>" alt="" class="img-responsive center-block "></a>
                                    </div>
                                    <h3><?php echo $row['industry']; ?></h3>
                                    <p><?php echo $row['comp_address']; ?></p>
                                    <ul class="social-links list-inline">
                                        <li> <a href="<?php echo $rowsl['social_fb']; ?>"><i class="icon-facebook"></i></a></li>
                                        <li> <a href="<?php echo $rowsl['social_tw']; ?>"><i class="icon-twitter"></i></a></li>
                                        <li> <a href="<?php echo $rowsl['social_gp']; ?>"><i class="icon-googleplus"></i></a></li>
                                        <li> <a href="<?php echo $rowsl['social_li']; ?>"><i class="icon-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="rad-info-box">
                                    <i class="icon icon-profile-male"></i>
                                    <span class="title-dashboard"><?php echo $result12['title1']; ?></span>
                                    <span class="value"><span><?php 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `follow` WHERE comp_id='$uid'");
									echo $countfl=mysqli_num_rows($cnt); ?></span></span>
                                </div>
                                <div class="rad-info-box">
                                    <i class="icon icon-presentation"></i>
                                    <span class="title-dashboard"><?php echo $result12['title2']; ?></span>
                                    <span class="value"><span><?php 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `post_job` WHERE job_uid='$uid'");
									echo $countfl=mysqli_num_rows($cnt); ?></span></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="rad-info-box">
                                    <i class="icon icon-documents"></i>
                                    <span class="title-dashboard"><?php echo $result12['title3']; ?></span>
                                    <span class="value"><span><?php 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `job_app` WHERE job_app_compid='$uid'");
									echo $countfl=mysqli_num_rows($cnt); ?></span></span>
                                </div>
                                <div class="rad-info-box rad-txt-success">
                                    <i class="icon icon-briefcase"></i>
                                    <span class="title-dashboard"><?php echo $result12['title4']; ?></span>
                                    <span class="value"><span><?php 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `hire` WHERE hire_compid='$uid'");
									echo $countfl=mysqli_num_rows($cnt); ?></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
		        <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="profile-nav">
                                <div class="panel">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li  class="active">
                                            <a href="company-dashboard"> <i class="fa fa-user"></i> <?php echo $result123['title1']; ?></a>
                                        </li>
                                        <li>
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
                            <div class="job-short-detail">
                                <div class="heading-inner">
                                    <p class="title"><?php echo $result12['title5']; ?></p>
                                </div>
                                <dl>
									<dt><?php echo $result12['title6']; ?>:</dt>
                                    <dd> <?php echo $rowa['user']; ?></dd>
									
									<dt><?php echo $result12['title7']; ?>:</dt>
                                    <dd> <?php echo $rowa['fname']; ?></dd>
									
									<dt><?php echo $result12['title8']; ?>:</dt>
                                    <dd> <?php echo $rowa['lname']; ?></dd>
									
                                    <dt><?php echo $result12['title9']; ?>:</dt>
                                    <dd> <?php echo $row['industry']; ?></dd>

                                    <dt><?php echo $result12['title10']; ?>:</dt>
                                    <dd> <?php echo $row['bussiness_type']; ?> </dd>

                                    <dt><?php echo $result12['title11']; ?>:</dt>
                                    <dd> <?php echo $row['comp_established']; ?></dd>

                                    <dt><?php echo $result12['title12']; ?>:</dt>
                                    <dd><?php echo $rowa['phone']; ?> </dd>
									
									<dt><?php echo $result12['title13']; ?>:</dt>
                                    <dd><?php echo $row['comp_phone']; ?> </dd>

                                    <dt><?php echo $result12['title14']; ?>:</dt>
                                    <dd><?php echo $row['comp_email']; ?> </dd>

                                    <dt><?php echo $result12['title15']; ?>:</dt>
                                    <dd><?php echo $row['no_emp']; ?></dd>

                                    <dt><?php echo $result12['title16']; ?>:</dt>
                                    <dd><?php echo $row['comp_address']; ?> </dd>

                                    <dt><?php echo $result12['title17']; ?>:</dt>
                                    <dd><?php $city=$rowa['city'];
									$selcity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$city'");
									$rowcity=mysqli_fetch_array($selcity);
									echo $rowcity['citynm'];
									?></dd>

                                    <dt><?php echo $result12['title18']; ?>:</dt>
                                    <dd><?php echo $row['comp_located']; ?> </dd>

                                    <dt><?php echo $result12['title19']; ?>:</dt>
                                    <dd><?php $country=$rowa['country'];
									$selcountry=mysqli_query($con,"SELECT * FROM `country` WHERE id='$country'");
									$rowcountry=mysqli_fetch_array($selcountry);
									echo $rowcountry['countrynm'];
									?></dd>
                                </dl>
                            </div>
                            <div class="heading-inner">
                                <p class="title"><?php echo $result12['title20']; ?></p>
                            </div>
                            <p><?php echo $row['comp_about']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<div class="brand-logo-area clients-bg">
		<div class="clients-list">
			<?php
			$r2 = mysqli_query($con,"SELECT * FROM `brand`");
			while($row2 = mysqli_fetch_array($r2))
			{
			?>
			<div class="client-logo"> <a href="<?php echo $row2['brand_link']; ?>"><img src="images/clients/<?php echo $row2['brand_img']; ?>" class="img-responsive" alt="Brand Image" /></a> </div>
			<?php } ?>
		</div>
	</div>
<?php
	include('footer.php');
?>