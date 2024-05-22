<?php include('header.php'); 

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='create_ad'");
$result12 = mysqli_fetch_array($sql12);


include 'dbConfig.php';

$cra=mysqli_query($con,"SELECT * FROM `account` WHERE id='1'");
$resumecra=mysqli_fetch_array($cra);

$paypalURL = $resumecra['paypal_url']; //Test PayPal API URL
$paypalID = $resumecra['paypal_id']; //Business Email
?>
        <section class="post-job ">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="Heading-title-left black small-heading">
                            <h3><?php echo $result12['title1']; ?></h3>
                        </div>
                        <div class="post-job2-panel">
                            <form class="row" method="POST" action="paymentsad.php" enctype="multipart/form-data">
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label><?php echo $result12['title2']; ?> <span class="required">*</span></label>
										<input placeholder="<?php echo $result12['title2']; ?>" class="form-control" name="sdate" type="date">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label><?php echo $result12['title3']; ?> <span class="required">*</span></label>
										<input placeholder="<?php echo $result12['title3']; ?>" class="form-control" name="edate" type="date">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label><?php echo $result12['title4']; ?> <span class="required">*</span></label>
										<select name="banner_size" class="form-control">
											<option value=""><?php echo $result12['title4']; ?></option>
											<option value="Large"> <?php echo $result12['title5']; ?> </option>
											<option value="Medium"> <?php echo $result12['title6']; ?> </option>
											<option value="Small"> <?php echo $result12['title7']; ?> </option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label><?php echo $result12['title8']; ?> <span class="required">*</span></label>
										<select name="amount" class="form-control">
											<option value=""><?php echo $result12['title8']; ?></option>
											<option value="6.99"><?php echo $result12['title9']; ?> </option>
											<option value="199.70"><?php echo $result12['title10']; ?></option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label><?php echo $result12['title11']; ?> <span class="required">*</span></label>
										<select name="pay_by" class="form-control">
											<option value=""><?php echo $result12['title11']; ?> </option>
											<option value="Pay by Cash"><?php echo $result12['title12']; ?> </option>
											<option value="Pay by Card"><?php echo $result12['title13']; ?></option>
										</select>
									</div>
								</div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title14']; ?></label>
                                        <input type="text" placeholder="<?php echo $result12['title14']; ?>" name="ad_title" class="form-control" required>
										
										<!-- Specify a Buy Now button. -->
										<input type="hidden" name="item_name" value="Create Ad">
										
										<input type="hidden" name="cmd" value="_xclick" />
										<input type="hidden" name="currency_code" value="USD" />
										<input type="hidden" name="item_number" value="1" / >
                                    </div>
                                </div>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title15']; ?></label>
                                        <input type="text" placeholder="<?php echo $result12['title15']; ?>" name="comp_website" class="form-control" required>
                                    </div>
                                </div>
								<div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title16']; ?></label>
                                        <input type="file" name="ad_img" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title17']; ?></label>
                                        <textarea id="ckeditor" placeholder="Ad Detials" name="ad_desc" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-default pull-right" type="submit" name="submit"><?php echo $result12['title18']; ?><i class="fa fa-angle-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="widget">
                            <div class="widget-heading"><span class="title"><?php echo $result12['title19']; ?></span></div>
                            <div class="" id="followers">
                                <ul class="list-group list-group-dividered list-group-full">
								<?php
									$sel=mysqli_query($con,"SELECT * FROM `user` WHERE paid_user_ap='1' ORDER BY id ASC LIMIT 6");
									while($row=mysqli_fetch_array($sel))
									{
									?>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="avatar avatar-online" href="javascript:void(0)">
                                                    <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive" alt="">
                                                    <i></i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-default btn-sm"><?php echo $result12['title20']; ?></button>
                                                </div>
                                                <div><a class="name" href="user_resume?id=<?php echo $row['id']; ?>"><?php echo $row['fname']." ".$row['lname']; ?></a></div>
                                                <small><?php echo $row['email']; ?></small>
                                            </div>
                                        </div>
                                    </li>
                                   <?php } ?>
                                </ul>
                            </div>
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