<?php include('header.php'); 

$id=$_GET['id'];
$select=mysqli_query($con,"SELECT * FROM `user` where id='$id'");
$row=mysqli_fetch_array($select);

if(isset($_POST['Update_profile']))
{
	$session_id=$_GET['id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $user=$_POST['user'];
    $phone=$_POST['phone'];
    $dob=$_POST['dob'];
    $last_edu=$_POST['last_edu'];
    $address=$_POST['address'];
    $about=$_POST['about'];
    $city=$_POST['city'];
    $country=$_POST['country'];
	
	$error = array();
	$accepteble = array
	(
		'image/jpg',
		'image/jpeg',
		'image/png'
	);
	if($_FILES['profile']['name'])
	{
	$img = $_FILES['profile']['name'];
	$tmp = $_FILES['profile']['tmp_name'];
	$size = $_FILES['profile']['size'];
	$type = $_FILES['profile']['type'];
	
	if($size >= 2097152 || ($size == 0))
	{
		$error[] = "profile Image too large. File must be less than 2 megabytes.$size";
	}
	if(!in_array($type,$accepteble) && (!empty($type)))
	{
		$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
	}
	
	$rnd = mt_rand(1,99999);
	$fnm = "img". $rnd . $img;
	$lfile = str_replace(' ','_',$img);
	$r = move_uploaded_file($tmp,'../upload/'.$lfile);
	
	}
	else
	{
		$lfile=$row['profile'];
	}
	
	if($_FILES['cover']['name'])
	{
	$imga = $_FILES['cover']['name'];
	$tmpa = $_FILES['cover']['tmp_name'];
	$sizea = $_FILES['cover']['size'];
	$typea = $_FILES['cover']['type'];
	
	if($sizea >= 2097152 || ($sizea == 0))
	{
		$error[] = "cover Image too large. File must be less than 2 megabytes.";
	}
	if(!in_array($typea,$accepteble) && (!empty($typea)))
	{
		$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
	}
	
	$rnda = mt_rand(1,99999);
	$fnma = "img". $rnda . $imga;
	$lfilea = str_replace(' ','_',$fnma);
	$r = move_uploaded_file($tmpa,'../upload/'.$lfilea);
	
	}
	else
	{
		$lfilea=$row['cover'];
	}
	
	if(count($error) == 0)
	{
		
		mysqli_query($con,"UPDATE `user` SET `fname`='$fname',`lname`='$lname',`email`='$email',`user`='$user',`phone`='$phone',`dob`='$dob',`last_edu`='$last_edu',`address`='$address',`about`='$about',`profile`='$lfile',`cover`='$lfilea' WHERE id='$session_id'");
		?>
		<script>
		alert('Successfully Updated');
		</script>
		<?php
		echo "<script type='text/javascript'>";
		echo "window.location='info?id=$session_id'";
		echo "</script>";
	}
	else
	{
		foreach($error as $err)
		{
			echo '<script>alert("'.$err.'");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'info?id=$session_id'";
			echo"</script>";
		}
		die();
	}
		 
} 
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Update Candidate <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Update Candidate</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Update Candidate</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form Method="POST" enctype="multipart/form-data">
                        <div class="form-group">
									<label for="inputName1" class="control-label">First Name</label>
									<input type="text" class="form-control" id="inputName1" name="fname" placeholder="Enter First Name" value="<?php echo $row['fname']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Last Name</label>
									<input type="text" class="form-control" id="inputName1" name="lname"  placeholder="Enter Last Name" value="<?php echo $row['lname']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Email</label>
									<input type="email" class="form-control" id="inputEmail" name="email"  placeholder="Email" data-error="Bruh, that email address is invalid"
										value="<?php echo $row['email']; ?>"
									   >
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Candidate User Name</label>
									<input type="text" class="form-control" id="inputName1" value="<?php echo $row['user']; ?>" name="user"  placeholder="Enter User Name" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Phone Number</label>
									<input type="text" class="form-control" id="inputName1" value="<?php echo $row['phone']; ?>" name="phone"  placeholder="Enter Phone Number" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Date of Birth</label>
									<input type="date" class="form-control" id="inputName1" value="<?php echo $row['dob']; ?>" name="dob"  placeholder="Select Date of Birth" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Last Education</label>
									<input type="text" class="form-control" id="inputName1" value="<?php echo $row['last_edu']; ?>" name="last_edu"  placeholder="Enter Last Education" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Address</label>
									<textarea class="form-control" id="inputName1"  rows="8" name="address"  placeholder="Enter Address" ><?php echo $row['address']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">About</label>
									<textarea class="form-control" id="inputName1"  rows="8" name="about"  placeholder="Enter About User" ><?php echo $row['about']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">City</label>
									<select class="form-control" name="location" id="inputName1" >
										<option value="">Select City</option>
										<?php 
											$sel=mysqli_query($con,"SELECT * FROM city");
											while($rowc=mysqli_fetch_array($sel))
											{
										?>
										<option value="Abia" <?php if($rowc['id']==$row['city']) echo "selected='selected'";?>><?php echo $rowc['citynm']; ?></option>
											<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Country</label>
									<select class="form-control" name="country" id="inputName1" >
										<option value="">Select Country</option>
										<?php 
											$sel=mysqli_query($con,"SELECT * FROM country");
											while($rowc=mysqli_fetch_array($sel))
											{
										?>
										<option value="Abia" <?php if($rowc['id']==$row['country']) echo "selected='selected'";?>><?php echo $rowc['countrynm']; ?></option>
											<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<div class="white-box">
									<div class="col-md-8">
									<label for="inputName1" class="control-label">Update Profile Image</label>
									<input type="file" name="profile" id="input-file-now-custom-1" class="form-control" />
									</div>
									<div class="col-md-4">
										<img src="../upload/<?php echo $row['profile'] ?>" class="thumbnail" alt="Profile" height="100" width="100">
									</div>
									</div>
								</div>
								<div class="form-group">
									<div class="white-box">
									<div class="col-md-8">
									<label for="inputName1" class="control-label">Update Cover Image</label>
									<input type="file" name="cover" id="input-file-now-custom-1" class="form-control" />
									</div>
									<div class="col-md-4">
										<img src="../upload/<?php echo $row['cover'] ?>" class="thumbnail" alt="Profile" height="60" width="120">
									</div>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-success btn-square" id="inputName1" value="Update" name="Update_profile" >
								</div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>