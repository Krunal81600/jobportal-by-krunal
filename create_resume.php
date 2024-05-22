<?php include('header.php');

   include 'dbConfig.php';

$cra=mysqli_query($con,"SELECT * FROM `account` WHERE id='1'");
$resumecra=mysqli_fetch_array($cra);

$paypalURL = $resumecra['paypal_url']; //Test PayPal API URL
$paypalID = $resumecra['paypal_id']; //Business Email


$cr=mysqli_query($con,"SELECT * FROM `create_resume` WHERE id='1'");
$resumecr=mysqli_fetch_array($cr);
 ?>
    <section class="main-section parallex-white static-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-xs-12 nopadding">
                    <div class="search-form-contaner">
                        <h1 class="search-main-title"> <?php echo $resumecr['title1']; ?> </h1>
                        <p><?php echo $resumecr['title2']; ?></p>
						<?php
						$session_id=$_SESSION['member_id'];
						if($session_id=="")
						{ ?>
							<button onclick="window.location.href='register'" type="button" class="btn btn-primary btn-custom"><?php echo $resumecr['title3']; ?></button>
						<?php
						}
						else
						{
						$selm=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
						$rowm=mysqli_fetch_array($selm);
						if($rowm['make_pay']==0)
						{
						?>
						<button data-target="#myModal" data-toggle="modal" type="button" class="btn btn-primary btn-custom"><?php echo $resumecr['title3']; ?></button>
						<?php } else { 
						$session_id=$_SESSION['member_id'];
						$selma=mysqli_query($con,"SELECT * FROM `make_resume` WHERE user_id='$session_id'");
						$rowma=mysqli_fetch_array($selma);
						if($rowma['app_mk']==0)
						{
						?>
						<button type="button" class="btn btn-success btn-custom"><?php echo $resumecr['title4']; ?></button>
						<?php } else { ?>
						<button type="button" class="btn btn-success btn-custom"><?php echo $resumecr['title5']; ?></button>
						<?php } } }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<section class="featured-jobs" style="background-color: #fff;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="Heading-title black">
                            <p><?php echo $resumecr['title6']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box" style="border: none;text-align: center;">
                            <div class="img-box" style="background-color: #fff;"><img src="images/ad1.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> <?php echo $resumecr['title7']; ?> </a></h4>
                                    <p> <?php echo $resumecr['title8']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box" style="border: none;text-align: center;">
                            <div class="img-box" style="background-color: #fff;"><img src="images/ad2.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> <?php echo $resumecr['title9']; ?> </a></h4>
                                    <p> <?php echo $resumecr['title10']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box" style="border: none;text-align: center;">
                            <div class="img-box" style="background-color: #fff;"><img src="images/ad3.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> <?php echo $resumecr['title11']; ?> </a></h4>
                                    <p> <?php echo $resumecr['title12']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<section class="about-us" style="border-top: 3px solid #2088cb;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="Heading-title-left black small-heading">
							<h3><?php echo $resumecr['title13']; ?></h3>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<h1><?php echo $resumecr['title14']; ?></h1>
						<p><?php echo $resumecr['title15']; ?></p>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 hidden-sm"> <img src="images/google-search.jpeg" alt="" class="img-responsive"> </div>
				</div>
			</div>
		</div>
	</section>
	<section class="call-to-action-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-8 col-sm-8 col-xs-12">
						<i class="icon-trophy"></i>
						<div class="heading-detail">
							<h3 style="font-size: 30px;"><?php echo $resumecr['title16']; ?></h3>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<?php
						$session_id=$_SESSION['member_id'];
						if($session_id=="")
						{ ?>
							<button onclick="window.location.href='register'" type="button" class="btn btn-primary btn-block"><?php echo $resumecr['title3']; ?></button>
						<?php
						}
						else
						{
						$selm=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
						$rowm=mysqli_fetch_array($selm);
						if($rowm['make_pay']==0)
						{
						?>
						<button data-target="#myModal" data-toggle="modal" type="button" class="btn btn-primary btn-block"><?php echo $resumecr['title3']; ?></button>
						<?php } else { 
						$session_id=$_SESSION['member_id'];
						$selma=mysqli_query($con,"SELECT * FROM `make_resume` WHERE user_id='$session_id'");
						$rowma=mysqli_fetch_array($selma);
						if($rowma['app_mk']==0)
						{
						?>
						<button type="button" class="btn btn-success btn-block"><?php echo $resumecr['title4']; ?></button>
						<?php } else { ?>
						<button type="button" class="btn btn-success btn-block"><?php echo $resumecr['title5']; ?></button>
						<?php } } }?>
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
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog"> 
			<div class="modal-content">
				<div class="modal-header rte">
					<h2 class="modal-title1"><?php echo $resumecr['title17']; ?></h2>
				</div>
				<form action="paymentscr.php" method="POST">
				<div class="modal-body">
					<div class="col-md-12 col-sm-12">
						<?php
						$results = $db->query("SELECT * FROM products WHERE id='1'");
						$rowp = $results->fetch_assoc();
						?>
						<p><?php echo $resumecr['title18']; ?></p>
						<!-- Identify your business so that you can collect the payments. -->
						
						<!-- Specify a Buy Now button. -->
						<input type="hidden" name="item_name" value="Create Resume">
						
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="currency_code" value="USD" />
						<input type="hidden" name="item_number" value="1" / >
						<input type="hidden" name="amount" value="69.99" / >
					</div>
				</div>
				<div class="modal-footer" style="border-top: none;">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $resumecr['title19']; ?></button>
					<button type="submit" name="submit" class="btn btn-default" ><?php echo $resumecr['title20']; ?></button>
				</div>
				</form>
			</div>
		</div>
	</div>
<?php include('footer.php'); ?>