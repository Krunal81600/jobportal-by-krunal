<?php
include('header.php');

$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$row=mysqli_fetch_array($sel);	

$exp_pos=$row['id'];
$selex=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$exp_pos'");
$rowex=mysqli_fetch_array($selex);

$seld=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowd=mysqli_fetch_array($seld);

if(isset($_POST['submit']))
{
	$session_id=$_SESSION['member_id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $dob=$_POST['dob'];
    $last_edu=$_POST['last_edu'];
    $address=$_POST['address'];
    $about=$_POST['about'];
    $phone=$_POST['phone'];
    $countrya=$_POST['countrya'];
    $country=$_POST['country'];
    $citya=$_POST['citya'];
    $city=$_POST['city'];
	
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
	$r = move_uploaded_file($tmp,'upload/'.$lfile);
	
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
	$r = move_uploaded_file($tmpa,'upload/'.$lfilea);
	
	}
	else
	{
		$lfilea=$row['cover'];
	}
	
	if(count($error) == 0)
	{
		
		mysqli_query($con,"UPDATE `user` SET `fname`='$fname',`lname`='$lname',`dob`='$dob',`last_edu`='$last_edu',`address`='$address',`about`='$about',`phone`='$phone',`country`='$country',`countrya`='$countrya',`city`='$city',`citya`='$citya',`profile`='$lfile',`cover`='$lfilea' WHERE id='$session_id'");
		
		$notify="Update His Profile";
		$type="user";
		$link="info?id=$session_id";
		$jct=date('Y-m-d H:i:s');
		
		$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
		
		echo "<script type='text/javascript'>";
		echo "window.location='build-resume'";
		echo "</script>";
	}
	else
	{
		foreach($error as $err)
		{
			echo '<script>alert("'.$err.'");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'user-edit-profile'";
			echo"</script>";
		}
		die();
	}
	 
}
$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='useredit'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);
?>
<style>
.user-avatar img {
    border: 10px solid;
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    width: 125px;
}
</style>
       <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="profile-card">
                                <div class="banner">
                                    <img src="upload/<?php echo $row['cover']; ?>" alt="" class="img-responsive">
                                </div>
                                <div class="user-image">
                                    <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive img-circle" alt="">
                                </div>
                                <div class="card-body">
                                    <h3><?php echo $row['user']; ?></h3>
                                    <span class="title"><?php echo $rowex['exp_pos']; ?></span>
                                </div>
                                <ul class="social-network social-circle onwhite">
                                   <li><a href="<?php echo $rowd['social_fb']; ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="<?php echo $rowd['social_tw']; ?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a href="<?php echo $rowd['social_li']; ?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="<?php echo $rowd['social_gp']; ?>" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="profile-nav">
                                <div class="panel">
                                    <ul class="nav nav-pills nav-stacked">
										<li>
											<a href="user-dashboard"> <i class="fa fa-user"></i> <?php echo $result123['title1']; ?></a>
										</li>
										<li class="active">
											<a href="user-edit-profile"> <i class="fa fa-edit"></i> <?php echo $result123['title2']; ?></a>
										</li>
										<li>
											<a href="build-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title3']; ?></a>
										</li>
										<li>
											<a href="user-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title4']; ?> </a>
										</li>
										<li>
											<a href="user-job-applied"> <i class="fa  fa-list-ul"></i> <?php echo $result123['title5']; ?></a>
										</li>
										<li>
											<a href="user-followed-companies"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title6']; ?> </a>
										</li>
										<li>
											<a href="paid_resume"> <i class="fa fa-money"></i> <?php echo $result123['title7']; ?></a>
										</li>
										<li>
											<a href="interest_in_company"> <i class="fa fa-file-o"></i> <?php echo $result123['title8']; ?></a>
										</li>
										<li>
											<a href="hire_company"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title9']; ?> </a>
										</li>
									</ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title1']; ?></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="profile-edit row">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title2']; ?> <span class="required">*</span></label>
                                                <input type="text" name="fname" value="<?php echo $row['fname']; ?>" placeholder="<?php echo $result12['title2']; ?>" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title3']; ?> <span class="required">*</span></label>
                                                <input type="text" name="lname" value="<?php echo $row['lname']; ?>"  placeholder="<?php echo $result12['title3']; ?>" class="form-control" required>
                                            </div>
                                        </div>
										 <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title4']; ?> <span class="required">*</span></label>
                                                 <input placeholder="<?php echo $result12['title4']; ?>" name="user"  value="<?php echo $row['user']; ?>" readonly class="form-control" id="UserName" type="text" required>
                                            </div>
                                        </div>
										 <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title5']; ?> <span class="required">*</span></label>
                                                 <input placeholder="<?php echo $result12['title5']; ?>" name="email" value="<?php echo $row['email']; ?>" class="form-control" readonly type="email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title6']; ?> <span class="required">*</span></label>
                                                <input type="date" name="dob" value="<?php echo $row['dob']; ?>"  placeholder="<?php echo $result12['title6']; ?>"  class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title7']; ?> <span class="required">*</span></label>
                                                <input type="text" name="last_edu" value="<?php echo $row['last_edu']; ?>"  placeholder="<?php echo $result12['title7']; ?>" class="form-control" required>
                                            </div>
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title8']; ?> <span class="required">*</span></label>
                                                <input placeholder="<?php echo $result12['title8']; ?>" name="phone" value="<?php echo $row['phone']; ?>" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title9']; ?> <span class="required">*</span></label>
                                                <input type="text" name="address" value="<?php echo $row['address']; ?>"  placeholder="<?php echo $result12['title9']; ?>" class="form-control" required>
                                            </div>
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title10']; ?> <span class="required">*</span></label>
                                                <select id="countrya" name="countrya" class="form-control">
												   <option value="">-----<?php echo $result12['title11']; ?>-----</option>
												   <?php
												   $cou=mysqli_query($con,"SELECT * FROM `country` ORDER BY countrynm ASC");
												   while($rowcou=mysqli_fetch_array($cou))
												   {
												   ?>
												   <option value="<?php echo $rowcou['id'] ?>" <?php if($rowcou['id']==$row['countrya']) echo 'selected="selected"' ; ?>><?php echo $rowcou['countrynm'] ?></option>
												   <?php }  ?>
												</select>
                                            </div>
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title12']; ?> <span class="required">*</span></label>
                                                <select name="citya" id="citya" class="form-control">
													<option value="">-----<?php echo $result12['title13']; ?>-----</option>
												</select>
                                            </div>
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title14']; ?><span class="required">*</span></label>
                                                <select id="country" name="country" class="form-control country">
												   <option value="">-----<?php echo $result12['title15']; ?>-----</option>
												   <?php
												  $cou=mysqli_query($con,"SELECT * FROM `country` WHERE africa='1' ORDER BY countrynm ASC");
												   while($rowcou=mysqli_fetch_array($cou))
												   {
												   ?>
												   <option value="<?php echo $rowcou['id'] ?>" <?php if($rowcou['id']==$row['country']) echo 'selected="selected"' ; ?>><?php echo $rowcou['countrynm'] ?></option>
												   <?php } ?>
												</select>
                                            </div>
                                        </div>
										<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title16']; ?> <span class="required">*</span></label>
                                                <select name="city" id="city" class="form-control" required>
													<option value="">-----<?php echo $result12['title17']; ?>-----</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title18']; ?> <span class="required">*</span></label>
                                                <textarea cols="6" rows="8" name="about" placeholder="<?php echo $result12['title18']; ?>" class="form-control" required><?php echo $row['about']; ?></textarea>
                                            </div>
                                        </div>
										<div class="col-md-6 col-sm-12">
											<div class="input-group image-preview form-group">
												<div class="user-avatar " style="width:100%;float:left">
													<img src="upload/<?php echo $row['profile']; ?>" id="blah" alt="" class="img-responsive center-block ">
												</div>
												<div style="width:100%;float:left;margin-top: 20px;text-align: center;">
												<label><?php echo $result12['title19']; ?>: <span class="required">*</span></label>
													<input type="file" onchange="readURL(this);" name="profile" accept="file_extension" name="input-file-preview" />
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
                                        <div class="input-group image-preview form-group">
											<div class="user-avatar " style="width:100%;float:left">
												<img src="upload/<?php echo $row['cover']; ?>" id="blaha" alt="" class="img-responsive center-block ">
											</div>
											<div style="width:100%;float:left;margin-top: 20px;text-align: center;">
											<label><?php echo $result12['title20']; ?>: <span class="required">*</span></label>
												<input type="file" onchange="readURLA(this);" name="cover" accept="file_extension" name="input-file-preview" />
											</div>
										</div>
										</div>
                                        <div class="col-md-12 col-sm-12">
                                            <button type="submit" name="submit" class="btn btn-default pull-right"> <?php echo $result12['title21']; ?> <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   
   <script>
   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	
	function readURLA(inputa) {
        if (inputa.files && inputa.files[0]) {
            var readera = new FileReader();

            readera.onload = function (e) {
                $('#blaha')
                    .attr('src', e.target.result);
            };

            readera.readAsDataURL(inputa.files[0]);
        }
    }


   </script>
  <script src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">-----Choose Country First-----</option>');
        }
    });
    
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#countrya').on('change',function(){
        var countryIDa = $(this).val();
        if(countryIDa){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_ida='+countryIDa,
                success:function(html){
                    $('#citya').html(html);
                }
            }); 
        }else{
            $('#citya').html('<option value="">-----Choose Country First-----</option>');
        }
    });
    
});
</script> 
<?php
	include('footer.php');
?>