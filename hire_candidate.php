<?php
	include('header.php');
	$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$session_id'");
$row=mysqli_fetch_array($sel);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='hire_candidate'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar2'");
$result123 = mysqli_fetch_array($sql123);
?>
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
										<li  class="active">
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
                            <div class="follower-section">
                                <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
								<?php
								
							$selhr=mysqli_query($con,"SELECT * FROM `hire` WHERE hire_compid='$session_id' AND hire_status!='0' ORDER BY id DESC ");
							while($rowhr=mysqli_fetch_array($selhr))
							{
								$hire_uid=$rowhr['hire_uid'];
								
								$sel=mysqli_query($con,"SELECT * FROM `user` WHERE id='$hire_uid'");
							    $row=mysqli_fetch_array($sel);
								
								$job_uid=$row['id'];
								$sela=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$job_uid'");
								$rowa=mysqli_fetch_array($sela);
								
								$job_uid=$row['id'];
								$selab=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$job_uid' ORDER BY id DESC");
								$rowab=mysqli_fetch_array($selab);
								
								$city=$row['city'];
								$selabc=mysqli_query($con,"SELECT * FROM `city` WHERE id='$city'");
								$rowabc=mysqli_fetch_array($selabc);
								
								$country=$row['country'];
								$selabcc=mysqli_query($con,"SELECT * FROM `country` WHERE id='$country'");
								$rowabcc=mysqli_fetch_array($selabcc);
							?>
								<div class="job-box">
									<div class="col-md-1 col-sm-1 col-xs-12 nopadding hidden-xs hidden-sm">
										<div class="comp-logo"> <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive" alt="scriptsbundle"> </div>
									</div>
									<div class="col-md-3 col-sm-5 col-xs-12">
										<div class="job-title-box"> <a href="user_resume?id=<?php echo $row['id']; ?>">
											<div class="job-title"> <b><?php echo $row['fname']." ".$row['lname']; ?></b></div>
											</a> <a href="#"><span class="comp-name"><?php echo $rowa['exp_pos']; ?></span></a>
										</div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowabc['citynm']; ?> </div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowabcc['countrynm']; ?> </div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<div class="job-type jt-full-time-color"> <a class="btn btn-primary" target="_blank" href="resume/<?php echo $rowab['resume_nm']; ?>"> <?php echo $result12['title2']; ?> </a></div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<div class="job-location"> <i class="fa fa-calendar"></i> <?php echo $rowhr['hdate']; ?> </div>
									</div>
								</div>
							<?php } ?>
							</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
	include('footer.php');
?>