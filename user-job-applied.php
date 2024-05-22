<?php
	include('header.php');
	$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$row=mysqli_fetch_array($sel);

$exp_pos=$row['id'];
$selex=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$exp_pos'");
$rowex=mysqli_fetch_array($selex);

$seld=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowd=mysqli_fetch_array($seld);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='usapplied'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);
?>
        <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="profile-card">
                                <div class="banner">
                                    <img src="upload/<?php echo $row['cover']; ?>" alt="" class="img-responsive">
                                </div>
                                <div class="user-image">
                                    <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive img-circle" alt="">
                                </div>
                                <div class="card-body">
                                    <h3><?php echo $row['user']; ?></h3>
                                    <span class="title"><?php echo $rowex['exp_pos']; ?></span>
                                </div>
                                <ul class="social-network social-circle onwhite">
                                   <li><a href="<?php echo $rowd['social_fb']; ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="<?php echo $rowd['social_tw']; ?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a href="<?php echo $rowd['social_li']; ?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="<?php echo $rowd['social_gp']; ?>" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="profile-nav">
                                <div class="panel">
                                    <ul class="nav nav-pills nav-stacked">
										<li>
											<a href="user-dashboard"> <i class="fa fa-user"></i> <?php echo $result123['title1']; ?></a>
										</li>
										<li>
											<a href="user-edit-profile"> <i class="fa fa-edit"></i> <?php echo $result123['title2']; ?></a>
										</li>
										<li>
											<a href="build-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title3']; ?></a>
										</li>
										<li>
											<a href="user-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title4']; ?> </a>
										</li>
										<li  class="active">
											<a href="user-job-applied"> <i class="fa  fa-list-ul"></i> <?php echo $result123['title5']; ?></a>
										</li>
										<li>
											<a href="user-followed-companies"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title6']; ?> </a>
										</li>
										<li>
											<a href="paid_resume"> <i class="fa fa-money"></i> <?php echo $result123['title7']; ?></a>
										</li>
										<li>
											<a href="interest_in_company"> <i class="fa fa-file-o"></i> <?php echo $result123['title8']; ?></a>
										</li>
										<li>
											<a href="hire_company"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title9']; ?> </a>
										</li>
									</ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title1']; ?></p>
                            </div>
                            <div class="all-jobs-list-box2">
							<?php
							if(isset($_REQUEST['start']))
							{
							$startno=$_REQUEST['start'];
							}
							else
							{
							$startno=0;
							}
							$pagesize=7;
							$i=0;
							$pageno=1;
							
							
							$sid=$_SESSION['member_id'];
							
							$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `job_app` WHERE job_app_uid='$sid' AND success_send!='0'");
							$total_rows=mysqli_num_rows($SqlQueryRun1);
							
							$sel=mysqli_query($con,"SELECT * FROM `job_app` WHERE job_app_uid='$sid' AND success_send!='0' limit $startno,$pagesize");
							while($row=mysqli_fetch_array($sel))
							{
								$job_app_compid=$row['job_app_compid'];
								$job_app_post=$row['job_app_post'];
								$sela=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$job_app_post'");
								$rowa=mysqli_fetch_array($sela);
								
								$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_app_compid'");
								$rowab=mysqli_fetch_array($selab);
							?>
                                <div class="job-box job-box-2">
                                    <div class="col-md-2 col-sm-2 col-xs-12 hidden-xs hidden-sm">
                                        <div class="comp-logo">
                                           <img src="upload/<?php echo $rowab['comp_logo']; ?>" class="img-responsive" alt="Company Logo"> 
                                        </div>

                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="job-title-box">
                                            <a href="job_details?id=<?php echo $rowa['id']; ?>">
                                                <div class="job-title"> <?php echo $rowa['job_title']; ?></div>
                                            </a>
                                            <a href="company_details?id=<?php echo $rowab['comp_uid']; ?>"><span class="comp-name"><?php echo $rowab['industry']; ?></span></a>
                                            <a href="job_details?id=<?php echo $rowa['id']; ?>" class="job-type jt-full-time-color">
                                                <i class="fa fa-clock-o"></i> <?php echo $rowa['job_type']; ?>
                                            </a>
                                        </div>
                                        <p><?php echo $rowa['job_details']; ?><a href="#"><?php echo $result12['title2']; ?></a> </p>
                                    </div>
                                    <div class="job-salary">
                                        <i class="fa fa-money"></i> <?php echo $rowa['currency']; ?> <?php echo $rowa['job_salary']; ?>
                                    </div>
                                </div>
							<?php } ?>
                            </div>
                             <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="pagination-box clearfix">
                                    <ul class="pagination">
                                        <li>
                                            <a href="user-job-applied?start=0" aria-label="Previous"> <span aria-hidden="true"><?php echo $result12['title3']; ?></span> </a>
                                        </li>
										<?php
										for($j=0;$j<$total_rows;$j=$j+$pagesize)
										{
										if($startno==$j)
										{
										?>
                                        <li><a href="user-job-applied?start=0"><?php echo $pageno; ?></a></li>
                                       <?php
										}
										else
										{
										?>
										<li><a href="user-job-applied?start=<?php echo $j; ?>"><?php echo $pageno; ?></a></li>
										<?php
										}
										$pageno++;
										}
										?>
                                        <li>
                                            <a href="user-job-applied?start=<?php echo $j-$pagesize; ?>" aria-label="Next"> <span aria-hidden="true"><?php echo $result12['title4']; ?></span> </a>
                                        </li>
                                    </ul>
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