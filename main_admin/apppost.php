<?php include('header.php'); ?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Company Approved Post <strong>Job</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Company Approved Post Job</li>
              </ol>
            </div>
          </div>
		  <?php
		  if($_REQUEST['edit'])
		  {
			  $idb=$_GET['id'];
			  $qry_rowb=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$idb'"); 
			  $rowc=mysqli_fetch_array($qry_rowb);
			  
			  $cityip=$rowc['job_location'];
			$selacitya=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cityip'");
			$rowacitya=mysqli_fetch_array($selacitya);
			  
			  if(isset($_POST['submit']))
				{
					$job_title=$_POST['job_title'];
					$job_location=$_POST['job_location'];
					$job_details=$_POST['job_details'];
					$job_category=$_POST['job_category'];
					$job_type=$_POST['job_type'];
					$job_salary=$_POST['job_salary'];
					$job_tags=$_POST['job_tags'];
					$job_exp=$_POST['job_exp'];
					$job_date=date("Y-m-d h:i:sa");
					$idb=$_GET['id'];
					
					mysqli_query($con,"UPDATE `post_job` SET `job_title`='$job_title',`job_location`='$job_location',`job_details`='$job_details',`job_category`='$job_category',`job_type`='$job_type',`job_exp`='$job_exp',`job_salary`='$job_salary',`job_tags`='$job_tags' WHERE id='$idb'");
					
					?>
					<script>
						alert("Successfully Updated");
					</script>
					<?php
					
					echo "<script type='text/javascript'>";
					echo "window.location='apppost'";
					echo "</script>";
				}
		  ?>
		  <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Company Unapproved Post Job</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
						<form Method="POST" enctype="multipart/form-data">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Title</label>
									<input type="text" name="job_title" value="<?php echo $rowc['job_title']; ?>" placeholder="Job Title" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Location</label>
									<input type="text" name="job_location" value="<?php echo $rowacitya['citynm']; ?>" placeholder="Job Location" class="form-control">
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Job Detials</label>
									<textarea name="job_details" class="cke-editor"><?php echo $rowc['job_details']; ?></textarea>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Category</label>
									<select class="questions-category form-control" name="job_category" required>
										<option value="0">All Categories</option>
										<?php 
										$r2 = mysqli_query($con,"SELECT * FROM `category`");
										while($row2 = mysqli_fetch_array($r2))
										{ ?>
										<option value="<?php echo $row2['category']; ?>" <?php if($rowc['job_category']==$row2['category']) echo "selected='selected'"; ?>><?php echo $row2['category']; ?></option>	
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Type</label>
									<select name="job_type" class="questions-category form-control">
										<option value="Full Time" <?php if($rowc['job_type']=="Full Time") echo "selected='selected'";?>>Full Time</option>
										<option value="Part Time" <?php if($rowc['job_type']=="Part Time") echo "selected='selected'";?>>Part Time</option>
										<option value="Remote" <?php if($rowc['job_type']=="Remote") echo "selected='selected'";?>>Remote</option>
										<option value="Freelancer" <?php if($rowc['job_type']=="Freelancer") echo "selected='selected'";?>>Freelancer</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Experience</label>
									<select name="job_exp" class="questions-category form-control">
										<option value="Fresher" <?php if($rowc['job_exp']=="Fresher") echo "selected='selected'";?>>Fresher</option>
										<option value="1 Year" <?php if($rowc['job_exp']=="1 Year") echo "selected='selected'";?>>1 Year</option>
										<option value="2 Year" <?php if($rowc['job_exp']=="2 Year") echo "selected='selected'";?>>2 Years</option>
										<option value="3 Year" <?php if($rowc['job_exp']=="3 Year") echo "selected='selected'";?>>3 Years</option>
										<option value="4 Year" <?php if($rowc['job_exp']=="4 Year") echo "selected='selected'";?>>4 Years</option>
										<option value="5 Year" <?php if($rowc['job_exp']=="5 Year") echo "selected='selected'";?>>5 Years</option>
										<option value="6+ Year" <?php if($rowc['job_exp']=="6+ Year") echo "selected='selected'";?>>6+ Years</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Expected Salary</label>
									<select name="job_salary" class="questions-category form-control">
										<option value="Less than 10,000" <?php if($rowc['job_salary']=="Full Time") echo "selected='selected'";?>>Less than 10,000</option>
										<option value="10,000 +" <?php if($rowc['job_salary']=="10,000 +") echo "selected='selected'";?>>10,000 +</option>
										<option value="20,000 +" <?php if($rowc['job_salary']=="20,000 +") echo "selected='selected'";?>>20,000 +</option>
										<option value="30,000 +" <?php if($rowc['job_salary']=="30,000 +") echo "selected='selected'";?>>30,000 +</option>
										<option value="40,000 +" <?php if($rowc['job_salary']=="40,000 +") echo "selected='selected'";?>>40,000 +</option>
										<option value="50,000 +" <?php if($rowc['job_salary']=="50,000 +") echo "selected='selected'";?>>50,000 +</option>
										<option value="100,000 +" <?php if($rowc['job_salary']=="100,000 +") echo "selected='selected'";?>>100,000 +</option>
										<option value="Negotiables" <?php if($rowc['job_salary']=="Negotiable") echo "selected='selected'";?>>Negotiable</option>
									</select>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Tags</label>
									<input type="text" name="job_tags" value="<?php echo $rowc['job_tags']; ?>" id="tags" value="software ,laravel, html" class="form-control" data-role="tagsinput">
								</div>
							</div>
							<div class="form-group" style="width: 100%;float: left;">
								<input type="submit" class="btn btn-success btn-square" id="inputName1" value="Update" name="submit" >
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  <?php } else { ?>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Company Approved Post Job </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Sr. #</th>
						<th>Post By</th>
						<th>Job Title</th>
						<th>Job Location</th>
						<th>Country</th>
						<th>Job Details</th>
						<th>Job Category</th>
						<th>Job Type</th>
						<th>Job Expire</th>
						<th>Job Salary</th>
						<th>Job Tags</th>
						<th>Post Date</th>
						<th>Post Expire Date</th>
						<th>Status</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					$no=0;
					$today=date('Y-m-d');
					
					$res=mysqli_query($con,"SELECT * FROM `post_job` WHERE ad_app='1' ORDER BY  `id` DESC");
					while($rowre=mysqli_fetch_array($res))
					{
						$no=$no+1;
						$job_edate=$rowre['job_edate'];
						
						$job_uida=$rowre['job_uid'];
						$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_uida'");
						$rowab=mysqli_fetch_array($selab);
						
						$countryid=$rowre['country'];
						$selacou=mysqli_query($con,"SELECT * FROM `country` WHERE id='$countryid'");
						$rowacou=mysqli_fetch_array($selacou);
						
						$cityipa=$rowre['job_location'];
						$selacity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cityipa'");
						$rowacity=mysqli_fetch_array($selacity);
					?>
						<tr>
							<th scope="row"><?php echo $no; ?></th>
								<td><a href="../company_details?id=<?php echo $rowab['comp_uid']; ?>" target="_blank"><?php echo $rowab['industry']; ?></a></td>
								<td><a href="../job_details?id=<?php echo $rowre['id']; ?>" target="_blank"><?php echo $rowre['job_title']; ?></a></td>
								<td><?php echo $rowacity['citynm']; ?></td>
								<td><?php echo $rowacou['countrynm']; ?></td>
								<td style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo $rowre['job_details']; ?></td>
								<td><?php echo $rowre['job_category']; ?></td>
								<td><?php echo $rowre['job_type']; ?></td>
								<td><?php echo $rowre['job_exp']; ?></td>
								<td><?php echo $rowre['currency']; ?> <?php echo $rowre['job_salary']; ?></td>
								<td><?php echo $rowre['job_tags']; ?></td>
								<td><?php echo $rowre['job_date']; ?></td>
								<td><?php echo $rowre['job_edate']; ?></td>
								<td>
								<?php 
								if($job_edate < $today)
								{ ?>
								<span class="btn btn-danger">Expire</span>
								<?php
								}
								else
								{ ?>
								<span class="btn btn-success">Active</span>
								<?php
								}
								?>
								</td>
							<td><a class="btn btn-danger" href="apppost?id=<?php echo $rowre['id']; ?>&edit=edit"> Edit </a>
							<a class="btn btn-danger" href="delete?id=<?php echo $rowre['id']; ?>&post=post"> Delete </a></td>
						</tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
		  <?php } ?>
		   <?php include('footer.php'); ?>