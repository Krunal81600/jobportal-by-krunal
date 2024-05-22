<?php include('header.php');
$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='all_category'");
$result12 = mysqli_fetch_array($sql12);
 ?>

        <section class="breadcrumb-search parallex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-8 col-sm-12 col-md-offset-2 col-xs-12 nopadding">
                            <div class="search-form-contaner">
                                <form class="form-inline" method="POST" action="search">
									<div class="col-md-4 col-sm-4 col-xs-12 nopadding">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Search Keyword" name="tagsr">
											<i class="icon-magnifying-glass"></i>
										</div>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12 nopadding">
										<div class="form-group">
											<select class="select-category form-control" name="categorysr">
												<option value="">&nbsp;</option>
												<?php 
													$r2 = mysqli_query($con,"SELECT * FROM `category`");
													while($row2 = mysqli_fetch_array($r2)){
														echo"<option value='".$row2['category']."'>".$row2['category']."</option>";
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-12 nopadding">
										<div class="form-group">
											<select class="select-location form-control" name="countrysr">
												<option label="Select Option"></option>
												<?php 
													$r2 = mysqli_query($con,"SELECT * FROM `country`");
													while($row2 = mysqli_fetch_array($r2)){
														echo"<option value='".$row2['id']."'>".$row2['countrynm']."</option>";
													}
												?> 
											</select>
										</div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12 nopadding">
										<div class="form-group form-action">
											<button type="submit" name="search" class="btn btn-default btn-search-submit"><?php echo $result12['title1']; ?> <i class="fa fa-angle-right"></i> </button>
										</div>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="category-section-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="Heading-title black">
                            <h1><?php echo $result12['title2']; ?></h1>
                        </div>
                    </div>
                    <?php 
					$today=date('Y-m-d');
					$r1 = mysqli_query($con,"SELECT * FROM `category` WHERE shown='1'"); 
					while($row1 = mysqli_fetch_array($r1))
					{
						$job_category=$row1['category'];
						$today=date('Y-m-d');
						$chk = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$job_category' AND `job_edate` >  '$today' AND ad_app='1' ");
						$rowchk = mysqli_num_rows($chk);
						if($rowchk > 0)
						{
						
				?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="category-section-3-box" >
                            <div class="category-section-3-box-inner" style="border: 2px solid #F5f5f5 !important;"> <i class="<?php echo $row1['category_icon']; ?>"></i>
                                <h4> <?php echo $row1['category']; ?> </h4>
                                <span>( <?php 
								$job_category=$row1['category'];
								$r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$job_category' AND `job_edate` >  '$today' AND ad_app='1'"); 
					echo mysqli_num_rows($r12); ?> )</span> </div>
                            <div class="category-section-3-box-over-text animated fadeIn">
                                <h4><?php echo $row1['category_content']; ?></h4>
                                <p><a href="job-category?category=<?php echo $row1['category']; ?>"> <?php echo $result12['title3']; ?> </a></p>
                            </div>
                            <div class="icon-bottom">
                            	<i class="icon-browser"></i>
                            </div>
                        </div>
                    </div>
				<?php
					} else {} }?>
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