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

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='account_setting'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);

if(isset($_POST['change_pwd']))
{
	$session_id=$_SESSION['member_id'];
	$select=mysqli_query($con,"SELECT * FROM `user` where id='$session_id'");
    $row=mysqli_fetch_array($select);
	
   $new_password=$_POST['new_password'];
   $cnew_password=$_POST['cnew_password'];
	$mdpassword=md5($new_password);
	$password=$_POST['password'];
	
	if($row['password']==md5($password))
	{
		if($new_password=$cnew_password)
		{
	    $query = mysqli_query($con,"UPDATE `user` SET `password`='$mdpassword' where id='$session_id' ");
	
		?>
		<script>
			alert("Changé avec succès");
		</script>
	   <?php
			
		echo "<script type='text/javascript'>";
		echo "window.location='account_setting'";
		echo "</script>";
		}
		else
		{
			?>
			<script>
				alert("Mot de passe et confirmer le mot de passe ne correspond pas...");
		</script>
	   <?php
		
		echo "<script type='text/javascript'>";
		echo "window.location='account_setting'";
		echo "</script>";
		}
	}
	else
	{ 
	?>
	<script>
			alert("Mauvais vieux mot de passe");
	</script>
	<?php	}
}

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
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title2']; ?> <span class="required">*</span></label>
                                                <input type="password" name="password" placeholder="ancien mot de passe" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title3']; ?> <span class="required">*</span></label>
                                                <input type="password" name="new_password" pattern=".{6,}" title="Six caractères ou plus" id="txtNewPassword"  placeholder="nouveau mot de passe" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $result12['title4']; ?><span class="required">*</span></label>
                                                <input type="password" name="cnew_password" id="txtConfirmPassword" onkeyup="checkPasswordMatch();" placeholder="Confrim Nouveau mot de passe"  class="form-control" required>
												<p id="divCheckPasswordMatch" style="text-align:left;color:red;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <button type="submit" name="change_pwd" class="btn btn-default pull-right"> <?php echo $result12['title5']; ?> <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<script type="text/javascript">
	function checkPasswordMatch() {
		var password = $("#txtNewPassword").val();
		var confirmPassword = $("#txtConfirmPassword").val();

		if (password != confirmPassword)
			$("#divCheckPasswordMatch").html("Les mots de passe ne correspondent pas!");
		else
			$("#divCheckPasswordMatch").html("Les mots de passe correspondent.");
	}
</script>
<?php
	include('footer.php');
?>