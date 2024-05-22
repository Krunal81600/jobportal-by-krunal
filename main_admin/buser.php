<?php include('header.php'); ?>

<?php

if($_REQUEST['deactive'])
{
    $id=$_GET['id'];
    
    mysqli_query($con,"UPDATE `user` SET `ac_dac`='deactive' WHERE id='$id'");
	
    ?>
    <script>
        alert("Successfully Deactive");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='user'";
    echo "</script>";

}

if($_REQUEST['active'])
{
    $id=$_GET['id'];

    mysqli_query($con,"UPDATE `user` SET `ac_dac`='' WHERE id='$id'");
	
    ?>
    <script>
        alert("Successfully Active");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='user'";
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
            <h2>All Block Candidate <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Block Candidate</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Block Candidate </strong> List</h3>
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
							<th>Country</th>
							<th>Education</th>
							<th>Join Date</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$a=mysqli_query($con,"SELECT * FROM `user` WHERE rtype='Employee' AND ac_dac='deactive' ORDER BY  `id` DESC");

						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							$cid=$row['city'];
							$country=$row['country'];
							$aa=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cid'");
						    $rowa=mysqli_fetch_array($aa);
							
							$aaa=mysqli_query($con,"SELECT * FROM `country` WHERE id='$country'");
						    $rowaa=mysqli_fetch_array($aaa);
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><a href="../user_resume?id=<?php echo $row['id']; ?>" target="_blank"><?php echo $row['user']; ?></a></td>
								<td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['phone']; ?></td>
								<td><?php echo $rowa['citynm']; ?></td>
								<td><?php echo $rowaa['countrynm']; ?></td>
								<td><?php echo $row['last_edu']; ?></td>
								<td><?php echo $row['jct']; ?></td>
								<td><a class="btn btn-space btn-primary active" href="view?id=<?php echo $row['id']; ?>" title="View Profile"><i class="fa fa-heart"></i></a>
									<a class="btn btn-space btn-danger active" href="delete?id=<?php echo $row['id']; ?>&user=user" title="Delete user"><i class="fa fa-trash-o"></i></a>
									<?php
									if($row['ac_dac']=="")
									{
										?>
										<a href="user?id=<?php echo $row['id']; ?>&deactive=deactive" class="btn btn-space btn-danger active" title="Deactive user"><i class="fa fa-ban"></i></a>
									<?php } else { ?>
									<a href="user?id=<?php echo $row['id']; ?>&active=active" class="btn btn-space btn-success active" title="Active user"><i class="fa fa-check-circle"></i></a>
								<?php } ?>

								</td></tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>