<?php include('header.php'); ?>

<?php

if($_REQUEST['approved'])
{
    $id=$_GET['id'];
    
    mysqli_query($con,"UPDATE `make_resume` SET `app_mk`='1' WHERE id='$id'");
	

	$notifya= "your payment for make professional resume successfully approved by admin";
	$typea="admin";
	$linka="build-resume";

	$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$id','$id','$notifya','$typea','$linka')");
	
    ?>
    <script>
        alert("Successfully Approved");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='make_resume'";
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
            <h2>Make Resume Payment <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Make Resume Payment List</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Make Resume Payment </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Payment By</th>
							<th>Request Date</th>
							<th>Action</th>
							<th>Send</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$today=date('Y-m-d');
						$a=mysqli_query($con,"SELECT * FROM `make_resume` ORDER BY  `id` DESC");

						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							
							$cid=$row['user_id'];
							$aa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$cid'");
						    $rowa=mysqli_fetch_array($aa);
							
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td>
								  <a href="../user_resume?id=<?php echo $rowa['id']; ?>" target="_blank"><?php echo $rowa['user']; ?></a>
								</td>
								<td><?php echo $row['jdate']; ?></td>
								<td>
								<?php
								if($row['app_mk']==1)
								{ ?>
								<span class="btn btn-space btn-info active"  title="Paid"><i class="fa fa-heart"></i> Approved</span>
								<?php } else { ?>
								<a class="btn btn-space btn-danger active" href="make_resume?id=<?php echo $row['id']; ?>&approved=approved" title="Paid"><i class="fa fa-heart"></i> Approve</a>
								<?php } ?>
								</td>
								<td>
								<?php
								if($row['send_mail']==1)
								{ ?>
								<a href="resume_send?id=<?php echo $row['id']; ?>" class="btn btn-space btn-success active"  title="Paid"><i class="fa fa-heart"></i> Send </a>
								<?php } else { ?>
								<a class="btn btn-space btn-danger active" href="resume_send?id=<?php echo $row['id']; ?>" title="Paid"><i class="fa fa-heart"></i> Send Mail</a>
								<?php } ?>
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