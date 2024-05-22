<?php include('header.php'); ?>

<?php

if($_REQUEST['paid'])
{
    $id=$_GET['id'];
    
    mysqli_query($con,"UPDATE `user` SET `paid_user_ap`='1' WHERE id='$id'");
	
	$notifya= "your payment for paid user successfully approved by admin,now you are paid candidate";
	$typea="admin";
	$linka="paid_resume";

	$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$id','$id','$notifya','$typea','$linka')");
	
    ?>
    <script>
        alert("Successfully Approved");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='payment'";
    echo "</script>";

}

if($_REQUEST['approved'])
{
    $id=$_GET['id'];
    
    mysqli_query($con,"UPDATE `post_job` SET `app_status`='1' WHERE id='$id'");
	
	$aa=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$id'");
	$rowa=mysqli_fetch_array($aa);
	
	$notifya= "your payment for paid post(".$rowa['job_title'].") successfully approved by admin,now your post are paid";
	$typea="admin";
	$linka="company-dashboard-active-jobs";

	$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$id','$id','$notifya','$typea','$linka')");
	
    ?>
    <script>
        alert("Successfully Approved");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='payment'";
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
            <h2>All Payment <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Payment List</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Payment </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Payment By</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Payment Option</th>
							<th>Payment By</th>
							<th>Post Title</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$today=date('Y-m-d');
						$a=mysqli_query($con,"SELECT * FROM `payment` ORDER BY  `id` DESC");

						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							$edate=$row['edate'];
							
							$cid=$row['user_id'];
							$aa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$cid'");
						    $rowa=mysqli_fetch_array($aa);
							
							$cida=$row['postid'];
							$aaa=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$cida'");
						    $rowaa=mysqli_fetch_array($aaa);
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td>
								<?php
								if($rowa['rtype']=='Employee')
								{ ?>
								  <a href="../user_resume?id=<?php echo $rowa['id']; ?>" target="_blank"><?php echo $rowa['user']; ?></a>
								<?php
								}
								else
								{
									$cid=$row['user_id'];
									$aacm=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$cid'");
									$rowacm=mysqli_fetch_array($aacm);
									?>
									<a href="../company_details?id=<?php echo $rowacm['comp_uid']; ?>" target="_blank"><?php echo $rowacm['industry']; ?></a>
									<?php
								}
								 ?>
								</td>
								<td><?php echo $row['sdate']; ?></td>
								<td><?php echo $row['edate']; ?></td>
								<td><?php echo $row['payoption']; ?></td>
								<td><?php echo $row['pay_by']; ?></td>
								<td><a href="../job_details?id=<?php echo $rowaa['id']; ?>" target="_blank"><?php echo $rowaa['job_title']; ?></a></td>
								<td>
								<?php 
								if($edate < $today)
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
								<td>
								<?php
								if($cida==0)
								{
								if($rowa['paid_user_ap']==1)
								{ ?>
								<span class="btn btn-space btn-info active"  title="Paid"><i class="fa fa-heart"></i> Approved</span>
								<?php } else { ?>
								<a class="btn btn-space btn-danger active" href="payment?id=<?php echo $rowa['id']; ?>&paid=paid" title="Paid"><i class="fa fa-heart"></i> Approve</a>
								<?php } } else { 
								if($rowaa['app_status']==1)
								{ ?>
								<span class="btn btn-space btn-info active"  title="Paid"><i class="fa fa-heart"></i> Approved</span>
								<?php } else { ?>
								<a class="btn btn-space btn-danger active" href="payment?id=<?php echo $rowaa['id']; ?>&approved=approved" title="Paid"><i class="fa fa-heart"></i> Approve</a>
								<?php } }?>
								</td>
								</tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>