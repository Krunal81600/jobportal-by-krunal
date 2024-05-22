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

error_reporting(0);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='interest_in_company'");
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
										<li>
											<a href="user-job-applied"> <i class="fa  fa-list-ul"></i> <?php echo $result123['title5']; ?></a>
										</li>
										<li>
											<a href="user-followed-companies"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title6']; ?> </a>
										</li>
										<li>
											<a href="paid_resume"> <i class="fa fa-money"></i> <?php echo $result123['title7']; ?></a>
										</li>
										<li  class="active">
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
                            <div class="resume-list">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th><?php echo $result12['title2']; ?></th>
                                                <th><?php echo $result12['title3']; ?></th>
                                                <th><?php echo $result12['title4']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$no=0;
										$a=mysqli_query($con,"SELECT * FROM `interest` WHERE us_id='$session_id' AND `us_type`='cm' AND `in_status`!='0' ORDER BY  `id` DESC");
										while($row=mysqli_fetch_array($a))
										{
											$no=$no+1;
											$cm_id=$row['cm_id'];
											
											$aaa=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$cm_id'");
											$rowaa=mysqli_fetch_array($aaa);
										?>
                                            <tr>
                                                <td scope="row"><?php echo $no; ?></td>
                                                <td><h5><?php echo $rowaa['industry']; ?></h5></td>
                                                <td><a class="btn btn-info" href="#"> <?php echo $result12['title5']; ?> </a></td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
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