<?php include('header.php'); ?>

<?php

if($_REQUEST['deactive'])
{
    $id=$_GET['id'];
    
    mysqli_query($con,"UPDATE `admin_user` SET `ac_dac`='deactive' WHERE id='$id'");
	
    ?>
    <script>
        alert("Successfully Deactive");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='subadmin_list'";
    echo "</script>";

}

if($_REQUEST['active'])
{
    $id=$_GET['id'];

    mysqli_query($con,"UPDATE `admin_user` SET `ac_dac`='' WHERE id='$id'");
	
    ?>
    <script>
        alert("Successfully Active");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='subadmin_list'";
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
            <h2>All Subadmin <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Subadmin</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Subadmin </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Employe Id</th>
							<th>User Name</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>Join Date</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$a=mysqli_query($con,"SELECT * FROM `admin_user` WHERE admin_type='subadmin' ORDER BY  `id` DESC");

						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td>#<?php echo $row['emp_id']; ?></td>
								<td><?php echo $row['user']; ?></td>
								<td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['phone']; ?></td>
								<td><?php echo $row['jct']; ?></td>
								<td>
									<a class="btn btn-space btn-danger active" href="delete?id=<?php echo $row['id']; ?>&admin_user=admin_user" title="Delete user"><i class="fa fa-trash-o"></i></a>
									<?php
									if($row['ac_dac']=="")
									{
										?>
									<a href="subadmin_list?id=<?php echo $row['id']; ?>&deactive=deactive" class="btn btn-space btn-danger active" title="Deactive user"><i class="fa fa-ban"></i></a>
									<?php } else { ?>
									<a href="subadmin_list?id=<?php echo $row['id']; ?>&active=active" class="btn btn-space btn-success active" title="Active user"><i class="fa fa-check-circle"></i></a>
								<?php } ?>
								<a href="subadmin_edit?id=<?php echo $row['id']; ?>" class="btn btn-space btn-info active" title="Edit user"><i class="fa fa-pencil"></i></a>
								<a href="access?id=<?php echo $row['id']; ?>" class="btn btn-space btn-warning active" title="Access"><i class="fa fa-windows"></i></a>
								</td></tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>