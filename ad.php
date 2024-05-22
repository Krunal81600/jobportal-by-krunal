<?php include('header.php');
$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='ad'");
$result12 = mysqli_fetch_array($sql12);
 ?>
    <section class="main-section parallex-white static-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-xs-12 nopadding">
                    <div class="search-form-contaner">
                        <h1 class="search-main-title"> <?php echo $result12['title1']; ?> </h1>
                        <p><?php echo $result12['title2']; ?></p>
                        <button class="btn btn-primary btn-custom" onclick="window.location.href='create_ad'"><?php echo $result12['title3']; ?></button>
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
                            <p><?php echo $result12['title4']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box" style="border: none;text-align: center;">
                            <div class="img-box" style="background-color: #fff;"><img src="images/ad1.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> <?php echo $result12['title5']; ?> </a></h4>
                                    <p> <?php echo $result12['title6']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box" style="border: none;text-align: center;">
                            <div class="img-box" style="background-color: #fff;"><img src="images/ad2.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> <?php echo $result12['title7']; ?> </a></h4>
                                    <p> <?php echo $result12['title8']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box" style="border: none;text-align: center;">
                            <div class="img-box" style="background-color: #fff;"><img src="images/ad3.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> <?php echo $result12['title9']; ?> </a></h4>
                                    <p><?php echo $result12['title10']; ?> </p>
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
							<h3><?php echo $result12['title11']; ?></h3>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<h1><?php echo $result12['title12']; ?></h1>
						<p><?php echo $result12['title13']; ?></p>
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
					<div class="col-md-10 col-sm-10 col-xs-12">
						<i class="icon-trophy"></i>
						<div class="heading-detail">
							<h3><?php echo $result12['title14']; ?></h3>
						</div>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<a href="create_ad" class="btn btn-default btn-block"><?php echo $result12['title13']; ?></a>
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
<?php include('footer.php'); ?>