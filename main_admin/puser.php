<?php include('header.php'); ?>
<style>
.btn 
{
	padding:8px 5px 8px 10px !important;}
</style>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>All Paid Candidate <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Paid Candidate</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Paid Candidate </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Candidate User Name</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Phone No</th>
							<th>City</th>
							<th>Education</th>
							<th>Join Date</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$a=mysqli_query($con,"SELECT * FROM `user` WHERE paid_user='1' AND  paid_user_ap='1' ORDER BY `id` DESC");

						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							$cid=$row['city'];
							$aa=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cid'");
						    $rowa=mysqli_fetch_array($aa);
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><a href="../user_resume?id=<?php echo $row['id']; ?>" target="_blank"><?php echo $row['user']; ?></a></td>
								<td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['phone']; ?></td>
								<td><?php echo $rowa['citynm']; ?></td>
								<td><?php echo $row['last_edu']; ?></td>
								<td><?php echo $row['jct']; ?></td>
								</tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>