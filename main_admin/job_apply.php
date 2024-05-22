<?php include('header.php'); 
error_reporting(0);
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Applied By Candidate Post <strong>Job</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Applied By Candidate Post Job</li>
              </ol>
            </div>
          </div>

          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Applied By Candidate Post Job </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Sr. #</th>
						<th>Apply By</th>
						<th>Post By</th>
						<th>Job Title</th>
						<th>Job Location</th>
						<th>Job Category</th>
						<th>Job Expire</th>
						<th>Job Salary</th>
						<th>Job Tags</th>
						<th>Post Date</th>
						<th>Action Company</th>
						<th>Action Candidate</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					$no=0;
					$id=$_GET['id'];
					if($id)
					{
					$resapp=mysqli_query($con,"SELECT * FROM `job_app` WHERE job_app_uid='$id' ORDER BY  `id` DESC");
					}
					else
					{
					$resapp=mysqli_query($con,"SELECT * FROM `job_app` ORDER BY  `id` DESC");
					}
					while($rowapp=mysqli_fetch_array($resapp))
					{
						$no=$no+1;
						$job_app_uid=$rowapp['job_app_uid'];
						$job_app_compid=$rowapp['job_app_compid'];
						$job_app_post=$rowapp['job_app_post'];
						$success_send=$rowapp['success_send'];
						
						$res=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$job_app_post' ");
					    $rowre=mysqli_fetch_array($res);
						$job_location=$rowre['job_location'];
						
						$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_app_compid'");
						$rowab=mysqli_fetch_array($selab);
						
						$selabc=mysqli_query($con,"SELECT * FROM `user` WHERE id='$job_app_uid'");
						$rowabc=mysqli_fetch_array($selabc);
						
						$selabcd=mysqli_query($con,"SELECT * FROM `city` WHERE id='$job_location'");
						$rowabcd=mysqli_fetch_array($selabcd);
					?>
						<tr>
							<th scope="row"><?php echo $no; ?></th>
								<td><a href="../user_resume?id=<?php echo $rowabc['id']; ?>" target="_blank"><?php echo $rowabc['user']; ?></a></td>
								<td><a href="../company_details?id=<?php echo $rowab['comp_uid']; ?>" target="_blank"><?php echo $rowab['industry']; ?></td>
								<td><?php echo $rowre['job_title']; ?></a></td>
								<td><?php echo $rowabcd['citynm']; ?></td>
								<td><?php echo $rowre['job_category']; ?></td>
								<td><?php echo $rowre['job_edate']; ?></td>
								<td><?php echo $rowre['job_salary']; ?></td>
								<td><?php echo $rowre['job_tags']; ?></td>
								<td><?php echo $rowre['job_date']; ?></td>
								<td><a  class="btn btn-danger" href="mail_cm?id=<?php echo $rowapp['id']; ?>">Send Company</a><span  class="btn btn-success"><?php echo $rowapp['success_send_cm']; ?></span></td>
								<td><a  class="btn btn-danger" href="mail_us?id=<?php echo $rowapp['id']; ?>">Send Candidate</a><span  class="btn btn-success"><?php echo $rowapp['success_send']; ?></span></td>
						</tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
		   <?php include('footer.php'); ?>