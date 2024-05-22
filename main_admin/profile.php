<?php
include('header.php');
$id=$_SESSION['id'];
$sql = mysqli_query($con,"SELECT * FROM `admin_user` WHERE id='$id'");
$row=mysqli_fetch_array($sql);

if(isset($_POST['Update_profile']))
{
	$id=$_SESSION['id'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$user=$_POST['user'];
	$email=$_POST['email'];
		
	 $query = mysqli_query($con,"UPDATE `admin_user` SET `user`='$user',`email`='$email',`fname`='$fname',`lname`='$lname' where id='$id'");
		 ?>
		<script>
			alert("Successfully Changed");
	</script>
   <?php
		 echo "<script type='text/javascript'>";
			echo "window.location='profile'";
			echo "</script>";
		
		}
		
if(isset($_POST['Update_image']))
{
 if($_FILES['img']['tmp_name'])
		{
			$id=$_SESSION['id'];
			$file=$_FILES['img']['name'];
			$type=$_FILES['img']['type'];
			$size=$_FILES['img']['size'];
			$temp=$_FILES['img']['tmp_name'];
			$RandomNo = mt_rand(1, 99999);
			$nam='img'.$RandomNo.$file;
			$lfile=str_replace(' ','_',$nam);
		
			 move_uploaded_file($temp,"images/".$lfile);
			 $save="img/".$lfile;
			
		}
	else 
		{
			$lfile=$row['img'];
		}
		
	     $query = mysqli_query($con,"UPDATE `admin_user` SET `img`='$lfile' where id='$id'");
		 ?>
		<script>
			alert("Successfully Changed");
	</script>
   <?php
		 echo "<script type='text/javascript'>";
			echo "window.location='profile'";
			echo "</script>";
		
		}
		

if(isset($_POST['change_pwd']))

{
	$select=mysqli_query($con,"SELECT * FROM `admin_user` where id='$id'");
    $row=mysqli_fetch_array($select);
	
	$id=$_SESSION['id'];
   $new_password=$_POST['new_password'];
   $cnew_password=$_POST['cnew_password'];
	$mdpassword=md5($new_password);
	$password=$_POST['password'];
	
	if($row['password']==md5($password))
	{
		if($new_password=$cnew_password)
		{
	    $query = mysqli_query($con,"UPDATE `admin_user` SET `password`='$mdpassword' where id='$id' ");
	
		?>
		<script>
			alert("Successfully Changed");
		</script>
	   <?php
			
		echo "<script type='text/javascript'>";
		echo "window.location='profile'";
		echo "</script>";
		}
	else
	{
		?>
		<script>
			alert("Password And Confirm Password Not Match...");
	</script>
   <?php
		
    echo "<script type='text/javascript'>";
	echo "window.location='profile'";
	echo "</script>";
	}
	}
	else
	{ ?>
	<script>
			alert("Wrong Old Password");
	</script>
	<?php	}
}
?>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-app page-profil">
          <div class="col-md-12">
            <div class="profil-content">
              <div class="row">
				<div class="col-md-4">
					<div class="profil-sidebar-element" style="width: 100%;float: left;background: #fff;">
					  <h3 style="text-align: center;"><strong>ABOUT ME</strong></h3>
						<div class="col-md-12 profil-img">
							<img src="images/<?php echo $row['img']; ?>" alt="profil" style="width:100%;height:100%;">
						  </div>
						<div class="name" style="font-family: 'Lato', arial, sans-serif;font-weight: 900;font-size: 20px;padding-bottom: 8px;width: 100%;float: left;text-align: center;margin-top: 12px;"><?php echo $row['user']; ?> <i class="fa fa-check-circle"></i></div>
						<div class="profil-info" style="color: #A4A4A4;float: left;font-family: 'Lato';font-size: 16px;padding-right: 20px;text-align: center;margin-top: 12px;width: 100%;float: left;"><i class="fa fa-envelope"></i><?php echo $row['email']; ?></div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel">
                    <div class="panel-header panel-controls">
                      <h3>Update  <strong>Profile</strong></h3>
                    </div>
                    <div class="panel-content">
                      <ul class="nav nav-tabs nav-primary">
                        <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-home"></i> Update Info</a></li>
                        <li ><a href="#tab2_2" data-toggle="tab"><i class="icon-user"></i>Update Image</a></li>
                        <li><a href="#tab2_3" data-toggle="tab"><i class="icon-cloud-download"></i> Change Password</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade  active in" id="tab2_1">
                          <div class="row">
                            <form method="POST">
								<div class="form-group">
									<label for="inputName1" class="control-label">First Name</label>
									<input type="text" class="form-control" id="inputName1" name="fname" placeholder="Enter First Name" value="<?php echo $row['fname']; ?>" required>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Last Name</label>
									<input type="text" class="form-control" id="inputName1" name="lname"  placeholder="Enter Last Name" value="<?php echo $row['lname']; ?>" required>
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Email</label>
									<input type="email" class="form-control" id="inputEmail" name="email"  placeholder="Email" data-error="Bruh, that email address is invalid"
										value="<?php echo $row['email']; ?>"
									   >
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">User Name</label>
									<input type="text" class="form-control" id="inputName1" value="<?php echo $row['user']; ?>" name="user"  placeholder="Enter User Name" >
								</div>
								<div class="form-group">
									<button type="submit" name="Update_profile" class="btn btn-primary">Submit</button>
								</div>
							</form>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="tab2_2">
                           <form method="POST" enctype="multipart/form-data">
								<div class="row column-seperation">
								<div class="form-group">
									<div class="col-md-6">
									<div class="form-group">
										<h3 class="box-title">Update Profile Image</h3>
										<input type="file" name="img" id="input-file-now-custom-1" class="dropify"/>
									</div>
									<div class="form-group">
										<button type="submit" name="Update_image" class="btn btn-primary">Submit</button>
									</div>
									</div>
									<div class="col-md-6">
									<h3 class="box-title">Update Profile Image</h3>
									<img src="images/<?php echo $row['img']; ?>" alt="Profile" class="thumbnail" height="150" width="150"/>
									</div>
								</div>
								</div>
							</form>
                        </div>
                        <div class="tab-pane fade" id="tab2_3">
							<form method="POST">
								<div class="form-group">
									<label for="inputName1" class="control-label">Old Password</label>
									<input type="password" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassworda" name="password" placeholder="Password" required>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">New Password</label>
									<input type="password" data-toggle="validator" data-minlength="6" name="new_password" class="form-control" id="inputPassword" placeholder="Password" required>
									<span class="help-block">Minimum of 6 characters</span>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Confirm Password</label>
									<input type="password" class="form-control" name="cnew_password" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<button type="submit" name="change_pwd" class="btn btn-primary">Submit</button>
								</div>
							</form>
                        </div>
                      </div>
                    </div>
                  </div>
				</div>
              </div>
            </div>
          </div>

		  <?php include('footer.php'); ?>