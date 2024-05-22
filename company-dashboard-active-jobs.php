<?php
	include('header.php');
	$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$session_id'");
$row=mysqli_fetch_array($sel);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='active-jobs'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar2'");
$result123 = mysqli_fetch_array($sql123);

?>
 <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="panel">
                                <div class="dashboard-logo-sidebar">
                                    <img class="img-responsive center-block" src="upload/<?php echo $row['comp_logo']; ?>" alt="Image">
                                </div>
                                <div class="text-center dashboard-logo-sidebar-title">
                                    <h4><?php echo $row['industry']; ?></h4>
                                </div>
                            </div>
                            <div class="profile-nav">
                                <div class="panel">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li>
                                            <a href="company-dashboard"> <i class="fa fa-user"></i> <?php echo $result123['title1']; ?></a>
                                        </li>
                                        <li>
                                            <a href="edit-profile-company"> <i class="fa fa-edit"></i> <?php echo $result123['title2']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title3']; ?></a>
                                        </li>
                                        <li class="active">
                                            <a href="company-dashboard-active-jobs"> <i class="fa  fa-list-alt"></i> <?php echo $result123['title4']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-followers"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title5']; ?> </a>
                                        </li>
										<li>
                                            <a href="hire_candidate"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title6']; ?> </a>
                                        </li>
										<li>
                                            <a href="interest_in_candidate"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title7']; ?> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title1']; ?></p>
                            </div>
							<p><?php echo $result12['title2']; ?></p>
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
							$pagesize=5;
							$i=0;
							$pageno=1;
							
							$id=$_SESSION['member_id'];
							
							$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_uid='$id'");
							$total_rows=mysqli_num_rows($SqlQueryRun1);
							
							$sql1=mysqli_query($con,"SELECT * FROM `post_job` WHERE job_uid='$id' limit $startno,$pagesize");
							while($row1=mysqli_fetch_array($sql1))
							{
								$cid=$row1['job_uid'];
								$postid=$row1['id'];
								
								$sql2=mysqli_query($con,"SELECT * FROM `compnay` WHERE comp_uid='$cid'");
								$row2=mysqli_fetch_array($sql2);
								
								$selapp=mysqli_query($con,"SELECT * FROM `payment` WHERE postid='$postid' AND user_id='$id'");
								$rowapp=mysqli_fetch_array($selapp);
							?>
                                <div class="job-box job-box-2 expire-box ribbon-content">
                                    <div class="job-title-box">
                                        <a href="job_details?id=<?php echo $row1['id']; ?>">
                                            <div class="job-title"> <?php echo $row1['job_title']; ?></div>
                                        </a>
                                        <a href="job_details?id=<?php echo $row1['id']; ?>"><span class="comp-name"><?php echo $row2['industry']; ?> </span></a>
                                        <a href="job_details?id=<?php echo $row1['id']; ?>" class="job-type jt-full-time-color">
                                            <i class="fa fa-clock-o"></i> <?php echo $row1['job_type']; ?>
                                        </a>
                                    </div>
                                    <div class="expire-job-box">
                                        <span class="expire-date"> <?php echo $result12['title3']; ?> <strong><?php echo $row1['job_edate']; ?></strong></span>
                                        <span class="pull-right">
										<?php
										if($row1['job_paid']==1)
										{
										?>
										<a href="#" class="btn btn-success"><?php echo $result12['title4']; ?></a>
										<?php } else { ?>
										<button data-target="#myModal<?php echo $row1['id']; ?>" data-toggle="modal" type="button" class="btn btn-danger"><?php echo $result12['title5']; ?></button>
										<?php } ?>
                                   		<a href="postedit?id=<?php echo $row1['id']; ?>" class="btn btn-default"> <?php echo $result12['title6']; ?></a>
                                    	<a href="postedit?id=<?php echo $row1['id']; ?>&delete=delete" class="btn btn-danger"> <?php echo $result12['title7']; ?></a>
                                   </span>
                                    </div>
									<div class="expire-job-box">
									<?php
									if($row1['job_paid']==1 && $row1['app_status']==1)
									{
									?>
									<p><?php echo $result12['title8']; ?></p>
									<?php } else {
									if($row1['job_paid']==1)
									{
									?>
									<p><?php echo $result12['title9']; ?> <?php echo $rowapp['sdate']; ?> To <?php echo $rowapp['edate']; ?> <?php echo $result12['title10']; ?></p>
									<?php } else {} }?>
                                    </div>
                                </div>
									<div id="myModal<?php echo $row1['id']; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog"> 
											<div class="modal-content">
												<div class="modal-header rte">
													<h2 class="modal-title1"><?php echo $result12['title11']; ?></h2>
												</div>
												<form method="POST" action="payments.php">
												<div class="modal-body">
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label><?php echo $result12['title12']; ?> <span class="required">*</span></label>
															<input placeholder="Select From Date" class="form-control" name="sdate" type="date">
														</div>
													</div>
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label><?php echo $result12['title13']; ?> <span class="required">*</span></label>
															<input placeholder="To From Date" class="form-control" name="edate" type="date">
															<input class="form-control" name="postid" type="hidden" value="<?php echo $row1['id']; ?>">
																					
															<!-- Specify a Buy Now button. -->
															<input type="hidden" name="item_name" value="Paid Post">
															
															<input type="hidden" name="cmd" value="_xclick" />
															<input type="hidden" name="currency_code" value="USD" />
															<input type="hidden" name="item_number" value="123456" / >
														</div>
													</div>
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label><?php echo $result12['title14']; ?> <span class="required">*</span></label>
															<select name="amount" class="form-control">
																<option value=""><?php echo $result12['title14']; ?> </option>
																<option value="6.99"><?php echo $result12['title15']; ?> </option>
																<option value="199.70"><?php echo $result12['title16']; ?></option>
															</select>
														</div>
													</div>
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label><?php echo $result12['title17']; ?> <span class="required">*</span></label>
															<select name="pay_by" class="form-control">
																<option value=""><?php echo $result12['title17']; ?> </option>
																<option value="Pay by Cash"><?php echo $result12['title18']; ?> </option>
																<option value="Pay by Card"><?php echo $result12['title19']; ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $result12['title20']; ?></button>
													<button type="submit" name="payment" class="btn btn-default"><?php echo $result12['title21']; ?></button>
												</div>
												</form>
											</div>
										</div>
									</div>
                                <?php } ?>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="pagination-box clearfix">
                                    <ul class="pagination">
                                        <li>
                                            <a href="company-dashboard-active-jobs?start=0" aria-label="Previous"> <span aria-hidden="true"><?php echo $result12['title22']; ?></span> </a>
                                        </li>
										<?php
										for($j=0;$j<$total_rows;$j=$j+$pagesize)
										{
										if($startno==$j)
										{
										?>
                                        <li><a href="company-dashboard-active-jobs?start=0"><?php echo $pageno; ?></a></li>
                                       <?php
										}
										else
										{
										?>
										<li><a href="company-dashboard-active-jobs?start=<?php echo $j; ?>"><?php echo $pageno; ?></a></li>
										<?php
										}
										$pageno++;
										}
										?>
                                        <li>
                                            <a href="company-dashboard-active-jobs?start=<?php echo $j-$pagesize; ?>" aria-label="Next"> <span aria-hidden="true"><?php echo $result12['title23']; ?></span> </a>
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