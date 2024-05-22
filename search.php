<?php
include('header.php');
$today=date('Y-m-d');
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if($_REQUEST['apply'])
{
	$uid=$_SESSION['member_id'];
	$comp_id=$_GET['comp_id'];
	
	mysqli_query($con,"INSERT INTO `job_app`(`job_app_uid`, `job_app_compid`) VALUES ('$uid','$comp_id')");
	?>
	<script>
		alert("Successfully Applied");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='index'";
	echo "</script>";
}
if(isset($_POST['search']))
{
	$tagsr=$_POST['tagsr'];
	$categorysr=$_POST['categorysr'];
	$countrysr=$_POST['countrysr'];
}

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='search'");
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
        <section class="categories-list-page light-grey">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-8 col-sm-12 col-xs-12">
						<?php
						if($tagsr=="" && $countrysr=="")
						{
						?>
                            <h4 class="search-result-text"><?php echo $result12['title2']; ?> <?php $r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorysr' AND ad_app='1' AND `job_edate` >  '$today'"); 
					echo mysqli_num_rows($r12); ?> <?php echo $result12['title3']; ?></h4>
						<?php } elseif($categorysr=="" && $countrysr=="")
						{
						?>
                            <h4 class="search-result-text"><?php echo $result12['title2']; ?> <?php $r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_tags like '%$tagsr%' AND ad_app='1' AND `job_edate` >  '$today'"); 
					echo mysqli_num_rows($r12); ?> <?php echo $result12['title3']; ?></h4>
						<?php } elseif($tagsr=="" && $categorysr=="")
						{
						?>
                            <h4 class="search-result-text"><?php echo $result12['title2']; ?> <?php $r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE country='$countrysr' AND ad_app='1' AND `job_edate` >  '$today'"); 
					echo mysqli_num_rows($r12); ?> <?php echo $result12['title3']; ?></h4>
						<?php } else { ?>
						 <h4 class="search-result-text"><?php echo $result12['title2']; ?> <?php $r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorysr' OR job_tags like '%$tagsr%' OR country='$countrysr' AND ad_app='1' AND `job_edate` >  '$today'"); 
					echo mysqli_num_rows($r12); ?> <?php echo $result12['title3']; ?></h4>
						<?php } ?>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="all-jobs-list-box">
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
							
							if($tagsr=="" && $countrysr=="") 
							{ 
								$r123 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorysr' AND ad_app='1' AND `job_edate` >  '$today' limit $startno,$pagesize"); 
								$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorysr' AND ad_app='1' AND `job_edate` >  '$today'");
								$total_rows=mysqli_num_rows($SqlQueryRun1);
							} 
							elseif($categorysr=="" && $countrysr=="") 
							{ 
								$r123 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_tags like '%$tagsr%' AND ad_app='1' AND `job_edate` >  '$today' limit $startno,$pagesize"); 
								$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_tags like '%$tagsr%' AND ad_app='1' AND `job_edate` >  '$today'");
								$total_rows=mysqli_num_rows($SqlQueryRun1);
							} 
							elseif($tagsr=="" && $categorysr=="") 
							{ 
								$r123 = mysqli_query($con,"SELECT * FROM `post_job` WHERE country='$countrysr' AND ad_app='1' AND `job_edate` >  '$today' limit $startno,$pagesize"); 
								$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `post_job` WHERE country='$countrysr' AND ad_app='1' AND `job_edate` >  '$today'");
								$total_rows=mysqli_num_rows($SqlQueryRun1);
							} 
							else 
							{ 
								$r123 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorysr' OR job_tags like '%$tagsr%' OR country='$countrysr' AND ad_app='1' AND `job_edate` >  '$today' limit $startno,$pagesize"); 
								$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorysr' OR job_tags like '%$tagsr%' OR country='$countrysr' AND ad_app='1' AND `job_edate` >  '$today'");
								$total_rows=mysqli_num_rows($SqlQueryRun1);
							} 
							while($row123=mysqli_fetch_array($r123))
							{
								
								$job_uid=$row123['job_uid'];
								$sela=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_uid' ORDER BY industry ASC");
								$rowa=mysqli_fetch_array($sela);
								
								$countryid=$row123['country'];
								$selacou=mysqli_query($con,"SELECT * FROM `country` WHERE id='$countryid'");
								$rowacou=mysqli_fetch_array($selacou);
								
								$cityipa=$row123['job_location'];
								$selacity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cityipa'");
								$rowacity=mysqli_fetch_array($selacity);
							?>
                                <div class="job-box">
                                    <div class="col-md-1 col-sm-1 col-xs-12 nopadding hidden-xs hidden-sm">
										<div class="comp-logo"> <img src="upload/<?php echo $rowa['comp_logo']; ?>" class="img-responsive" alt="Company Logo"> </div>
									</div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 nopadding">
                                        <div class="job-title-box">
                                            <a href="job_details?id=<?php echo $row123['id']; ?>">
                                                <div class="job-title"> <?php echo $row123['job_title']; ?></div>
                                            </a>
                                            <a href="#"><span class="comp-name"><?php echo $rowa['industry']; ?></span></a>
                                        </div>
                                    </div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacity['citynm']; ?>  </div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacou['countrynm']; ?> </div>
									</div>
                                    <div class="col-md-2 col-sm-3 col-xs-6">
                                        <a href="#">
                                            <div class="job-type jt-remote-color">
                                                <i class="fa fa-clock-o"></i> <?php echo $row123['job_type']; ?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12 nopadding">
									<?php
									if($_SESSION['member_user']=="")
									{ ?>
                                        <button class="btn btn-primary btn-custom" onclick="window.location.href='register'"><?php echo $result12['title4']; ?></button>
									<?php } else { ?>
										<button class="btn btn-primary btn-custom" onclick="window.location.href='job_details?id=<?php echo $row123['id']; ?>'"><?php echo $result12['title4']; ?></button>
									<?php } ?>
                                    </div>
                                </div>
							<?php } ?>  
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="pagination-box clearfix">
                                    <ul class="pagination">
                                        <li>
                                            <a href="job_listing?start=0" aria-label="Previous"> <span aria-hidden="true"><?php echo $result12['title5']; ?></span> </a>
                                        </li>
										<?php
										for($j=0;$j<$total_rows;$j=$j+$pagesize)
										{
										if($startno==$j)
										{
										?>
                                        <li><a href="search?start=0"><?php echo $pageno; ?></a></li>
                                       <?php
										}
										else
										{
										?>
										<li><a href="search?start=<?php echo $j; ?>"><?php echo $pageno; ?></a></li>
										<?php
										}
										$pageno++;
										}
										?>
                                        <li>
                                            <a href="search?start=<?php echo $j-$pagesize; ?>" aria-label="Next"> <span aria-hidden="true"><?php echo $result12['title6']; ?></span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <aside>
                                <div class="widget">
                                    <div class="widget-heading"><span class="title"><?php echo $result12['title7']; ?></span></div>
                                    <ul class="categories-module">
										<?php
										$r2 = mysqli_query($con,"SELECT * FROM `category`");
											while($row2 = mysqli_fetch_array($r2)){
												$categorynm=$row2['category'];
												?>
                                        <li> <a href="job-category?category=<?php echo $row2['category']; ?>"> <?php echo $row2['category']; ?> <span>(<?php $r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorynm' AND ad_app='1' AND `job_edate` >  '$today'"); 
					echo mysqli_num_rows($r12); ?>)</span> </a> </li>
											<?php } ?>
                                    </ul>
                                </div>
                                <div class="widget">
                                    <div class="widget-heading"><span class="title"><?php echo $result12['title8']; ?></span></div>
                                    <ul class="related-post">
									<?php
										$r2 = mysqli_query($con,"SELECT * FROM `post_job` WHERE ad_app='1' AND `job_edate` >  '$today' LIMIT 5");
										$r2 = mysqli_query($con,"SELECT * FROM `post_job` WHERE ad_app='1' AND `job_edate` >  '$today' LIMIT 5");
										while($row2 = mysqli_fetch_array($r2)){
											
											$cityipa=$row2['job_location'];
											$selacity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cityipa'");
											$rowacity=mysqli_fetch_array($selacity);
											?>
                                        <li>
                                            <a href="job_details?id=<?php echo $row2['id']; ?>"><?php echo $row2['job_title']; ?></a>
                                            <span><i class="fa fa-map-marker"></i><?php echo $rowacity['citynm']; ?> </span>
                                            <span><i class="fa fa-calendar"></i><?php echo $row2['job_date']; ?> - <?php echo $row2['job_edate']; ?> </span>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>

                            </aside>
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