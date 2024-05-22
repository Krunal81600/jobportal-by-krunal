<?php
	include('header.php');
	$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$row=mysqli_fetch_array($sel);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='usdashboard'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);	
?>
        <section class="dashboard parallex" style="background: rgba(60, 146, 202, 0.7) url(upload/<?php echo $row['cover']; ?>) no-repeat fixed center center / cover;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="dashboard-header">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="user-avatar ">
                                    <img src="upload/<?php echo $row['profile']; ?>" alt="" class="img-responsive center-block "></a>
                                    <h3><?php echo $row['user']; ?></h3>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="rad-info-box rad-txt-success">
                                    <i class="icon icon-presentation"></i>
                                    <span class="title-dashboard"><?php echo $result12['title1']; ?></span>
                                    <span class="value"><span><?php 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `follow` WHERE user_id='$uid'");
									echo $countfl=mysqli_num_rows($cnt); ?></span></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="rad-info-box rad-txt-success">
                                    <i class="icon icon-aperture"></i>
                                    <span class="title-dashboard"><?php echo $result12['title2']; ?></span>
                                    <span class="value"><span><?php 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `job_app` WHERE job_app_uid='$uid'");
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
                            <div class="job-short-detail">
                                <div class="heading-inner">
                                    <p class="title"><?php echo $result12['title3']; ?></p>
                                </div>
                                <dl>
                                    <dt><?php echo $result12['title3']; ?>:</dt>
                                    <dd><?php echo $row['fname']; ?></dd>

                                    <dt><?php echo $result12['title4']; ?>:</dt>
                                    <dd><?php echo $row['lname']; ?></dd>
									
									<dt><?php echo $result12['title5']; ?>:</dt>
                                    <dd><?php echo $row['user']; ?></dd>

                                    <dt><?php echo $result12['title6']; ?>:</dt>
                                    <dd><?php echo $row['email']; ?> </dd>
									
									<dt><?php echo $result12['title7']; ?>:</dt>
                                    <dd><?php echo $row['dob']; ?></dd>

                                    <dt><?php echo $result12['title8']; ?>:</dt>
                                    <dd><?php echo $row['phone']; ?> </dd>

                                    <dt><?php echo $result12['title9']; ?>:</dt>
                                    <dd><?php echo $row['last_edu']; ?></dd>

                                    <dt><?php echo $result12['title10']; ?>:</dt>
                                    <dd><?php echo $row['address']; ?></dd>

                                    <dt><?php echo $result12['title11']; ?>:</dt>
                                    <dd><?php $city=$row['city'];
									$selcity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$city'");
									$rowcity=mysqli_fetch_array($selcity);
									echo $rowcity['citynm'];
									?></dd>

                                    <dt><?php echo $result12['title12']; ?>:</dt>
                                    <dd><?php $country=$row['country'];
									$selcountry=mysqli_query($con,"SELECT * FROM `country` WHERE id='$country'");
									$rowcountry=mysqli_fetch_array($selcountry);
									echo $rowcountry['countrynm'];
									?></dd>
                                </dl>
                            </div>

                            <div class="heading-inner">
                                <p class="title"><?php echo $result12['title13']; ?></p>
                            </div>
                            <p><?php echo $row['about']; ?></p>

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
			<div class="client-logo"> <a href="<?php echo $row2['brand_link']; ?>" target="_blank"><img src="images/clients/<?php echo $row2['brand_img']; ?>" class="img-responsive" alt="Brand Image" /></a> </div>
			<?php } ?>
		</div>
	</div>
<?php
	include('footer.php');
?>