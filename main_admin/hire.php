<?php include('header.php'); ?>

<style>
.btn 
{
	padding:8px 5px 8px 10px !important;}
</style>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>All Hire Candidate <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Hire Candidate</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Hire Candidate </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Hired By</th>
							<th>Hired To</th>
							<th>Date</th>
							<th>Action Company</th>
						    <th>Action Candidate</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$a=mysqli_query($con,"SELECT * FROM `hire` ORDER BY `id` DESC");
						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							$hire_uid=$row['hire_uid'];
							$hire_compid=$row['hire_compid'];

							$aa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$hire_uid'");
						    $rowa=mysqli_fetch_array($aa);
							
							$aaa=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$hire_compid'");
						    $rowaa=mysqli_fetch_array($aaa);
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><a href="../company_details?id=<?php echo $rowaa['comp_uid']; ?>" target="_blank"><?php echo $rowaa['industry']; ?></a></td>
								<td><a href="../user_resume?id=<?php echo $rowa['id']; ?>" target="_blank"><?php echo $rowa['user']; ?></a></td>
								<td><?php echo $row['hdate']; ?></td>
								<td><a  class="btn btn-danger" href="hire_mail_cm?id=<?php echo $row['id']; ?>">Send Company</a><span  class="btn btn-success"><?php echo $row['hire_status_cm']; ?></span></td>
								<td><a  class="btn btn-danger" href="hire_mail_us?id=<?php echo $row['id']; ?>">Send Candidate</a><span  class="btn btn-success"><?php echo $row['hire_status']; ?></span></td>
								</tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>