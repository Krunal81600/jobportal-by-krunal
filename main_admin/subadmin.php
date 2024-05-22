<?php include('header.php'); 

if(isset($_POST['submit']))
{
    $user=$_POST['user'];
    $email=$_POST['email'];
    $mdpassword=md5($_POST['password']);
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phone=$_POST['phone'];
    $admin_type='subadmin';
    $jct=date("Y-m-d h:i:sa");
    
	$csub=mysqli_query($con,"SELECT * FROM `admin_user` WHERE admin_type='subadmin' ORDER BY id DESC");
	$count=mysqli_num_rows($csub);
	if($count > 0)
	{
		$rowe=mysqli_fetch_array($csub);
		
		$emp_id=$rowe['emp_id'];
		$new_emp_id=$emp_id+0000001;
	}
	else
	{
		$new_emp_id='0000001';
	}
	
	$r=mysqli_query($con,"INSERT INTO `admin_user`(`email`, `user`, `fname`, `lname`, `phone`, `password`, `admin_type`, `emp_id`, `jct`) VALUES ('$email','$user','$fname','$lname','$phone','$mdpassword','$admin_type','$new_emp_id','$jct')");	
	$subadmin_id=mysqli_insert_id($con);
	
	$r=mysqli_query($con,"INSERT INTO `access`(`subadmin_id`) VALUES ('$subadmin_id')");
	
	if($r){ echo'<script type="text/javascript">alert("Successfully Inserted..")</script>'; 
        
        echo "<script type='text/javascript'>";
	echo "window.location='access?id=$subadmin_id'";
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
            <h2>Add Subadmin <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Add Subadmin</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Add Subadmin</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Firstname: <span class="required">*</span></label>
								<input placeholder="User Name" name="fname" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Lastname: <span class="required">*</span></label>
								<input placeholder="User Name" name="lname" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Username: <span class="required">*</span></label>
								<input placeholder="User Name" name="user" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Email: <span class="required">*</span></label>
								<input placeholder="Email Id" name="email" class="form-control" type="email" required>
								<p id="email_status" style="text-align:left;color:red;"></p>
							</div>
							<div class="form-group">
								<label>Phone Number: <span class="required">*</span></label>
								<input placeholder="Phone Number" name="phone" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Password: <span class="required">*</span></label>
								<input placeholder="Password" pattern=".{6,}" title="Six or more characters" id="txtNewPassword" name="password" class="form-control" type="password" required>
							</div>
							<div class="form-group">
								<label>Confirm Password: <span class="required">*</span></label>
								<input placeholder="Confirm Password" id="txtConfirmPassword" onkeyup="checkPasswordMatch();" name="password2" class="form-control" type="password" required>
								<p id="divCheckPasswordMatch" style="text-align:left;color:red;"></p>
							</div>
							<div class="loginbox-submit">
								<input type="submit" name="submit" class="btn btn-primary" value="Add">
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  <script type="text/javascript">
	function checkPasswordMatch() {
		var password = $("#txtNewPassword").val();
		var confirmPassword = $("#txtConfirmPassword").val();

		if (password != confirmPassword)
			$("#divCheckPasswordMatch").html("Passwords do not match!");
		else
			$("#divCheckPasswordMatch").html("Passwords match.");
	}
</script>    
		   <?php include('footer.php'); ?>