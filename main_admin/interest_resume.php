<?php include('header.php'); ?>

<?php

if($_REQUEST['approve'])
{
	
	
    ?>
    <script>
        alert("Successfully Approved");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='interest_resume'";
    echo "</script>";

}
?>
<style>
.btn 
{
	padding:8px 5px 8px 10px !important;}
</style>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>All Company Interested <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Company Interested</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Company Interested </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Company Name</th>
							<th>Interested In</th>
							<th>Date</th>
							<th>Action Company</th>
						    <th>Action Candidate</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$a=mysqli_query($con,"SELECT * FROM `interest` WHERE `us_type`='cm' ORDER BY `id` DESC");
						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							$us_id=$row['us_id'];
							$cm_id=$row['cm_id'];
							$aa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$cm_id'");
						    $rowa=mysqli_fetch_array($aa);
							
							$aaaa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$us_id'");
						    $rowaaa=mysqli_fetch_array($aaaa);
							
							$aaa=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$cm_id'");
						    $rowaa=mysqli_fetch_array($aaa);
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><a href="../company_details?id=<?php echo $rowaa['comp_uid']; ?>" target="_blank"><?php echo $rowaa['industry']; ?></a></td>
								<td><a href="../user_resume?id=<?php echo $rowaaa['id']; ?>" target="_blank"><?php echo $rowaaa['user']; ?></a></td>
								<td><?php echo $row['jct']; ?></td>
								<td><a  class="btn btn-danger" href="in_resume_mail_cm?id=<?php echo $row['id']; ?>">Send Company</a><span  class="btn btn-success"><?php echo $row['in_status_cm']; ?></span></td>
								<td><a  class="btn btn-danger" href="in_resume_mail_us?id=<?php echo $row['id']; ?>">Send Candidate</a><span  class="btn btn-success"><?php echo $row['in_status']; ?></span></td>
								</tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>