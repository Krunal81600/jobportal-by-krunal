<?php
	include('header.php');

error_reporting(0);

$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$row=mysqli_fetch_array($sel);

$sela=mysqli_query($con,"SELECT * FROM `education` WHERE edu_uid='$session_id'");
$rowa=mysqli_fetch_array($sela);

$selb=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$session_id'");
$rowb=mysqli_fetch_array($selb);

$selc=mysqli_query($con,"SELECT * FROM `skill` WHERE skill_uid='$session_id'");
$rowc=mysqli_fetch_array($selc);
$fee_details = unserialize($rowc['skill_nm']);

$seld=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowd=mysqli_fetch_array($seld);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='build-resume'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);

if(isset($_POST['education']))
{
    $edu_title=$_POST['edu_title'];
    $edu_sdate=$_POST['edu_sdate'];
    $edu_edate=$_POST['edu_edate'];
    $edu_info=$_POST['edu_info'];
    $edu_insti=$_POST['edu_insti'];
	$session_id=$_SESSION['member_id'];
	
	mysqli_query($con,"UPDATE `education` SET `edu_title`='$edu_title',`edu_sdate`='$edu_sdate',`edu_edate`='$edu_edate',`edu_info`='$edu_info',`edu_insti`='$edu_insti' WHERE edu_uid='$session_id'");
	
	$notify="Update His Education Details";
	$type="user";
	$link="education?id=$session_id";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
	
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='build-resume'";
	echo "</script>";
}

if(isset($_POST['experience']))
{
    $exp_cnm=$_POST['exp_cnm'];
    $exp_pos=$_POST['exp_pos'];
    $exp_jsdate=$_POST['exp_jsdate'];
    $exp_jedate=$_POST['exp_jedate'];
    $exp_info=$_POST['exp_info'];
	$session_id=$_SESSION['member_id'];
	
	mysqli_query($con,"UPDATE `experience` SET `exp_cnm`='$exp_cnm',`exp_pos`='$exp_pos',`exp_jsdate`='$exp_jsdate',`exp_jedate`='$exp_jedate',`exp_info`='$exp_info' WHERE exp_uid='$session_id'");
	
	mysqli_query($con,"UPDATE `user` SET `position`='$exp_pos' WHERE id='$session_id'");
	
	$notify="Update His Experience Details";
	$type="user";
	$link="experience?id=$session_id";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='build-resume'";
	echo "</script>";
}

if(isset($_POST['skill']))
{
	$slug=$_POST['skill_nm'];
	$session_id=$_SESSION['member_id'];
	for($i=0;$i < count($slug);$i++)
	{
		$val[$i]=$_POST['skill_nm'][$i].",".$_POST['skill_pr'][$i];
	}
	$val_sea= serialize($val);
	mysqli_query($con,"UPDATE `skill` SET `skill_nm`='$val_sea' WHERE skill_uid='$session_id'");
	
	$notify="Update His Skill Details";
	$type="user";
	$link="skill?id=$session_id";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
	
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='build-resume'";
	echo "</script>";
}
if(isset($_POST['social']))
{
    $social_fb="https://www.facebook.com/".$_POST['social_fb'];
	$social_tw="https://twitter.com/".$_POST['social_tw'];
	$social_li="https://www.linkedin.com/".$_POST['social_li'];
	$social_gp="https://plus.google.com/".$_POST['social_gp'];
	$session_id=$_SESSION['member_id'];
	
	mysqli_query($con,"UPDATE `social` SET `social_fb`='$social_fb',`social_tw`='$social_tw',`social_li`='$social_li',`social_gp`='$social_gp' WHERE social_uid='$session_id'");
	
	$notify="Update His Social Details";
	$type="user";
	$link="social?id=$session_id";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
	
	?>
	<script>
		alert("Successfully Uploaded");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='build-resume'";
	echo "</script>";
}
if(isset($_POST['resume_up']))
{	
	$resume_title=$_POST['resume_title'];
	
	$error = array();
	$accepteble = array
	(
		'application/pdf',
		'application/doc',
		'application/docx',
		'application/xls',
		'application/xlsx',
		'application/msword',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
	);
	
	$img = $_FILES['resume']['name'];
	$tmp = $_FILES['resume']['tmp_name'];
	$size = $_FILES['resume']['size'];
	$type = $_FILES['resume']['type'];
	
	if($size >= 2097152 || ($size == 0))
	{
		$error[] = "Resume Size too large. File must be less than 2 megabytes.$size";
	}
	if(!in_array($type,$accepteble) && (!empty($type)))
	{
		$error[] = "Invalid file type. Only PDF and DOC types are accepted. ";
	}
	
	$rnd = mt_rand(1,99999);
	$fnm = "resume". $rnd . $img;
	$lfile = str_replace(' ','_',$fnm);
	$r = move_uploaded_file($tmp,'resume/'.$lfile);
	
	if(count($error) == 0)
	{
		$session_id=$_SESSION['member_id'];
		mysqli_query($con,"INSERT INTO `resume`(`resume_uid`, `resume_title`, `resume_nm`) VALUES ('$session_id','$resume_title','$lfile')");
		
		$notify="Upload Resume";
		$type="user";
		$link="resume?id=$session_id";
		$jct=date('Y-m-d H:i:s');
		
		$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
		?>
		<script type="text/javascript">
		alert("Successfully Uploaded");
		</script>
		<?php
		echo "<script type='text/javascript'>";      
		echo "window.location='user-resume'";
		echo "</script>";
	}
	else
	{
		foreach($error as $err)
		{
			echo '<script>alert("'.$err.'");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'build-resume'";
			echo"</script>";
		}
		die();
	}
	 
}

?>
<style>
.add_button{position: relative;top: 35px;}
.remove_button{position: relative;top: 35px;}
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
                                    <span class="title"><?php echo $rowb['exp_pos']; ?></span>
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
										<li>
											<a href="user-edit-profile"> <i class="fa fa-edit"></i> <?php echo $result123['title2']; ?></a>
										</li>
										<li  class="active">
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
										<div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title2']; ?> <span class="required">*</span></label>
                                                <input type="text" name="edu_insti" placeholder="<?php echo $result12['title2']; ?>" class="form-control" value="<?php echo $rowa['edu_insti']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title3']; ?> <span class="required">*</span></label>
                                                <input type="text" name="edu_title" placeholder="<?php echo $result12['title3']; ?>" class="form-control" value="<?php echo $rowa['edu_title']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title4']; ?> <span class="required">*</span></label>
                                                <input name="edu_sdate" placeholder="<?php echo $result12['title4']; ?>" type="date" class="form-control" value="<?php echo $rowa['edu_sdate']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title5']; ?> <span class="required">*</span></label>
                                                <input type="date" name="edu_edate" placeholder="<?php echo $result12['title5']; ?>" class="form-control" value="<?php echo $rowa['edu_edate']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title6']; ?></label>
                                                <textarea name="edu_info" id="ckeditor" required><?php echo $rowa['edu_info']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button class="btn btn-default pull-right" name="education" type="submit"> <?php echo $result12['title7']; ?> <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <hr class="divider">
                            </div>
                            
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title8']; ?></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="profile-edit row">
                                    <form method="POST"  enctype="multipart/form-data"> 
										<div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title9']; ?> <span class="required">*</span></label>
                                                <input type="text" name="exp_cnm" placeholder="<?php echo $result12['title9']; ?>" class="form-control" value="<?php echo $rowb['exp_cnm']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title10']; ?> <span class="required">*</span></label>
                                                <input type="text" name="exp_pos" placeholder="<?php echo $result12['title10']; ?>" class="form-control" value="<?php echo $rowb['exp_pos']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title11']; ?> <span class="required">*</span></label>
                                                <input type="date" name="exp_jsdate" placeholder="<?php echo $result12['title11']; ?>" class="form-control" value="<?php echo $rowb['exp_jsdate']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title12']; ?><span class="required">*</span></label>
                                                <input type="date" name="exp_jedate" placeholder="<?php echo $result12['title12']; ?>" class="form-control" value="<?php echo $rowb['exp_jedate']; ?>"  required>
                                            </div>
                                        </div>
										<div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title13']; ?></label>
                                                <textarea name="exp_info" style="width:100%;" rows="10" required><?php echo $rowb['exp_info']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button class="btn btn-default pull-right" name="experience" type="submit"> <?php echo $result12['title14']; ?> <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <hr class="divider">
                            </div>
                            
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title15']; ?></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
								<div class="profile-edit row">
                                    <form method="POST"  enctype="multipart/form-data">
										<div class="field_wrapper">
							<?php
							for($j=0;$j<count($fee_details);$j++)
							{
							$fee_details_id=$fee_details[$j];
							$explode=explode(',',$fee_details_id);
							if($j==0)
								{
							?>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label><?php echo $result12['title16']; ?> <span class="required">*</span></label>
												<input type="text" placeholder="<?php echo $result12['title16']; ?>" name="skill_nm[]" class="form-control" value="<?php echo $explode[0]; ?>"  required>
											</div>
										</div>
										<div class="col-md-4 col-sm-12">
											<div class="form-group">
												<label><?php echo $result12['title17']; ?> <span class="required">*</span></label>
												<input type="text" placeholder="<?php echo $result12['title17']; ?>" name="skill_pr[]" class="form-control" value="<?php echo $explode[1]; ?>" required>
											</div>
										</div>
										<div class="col-md-2 col-sm-12">
											<a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png"/></a>
										</div>
								<?php } else { ?>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title16']; ?> <span class="required">*</span></label>
                                                <input type="text" placeholder="<?php echo $result12['title16']; ?>" name="skill_nm[]" class="form-control" value="<?php echo $explode[0]; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title17']; ?> <span class="required">*</span></label>
                                                <input type="text" placeholder="<?php echo $result12['title17']; ?>" name="skill_pr[]" class="form-control" value="<?php echo $explode[1]; ?>" required>
                                            </div>
                                        </div>
										<div class="col-md-2 col-sm-12">
											<a href="javascript:void(0);" class="remove_button" title="Add field"><img src="remove-icon.png"/></a>
										</div>
								<?php } } ?>
										</div>
                                        <div class="col-md-12 col-sm-12">
                                            <button class="btn btn-default pull-right" name="skill" type="submit"> <?php echo $result12['title18']; ?> <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <hr class="divider">
                            </div>
                            
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title19']; ?></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="profile-edit row">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title20']; ?> <span class="required">*</span></label>
                                                <input type="text" name="social_fb" placeholder="<?php echo $result12['title20']; ?>" class="form-control" value="<?php echo $rowd['social_fb']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title21']; ?> <span class="required">*</span></label>
                                                <input type="text" name="social_tw" placeholder="<?php echo $result12['title21']; ?>" class="form-control" value="<?php echo $rowd['social_tw']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title22']; ?> <span class="required">*</span></label>
                                                <input type="text" name="social_li" placeholder="<?php echo $result12['title22']; ?>" class="form-control" value="<?php echo $rowd['social_li']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title23']; ?> <span class="required">*</span></label>
                                                <input type="text" name="social_gp" placeholder="<?php echo $result12['title23']; ?>" class="form-control" value="<?php echo $rowd['social_gp']; ?>"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button class="btn btn-default pull-right" name="social" type="submit"> <?php echo $result12['title24']; ?> <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
							
							<div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title25']; ?></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="profile-edit row">
                                    <form method="POST" enctype="multipart/form-data">
										<div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title26']; ?> <span class="required">*</span></label>
                                                <input type="text" name="resume_title" placeholder="<?php echo $result12['title26']; ?>" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title27']; ?> <span class="required">*</span></label>
                                                <input type="file" name="resume" placeholder="<?php echo $result12['title27']; ?>" class="form-control"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button class="btn btn-default pull-right" name="resume_up" type="submit"> <?php echo $result12['title28']; ?> <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
							<div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title29']; ?></p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="profile-edit row">
									<div class="col-md-12 col-sm-12">
										<?php
										$session_id=$_SESSION['member_id'];
										$selm=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
										$rowm=mysqli_fetch_array($selm);
										if($rowm['make_pay']==0)
										{
										?>
										<button data-target="#myModal" data-toggle="modal" type="button" class="btn btn-danger"><?php echo $result12['title30']; ?></button>
										<?php } else { 
										$session_id=$_SESSION['member_id'];
										$selma=mysqli_query($con,"SELECT * FROM `make_resume` WHERE user_id='$session_id'");
										$rowma=mysqli_fetch_array($selma);
										if($rowma['app_mk']==0)
										{
										?>
										<button type="button" class="btn btn-success"><?php echo $result12['title31']; ?></button>
										<?php } else { ?>
										<button type="button" class="btn btn-success"><?php echo $result12['title32']; ?></button>
										<?php } } ?>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog"> 
		<div class="modal-content">
			<div class="modal-header rte">
				<h2 class="modal-title1"><?php echo $result12['title33']; ?></h2>
			</div>
			<form method="POST" action="paymentscr.php">
			<div class="modal-body">
				<div class="col-md-12 col-sm-12">
					<p><?php echo $result12['title34']; ?></p>
					<!-- Specify a Buy Now button. -->
					<input type="hidden" name="item_name" value="Paid Post">
					
					<input type="hidden" name="cmd" value="_xclick" />
					<input type="hidden" name="currency_code" value="USD" />
					<input type="hidden" name="item_number" value="1" / >
					<input type="hidden" name="amount" value="69.99" / >
				</div>
			</div>
			<div class="modal-footer" style="border-top: none;">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $result12['title35']; ?></button>
				<button type="submit" name="payment" class="btn btn-default"><?php echo $result12['title36']; ?></button>
			</div>
			</form>
		</div>
	</div>
</div>		
<script src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div class="newdata"><div class="col-md-6 col-sm-12"><div class="form-group"><label>Skill Name <span class="required">*</span></label><input type="text" placeholder="Skill Name" class="form-control" name="skill_nm[]"></div></div><div class="col-md-4 col-sm-12"><div class="form-group"><label>Add Percentage (%) <span class="required">*</span></label><input type="text" name="skill_pr[]" placeholder="Percentage %" class="form-control"></div></div><div class="col-md-2 col-sm-12"><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div></div>'; //New input field html 
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('.newdata').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>
<?php
	include('footer.php');
?>