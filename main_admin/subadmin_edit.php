<?php include('header.php'); 
$id=$_GET['id'];
$a=mysqli_query($con,"SELECT * FROM `admin_user` WHERE id='$id'");
$rowe=mysqli_fetch_array($a);

if(isset($_POST['submit']))
{
    $user=$_POST['user'];
    $email=$_POST['email'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phone=$_POST['phone'];
    $id=$_GET['id'];
	
	$r=mysqli_query($con,"UPDATE `admin_user` SET `email`='$email',`user`='$user',`fname`='$fname',`lname`='$lname',`phone`='$phone' WHERE id='$id'");	
	
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
if(isset($_POST['change']))
{
    $password=$_POST['password'];
    $id=$_GET['id'];
	
	$r=mysqli_query($con,"UPDATE `admin_user` SET `password`='$password' WHERE id='$id'");	
	
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
            <h2>Edit Subadmin <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Edit Subadmin</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Edit Subadmin</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Firstname: <span class="required">*</span></label>
								<input placeholder="User Name" value="<?php echo $rowe['fname']; ?>" name="fname" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Lastname: <span class="required">*</span></label>
								<input placeholder="User Name" name="lname" value="<?php echo $rowe['lname']; ?>" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Username: <span class="required">*</span></label>
								<input placeholder="User Name" name="user" value="<?php echo $rowe['user']; ?>" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Email: <span class="required">*</span></label>
								<input placeholder="Email Id" name="email" value="<?php echo $rowe['email']; ?>" class="form-control" type="email" required>
								<p id="email_status" style="text-align:left;color:red;"></p>
							</div>
							<div class="form-group">
								<label>Phone Number: <span class="required">*</span></label>
								<input placeholder="Phone Number" name="phone" value="<?php echo $rowe['phone']; ?>" class="form-control" type="text" required>
								<p id="email_status" style="text-align:left;color:red;"></p>
							</div>
							<div class="loginbox-submit">
								<input type="submit" name="submit" class="btn btn-primary" value="Update">
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		<div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Change Password</strong></h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>New Password: <span class="required">*</span></label>
								<input placeholder="New Password" name="password" class="form-control" type="text" required>
							</div>
							<div class="loginbox-submit">
								<input type="submit" name="change" class="btn btn-primary" value="Change">
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		   <?php include('footer.php'); ?>