<?php include('header.php'); 
$_SESSION['url'] = $_SERVER['REQUEST_URI'];

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='user_listing'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);
?>
<style>
.profile-skills {
    padding-left: 146px;
}
@media only screen and (max-width: 500px) {
    .profile-skills {
    padding-left: 0px;
}
}
</style>
        <section class="breadcrumb-search parallex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-8 col-sm-12 col-md-offset-2 col-xs-12 nopadding">
                            <div class="search-form-contaner">
                                <form class="form-inline" method="POST" action="search_result">
                                    <div class="col-md-7 col-sm-7 col-xs-12 nopadding">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="position" placeholder="Search By Position" value="">
                                            <i class="icon-magnifying-glass"></i>
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
							if(isset($_REQUEST['start']))
							{
							$startno=$_REQUEST['start'];
							}
							else
							{
							$startno=0;
							}
							$pagesize=5;
							$i=0;
							$pageno=1;
							$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `user` WHERE rtype='Employee'");
							$total_rows=mysqli_num_rows($SqlQueryRun1);
							
							$sel=mysqli_query($con,"SELECT * FROM `user` WHERE rtype='Employee' ORDER BY id ASC limit $startno,$pagesize");
							while($row=mysqli_fetch_array($sel))
							{
								$job_uid=$row['id'];
								$sela=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$job_uid'");
								$rowa=mysqli_fetch_array($sela);
								
								$selc=mysqli_query($con,"SELECT * FROM `skill` WHERE skill_uid='$job_uid'");
								$rowc=mysqli_fetch_array($selc);
								$fee_details = unserialize($rowc['skill_nm']);
							?>
                        	<div class="profile-content">
                                <div class="card">
                                    <div class="firstinfo">
                                    	<img src="upload/<?php echo $row['profile']; ?>" alt="" class="img-circle img-responsive" />
                                        <div class="profileinfo">
                                            <h1> <a href="user_resume?id=<?php echo $row['id']; ?>"> <?php echo $row['fname']." ".$row['lname']; ?> </a></h1>
                                            <h3><?php echo $rowa['exp_pos']; ?></h3>
                                            <p class="bio"><?php echo $row['about']; ?></p>
                                            <div class="profile-skills">
											<?php
												for($j=0;$j<count($fee_details);$j++)
												{
												$fee_details_id=$fee_details[$j];
												$explode=explode(',',$fee_details_id);
												if($j==0)
													{
											?>
                                            	<span> <?php echo $explode[0]; ?> </span> 
											<?php } else { ?>
											<span> <?php echo $explode[0]; ?> </span> 
											<?php } } ?>
                                            </div>
                                            <div class="hire-btn">
                                            	<a href="user_resume?id=<?php echo $row['id']; ?>" class="btn-default" > <i class="fa fa-location-arrow"></i> <?php echo $result12['title2']; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php } ?>
						   <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="pagination-box clearfix">
                                    <ul class="pagination">
                                        <li>
                                            <a href="user_listing?start=0" aria-label="Previous"> <span aria-hidden="true"><?php echo $result12['title3']; ?></span> </a>
                                        </li>
										<?php
										for($j=0;$j<$total_rows;$j=$j+$pagesize)
										{
										if($startno==$j)
										{
										?>
                                        <li><a href="user_listing?start=0"><?php echo $pageno; ?></a></li>
                                       <?php
										}
										else
										{
										?>
										<li><a href="user_listing?start=<?php echo $j; ?>"><?php echo $pageno; ?></a></li>
										<?php
										}
										$pageno++;
										}
										?>
                                        <li>
                                            <a href="user_listing?start=<?php echo $j-$pagesize; ?>" aria-label="Next"> <span aria-hidden="true"><?php echo $result12['title4']; ?></span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                         <div class="col-md-4 col-sm-12 col-xs-12">
                            <aside>
                                <div class="widget">
                                    <div class="widget-heading"><span class="title"><?php echo $result12['title5']; ?></span></div>
                                    <ul class="categories-module">
										<?php
										$r2 = mysqli_query($con,"SELECT * FROM `category`");
											while($row2 = mysqli_fetch_array($r2)){
												$categorynm=$row2['category'];
												?>
                                        <li> <a href="job-category?category=<?php echo $row2['category']; ?>"> <?php echo $row2['category']; ?> <span>(<?php $r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$categorynm' AND app_status='1'"); 
					echo mysqli_num_rows($r12); ?>)</span> </a> </li>
											<?php } ?>
                                    </ul>
                                </div>
                               <div class="widget">
                                    <div class="widget-heading"><span class="title"><?php echo $result12['title6']; ?></span></div>
                                    <ul class="related-post">
									<?php
										$r2 = mysqli_query($con,"SELECT * FROM `post_job` WHERE app_status='1' LIMIT 5");
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
<?php include('footer.php'); ?>