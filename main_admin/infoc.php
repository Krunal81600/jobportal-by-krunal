<?php include('header.php'); 

$session_id=$_GET['id'];
$sel=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$session_id'");
$row=mysqli_fetch_array($sel);

$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$rowa=mysqli_fetch_array($sela);

$selab=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowsl=mysqli_fetch_array($selab);

if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$industry=$_POST['industry'];
    $bussiness_type=$_POST['bussiness_type'];
    $comp_established=$_POST['comp_established'];
    $no_emp=$_POST['no_emp'];
    $comp_phone=$_POST['comp_phone'];
    $comp_located=$_POST['comp_located'];
    $comp_address=$_POST['comp_address'];
    $comp_about=$_POST['comp_about'];
    $session_id=$_GET['id'];
	$comp_website=$_POST['comp_website'];
	
	$error = array();
	$accepteble = array
	(
		'image/jpg',
		'image/jpeg',
		'image/png'
	);
	if($_FILES['comp_logo']['name'])
	{
	$img = $_FILES['comp_logo']['name'];
	$tmp = $_FILES['comp_logo']['tmp_name'];
	$size = $_FILES['comp_logo']['size'];
	$type = $_FILES['comp_logo']['type'];
	
	if($size >= 2097152 || ($size == 0))
	{
		$error[] = "Logo Image too large. File must be less than 2 megabytes.$size";
	}
	if(!in_array($type,$accepteble) && (!empty($type)))
	{
		$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
	}
	
	$rnd = mt_rand(1,99999);
	$fnm = "img". $rnd . $img;
	$lfile = str_replace(' ','_',$fnm);
	$r = move_uploaded_file($tmp,'../upload/'.$lfile);
	
	}
	else
	{
		$lfile=$row['comp_logo'];
	}
	
	if($_FILES['comp_profile']['name'])
	{
	$imga = $_FILES['comp_profile']['name'];
	$tmpa = $_FILES['comp_profile']['tmp_name'];
	$sizea = $_FILES['comp_profile']['size'];
	$typea = $_FILES['comp_profile']['type'];
	
	if($sizea >= 2097152 || ($sizea == 0))
	{
		$error[] = "Profile Image too large. File must be less than 2 megabytes.";
	}
	if(!in_array($typea,$accepteble) && (!empty($typea)))
	{
		$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
	}
	
	$rnda = mt_rand(1,99999);
	$fnma = "img". $rnda . $imga;
	$lfilea = str_replace(' ','_',$fnma);
	$r = move_uploaded_file($tmp,'../upload/'.$lfilea);
	
	}
	else
	{
		$lfilea=$row['comp_profile'];
	}
	
	if(count($error) == 0)
	{
		
		mysqli_query($con,"UPDATE `company` SET `industry`='$industry',`bussiness_type`='$bussiness_type',`comp_established`='$comp_established',`no_emp`='$no_emp',`comp_logo`='$lfile',`comp_profile`='$lfilea',`comp_phone`='$comp_phone',`comp_located`='$comp_located',`comp_address`='$comp_address',`comp_about`='$comp_about',`comp_email`='$email',`comp_website`='$comp_website' WHERE comp_uid='$session_id'");
		
		mysqli_query($con,"UPDATE `user` SET `fname`='$fname',`lname`='$lname',`phone`='$phone' WHERE id='$session_id'");
		
		?>
		<script>
			alert('Successfully Updated');
		</script>
		<?php
		echo "<script type='text/javascript'>";
		echo "window.location='infoc?id=$session_id'";
		echo "</script>";
	}
	else
	{
		foreach($error as $err)
		{
			echo '<script>alert("'.$err.'");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'infoc?id=$session_id'";
			echo"</script>";
		}
		die();
	}
	 
}
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Update Company <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="viewc?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Update Company</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Update Company</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form method="POST" enctype="multipart/form-data">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Employer First Name: <span class="required">*</span></label>
								<input type="text" name="fname" placeholder="Employer First Name" class="form-control" value="<?php echo $rowa['fname']; ?>" required>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Employer Last Name: <span class="required">*</span></label>
								<input type="text" name="lname" placeholder="Employer Last Name" value="<?php echo $rowa['lname']; ?>" class="form-control" required>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Employer User Name: <span class="required">*</span></label>
								<input type="text" value="<?php echo $rowa['user']; ?>" name="user"  placeholder="Employer User Name " class="form-control" required readonly>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Email ID: <span class="required">*</span></label>
								<input type="text" name="email" placeholder="Email ID" class="form-control" value="<?php echo $rowa['email']; ?>" required readonly>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Employer Phone No: <span class="required">*</span></label>
								<input type="text" name="phone" placeholder="Employer Phone No" value="<?php echo $rowa['phone']; ?>" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Industry: <span class="required">*</span></label>
								<input type="text" name="industry" placeholder="Industry" class="form-control" value="<?php echo $row['industry']; ?>" required>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Type of Business Entity <span class="required">*</span></label>
								<input type="text" name="bussiness_type" placeholder="Type of Business Entity " value="<?php echo $row['bussiness_type']; ?>" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Established In: <span class="required">*</span></label>
								<input type="text" value="<?php echo $row['comp_established']; ?>" name="comp_established" placeholder="Established In" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>No. of Employees <span class="required">*</span></label>
								<input type="text" value="<?php echo $row['no_emp']; ?>" name="no_emp" placeholder="No. of Employees" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Company Phone No: <span class="required">*</span></label>
								<input type="text" value="<?php echo $row['comp_phone']; ?>" name="comp_phone" placeholder="Phone" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Company Located In: <span class="required">*</span></label>
								<input type="text" value="<?php echo $row['comp_located']; ?>" name="comp_located" placeholder="Located" class="form-control" required>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Company Address <span class="required">*</span></label>
								<input type="text" value="<?php echo $row['comp_address']; ?>" name="comp_address"  placeholder="Located" class="form-control" required>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Company Website : <span class="required">*</span></label>
								<input type="text" value="<?php echo $row['comp_website']; ?>" name="comp_website"  placeholder="Company Website " class="form-control" required>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>About Company <span class="required">*</span></label>
								<textarea cols="6" rows="8" name="comp_about" placeholder="About Company" class="form-control" required><?php echo $row['comp_about']; ?></textarea>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<div class="white-box">
							<div class="col-md-8">
							<label for="inputName1" class="control-label">Company Logo</label>
							<input type="file" name="comp_logo" id="input-file-now-custom-1" class="form-control" />
							</div>
							<div class="col-md-4">
								<img src="../upload/<?php echo $row['comp_logo'] ?>" class="thumbnail" alt="Profile" height="100" width="100">
							</div>
							</div>
						</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<div class="white-box">
								<div class="col-md-8">
								<label for="inputName1" class="control-label">Profile Image</label>
								<input type="file" name="comp_profile" id="input-file-now-custom-1" class="form-control" />
								</div>
								<div class="col-md-4">
									<img src="../upload/<?php echo $row['comp_profile'] ?>" class="thumbnail" alt="Profile" height="60" width="120">
								</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							 <button class="btn btn-default pull-right" name="submit" type="submit"> Save Profile <i class="fa fa-angle-right"></i></button>
						</div>
					</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>