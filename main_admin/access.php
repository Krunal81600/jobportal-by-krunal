<?php include('header.php'); 

$subadmin_id=$_GET['id'];
$sub=mysqli_query($con,"SELECT * FROM `access` WHERE subadmin_id='$subadmin_id'");
$row=mysqli_fetch_array($sub);

if(isset($_POST['submit']))
{
	$subadmin_id=$_GET['id'];
    $can_list=$_POST['can_list'];
    $bcan_list=$_POST['bcan_list'];
    $comp_list=$_POST['comp_list'];
    $bcomp_list=$_POST['bcomp_list'];
    $ucomp_list=$_POST['ucomp_list'];
    $pcan_list=$_POST['pcan_list'];
    $upcan_list=$_POST['upcan_list'];
    $app_can_list=$_POST['app_can_list'];
    $foll_can_list=$_POST['foll_can_list'];
    $add_post=$_POST['add_post'];
    $app_post=$_POST['app_post'];
    $unapp_post=$_POST['unapp_post'];
    $location=$_POST['location'];
    $payment=$_POST['payment'];
    $ad=$_POST['ad'];
    $category=$_POST['category'];
    $in_in_can=$_POST['in_in_can'];
    $in_in_comp=$_POST['in_in_comp'];
    $make_resume=$_POST['make_resume'];
    $hire=$_POST['hire'];
    
	$r=mysqli_query($con,"UPDATE `access` SET `can_list`='$can_list',`bcan_list`='$bcan_list',`comp_list`='$comp_list',`bcomp_list`='$bcomp_list',`ucomp_list`='$ucomp_list',`pcan_list`='$pcan_list',`upcan_list`='$upcan_list',`app_can_list`='$app_can_list',`foll_can_list`='$foll_can_list',`add_post`='$add_post',`app_post`='$app_post',`unapp_post`='$unapp_post',`location`='$location',`payment`='$payment',`ad`='$ad',`category`='$category',`in_in_can`='$in_in_can',`in_in_comp`='$in_in_comp',`hire`='$hire',`make_resume`='$make_resume' WHERE subadmin_id='$subadmin_id'");	
	$subadmin_id=mysqli_insert_id($con);
	
	
	if($r){ echo'<script type="text/javascript">alert("Successfully Updated..")</script>'; 

         echo "<script type='text/javascript'>";
	echo "window.location='subadmin_list'";
	echo "</script>";

        }
	else
	{
		?>
		<script>
			alert("Something Wrong");
		</script>
		<?php
	}
}
?>
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Update Subadmin<strong>Access</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Update Subadmin Access</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Update Subadmin</strong> Access</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <form method="POST" enctype="multipart/form-data">
					   <div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Candidate List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="can_list" id="radio1" value="0" <?php if($row['can_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="can_list" id="radio2" value="1" <?php if($row['can_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Block Candidate List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="bcan_list" id="radio1" value="0" <?php if($row['bcan_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="bcan_list" id="radio2" value="1" <?php if($row['bcan_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Company List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="comp_list" id="radio1" value="0" <?php if($row['comp_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="comp_list" id="radio2" value="1" <?php if($row['comp_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Block Company List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="bcomp_list" id="radio1" value="0" <?php if($row['bcomp_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="bcomp_list" id="radio2" value="1" <?php if($row['bcomp_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Unapprove Company List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="ucomp_list" id="radio1" value="0" <?php if($row['ucomp_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="ucomp_list" id="radio2" value="1" <?php if($row['ucomp_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Paid Candidate List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="pcan_list" id="radio1" value="0" <?php if($row['pcan_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="pcan_list" id="radio2" value="1" <?php if($row['pcan_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Unpaid Candidate List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="upcan_list" id="radio1" value="0" <?php if($row['upcan_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="upcan_list" id="radio2" value="1" <?php if($row['upcan_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Applied By Candidate List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="app_can_list" id="radio1" value="0" <?php if($row['app_can_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="app_can_list" id="radio2" value="1" <?php if($row['app_can_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Follow By Candidate List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="foll_can_list" id="radio1" value="0" <?php if($row['foll_can_list']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="foll_can_list" id="radio2" value="1" <?php if($row['foll_can_list']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Add Post</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="add_post" id="radio1" value="0" <?php if($row['add_post']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="add_post" id="radio2" value="1" <?php if($row['add_post']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Approve Post Job List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="app_post" id="radio1" value="0" <?php if($row['app_post']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="app_post" id="radio2" value="1" <?php if($row['app_post']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Unapprove Post Job List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="unapp_post" id="radio1" value="0" <?php if($row['unapp_post']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="unapp_post" id="radio2" value="1" <?php if($row['unapp_post']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Location</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="location" id="radio1" value="0" <?php if($row['location']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="location" id="radio2" value="1" <?php if($row['location']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Payment</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="payment" id="radio1" value="0" <?php if($row['payment']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="payment" id="radio2" value="1" <?php if($row['payment']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Create Ad List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="ad" id="radio1" value="0" <?php if($row['ad']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="ad" id="radio2" value="1" <?php if($row['ad']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Category List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="category" id="radio1" value="0" <?php if($row['category']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="category" id="radio2" value="1" <?php if($row['category']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Interest in Candidate</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="in_in_can" id="radio1" value="0" <?php if($row['in_in_can']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="in_in_can" id="radio2" value="1" <?php if($row['in_in_can']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Interest in Company</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="in_in_comp" id="radio1" value="0" <?php if($row['in_in_comp']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="in_in_comp" id="radio2" value="1" <?php if($row['in_in_comp']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Hired By Company List</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="hire" id="radio1" value="0" <?php if($row['hire']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="hire" id="radio2" value="1" <?php if($row['hire']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Request Make Resume</label>
								<div class="radio-list">
									<label class="radio-inline p-0">
										<div class="radio radio-info">
											<input type="radio" name="make_resume" id="radio1" value="0" <?php if($row['make_resume']==0) echo "checked='checked'";?>>
											<label for="radio1">Yes</label>
										</div>
									</label>
									<label class="radio-inline">
										<div class="radio radio-info">
											<input type="radio" name="make_resume" id="radio2" value="1" <?php if($row['make_resume']==1) echo "checked='checked'";?>>
											<label for="radio2">No </label>
										</div>
									</label>
								</div>
							</div>
						</div>
							<div class="loginbox-submit">
								<input type="submit" name="submit" class="btn btn-primary" value="Access">
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

		   <?php include('footer.php'); ?>