<?php include('header.php');

$uid=$_GET['id'];
$sela=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$uid'");
$rowa=mysqli_fetch_array($sela);

$selac=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$uid'");
$rowac=mysqli_fetch_array($selac);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='company_details'");
$result12 = mysqli_fetch_array($sql12);
 ?>

        <section class="light-grey resume2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <div class="profile-photo"><img src="upload/<?php echo $rowa['comp_logo']; ?>" alt="" class="img-responsive"></div>
                            <div class="resume-social">
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="<?php echo $rowac['social_fb']; ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $rowac['social_tw']; ?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="<?php echo $rowac['social_gp']; ?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="<?php echo $rowac['social_li']; ?>" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <div class="profile-info">
                                <h1 class="profile-title"><?php echo $rowa['industry']; ?></h1>
                                <h2 class="profile-position"><?php echo $rowa['bussiness_type']; ?></h2></div>
                            <ul class="profile-list">
                                <li class="">
                                    <strong class="title"><?php echo $result12['title1']; ?>:</strong>
                                    <span class="cont"><?php echo $rowa['comp_established']; ?></span>
                                </li>

                                <li class="">
                                    <strong class="title"><?php echo $result12['title2']; ?>:</strong>
                                    <span class="cont"><a href="mailto:resume@user.com"><?php echo $rowa['comp_email']; ?></a></span>
                                </li>
                                <li class="">
                                    <strong class="title"><?php echo $result12['title3']; ?>:</strong>
                                    <span class="cont"><a href="tel:+9911154849901"><?php echo $rowa['comp_phone']; ?></a></span>
                                </li>
                                <li class="">
                                    <strong class="title"><?php echo $result12['title4']; ?>:</strong>
                                    <span class="cont"><?php echo $rowa['comp_address']; ?>  </span>
                                </li>
                                <li class="">
                                    <strong class="title"><?php echo $result12['title5']; ?> :</strong>
                                    <span class="cont"><?php echo $rowa['comp_located']; ?></span>
                                </li>
                                <li class="">
                                    <strong class="title"><?php echo $result12['title6']; ?>:</strong>
                                    <span class="cont"><?php echo $rowa['comp_website']; ?> </span>
                                </li>
                            </ul>
                            <h4><strong> <?php echo $result12['title7']; ?>:</strong></h4>
                            <p>
                                <?php echo $rowa['comp_about']; ?>
                            </p>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="resume-box">
                                <div class="heading-inner">
                                    <p class="title light-grey"><?php echo $result12['title8']; ?> </p>
                                </div>
                                <div class="row education-box">
                                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                        <?php
										$today=date('Y-m-d');
										$uid=$_GET['id'];
									$sel=mysqli_query($con,"SELECT * FROM `post_job` WHERE ad_app='1' AND job_uid='$uid' AND `job_edate` >  '$today' ORDER BY id ASC LIMIT 6");
									while($row=mysqli_fetch_array($sel))
									{
										$job_uid=$row['job_uid'];
										$sela=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_uid' ORDER BY industry ASC");
									    $rowa=mysqli_fetch_array($sela);
										
										$countryid=$row['country'];
										$selacou=mysqli_query($con,"SELECT * FROM `country` WHERE id='$countryid'");
									    $rowacou=mysqli_fetch_array($selacou);
										
										$cityipa=$row['job_location'];
										$selacity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cityipa'");
									    $rowacity=mysqli_fetch_array($selacity);
										
									?>
                                        <div class="job-box">
                                            <div class="col-md-1 col-sm-1 col-xs-12 nopadding hidden-xs hidden-sm">
                                                <div class="comp-logo"> <img src="upload/<?php echo $rowa['comp_logo']; ?>" class="img-responsive" alt="Company Logo"> </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="job-title-box"> <a href="job_details?id=<?php echo $row['id']; ?>">
                                                    <div class="job-title"> <?php echo $row['job_title']; ?></div>
                                                    </a> <a href="#"><span class="comp-name"><?php echo $rowa['industry']; ?></span></a> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacity['citynm']; ?> </div>
                                            </div>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacou['countrynm']; ?> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-type jt-full-time-color"> <i class="fa fa-clock-o"></i> <?php echo $row['job_type']; ?> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
												if($_SESSION['member_user']=="")
												{ ?>
												<button class="btn btn-primary btn-custom" onclick="window.location.href='register'"><?php echo $result12['title9']; ?></button>
												<?php } else { ?>
                                                <button class="btn btn-primary btn-custom" onclick="window.location.href='job_details?id=<?php echo $row['id']; ?>'"><?php echo $result12['title9']; ?></button>
												<?php } ?>
                                            </div>
                                        </div>
									<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
<?php include('footer.php'); ?>