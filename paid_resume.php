<?php
include('header.php');
$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$row=mysqli_fetch_array($sel);

$sela=mysqli_query($con,"SELECT * FROM `payment` WHERE user_id='$session_id'");
$rowa=mysqli_fetch_array($sela);

$seld=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowd=mysqli_fetch_array($seld);


$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='paid_resume'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);

include 'dbConfig.php';

$cra=mysqli_query($con,"SELECT * FROM `account` WHERE id='1'");
$resumecra=mysqli_fetch_array($cra);

$paypalURL = $resumecra['paypal_url']; //Test PayPal API URL
$paypalID = $resumecra['paypal_id']; //Business Email
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
										<li  class="active">
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
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title1']; ?></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
								<?php
								if($row['paid_user']==1 && $row['paid_user_ap']==1)
								{
								?>
                                <h2 style="text-align:center"><?php echo $result12['title2']; ?></h2>
								<?php } else { 
								if($row['paid_user']==1)
								{
								?>
								 <h2 style="text-align:center"><?php echo $result12['title3']; ?> <?php echo $rowa['sdate']; ?> To <?php echo $rowa['edate']; ?> <?php echo $result12['title4']; ?></h2>
								<?php } else { ?>
								<h2 style="text-align:center"> <?php echo $result12['title5']; ?></h2>
								<?php } }?>
								<?php
								if($row['paid_user']==1)
								{
								?>
								<h1 style="text-align:center">
                                <span class="btn btn-success"><?php echo $result12['title6']; ?></span>
								</h1>
								<?php } else { ?>
								<h1 style="text-align:center">
								<button data-target="#myModal" data-toggle="modal" type="button" class="btn btn-danger"><?php echo $result12['title7']; ?></button>
								</h1>
								<?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog"> 
				<div class="modal-content">
					<div class="modal-header rte">
						<h2 class="modal-title1"><?php echo $result12['title8']; ?></h2>
					</div>
					<form method="POST" action="paymentsrs.php" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label><?php echo $result12['title9']; ?> <span class="required">*</span></label>
								<input placeholder="<?php echo $result12['title9']; ?>" class="form-control" name="sdate" type="date">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label><?php echo $result12['title10']; ?> <span class="required">*</span></label>
								<input placeholder="<?php echo $result12['title10']; ?>" class="form-control" name="edate" type="date">
								
								<!-- Specify a Buy Now button. -->
								<input type="hidden" name="item_name" value="Paid Post">
								
								<input type="hidden" name="cmd" value="_xclick" />
								<input type="hidden" name="currency_code" value="USD" />
								<input type="hidden" name="item_number" value="1" / >
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label><?php echo $result12['title11']; ?> <span class="required">*</span></label>
								<select name="amount" class="form-control">
									<option value=""><?php echo $result12['title11']; ?></option>
									<option value="6.99"><?php echo $result12['title12']; ?></option>
									<option value="199.70"><?php echo $result12['title13']; ?></option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label><?php echo $result12['title14']; ?><span class="required">*</span></label>
								<select name="pay_by" class="form-control">
									<option value=""><?php echo $result12['title14']; ?> </option>
									<option value="Pay by Cash"><?php echo $result12['title15']; ?></option>
									<option value="Pay by Card"><?php echo $result12['title16']; ?></option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $result12['title17']; ?></button>
						<button type="submit" name="payment" class="btn btn-default"><?php echo $result12['title18']; ?></button>
					</div>
					</form>
				</div>
			</div>
		</div>
<?php
	include('footer.php');
?>