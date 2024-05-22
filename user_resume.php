<?php include('header.php');
$id=$_GET['id'];
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if($_REQUEST['id'] && $_SESSION['member_id']!="")
{	
	$uid=$_SESSION['member_id'];

	$id=$_GET['id'];
	$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$id'");
	$rowa=mysqli_fetch_array($sela);
	$user=$rowa['user'];
	$userid=$rowa['id'];
	
	$selcm=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$uid'");
	$rowcm=mysqli_fetch_array($selcm);
	$industry=$rowcm['industry'];
	
	$notify="Company as(".$industry.") Interested in ".$user;
	$type="user";
	$link="interest_resume";
	$jct=date('Y-m-d');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$uid','$notify','$type','$link')");
	
	mysqli_query($con,"INSERT INTO `interest`(`us_id`, `cm_id`, `ps_id`, `us_type`, `jct`) VALUES ('$userid','$uid','0','cm','$jct')");
}

$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$id'");
$rowa=mysqli_fetch_array($sela);

$selab=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$id'");
$rowab=mysqli_fetch_array($selab);

$selabcd=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$id' ORDER BY id DESC");
$rowabcd=mysqli_fetch_array($selabcd);

$selac=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$id' ORDER BY id DESC");
$rowac=mysqli_fetch_array($selac);

if($_REQUEST['hire'])
{
	$hire_compid=$_SESSION['member_id'];
	$hire_uid=$_GET['hire_uid'];
	$hdate=date('Y-m-d H:i:s');
	
	mysqli_query($con,"INSERT INTO `hire`(`hire_uid`, `hire_compid`, `hdate`) VALUES ('$hire_uid','$hire_compid','$hdate')");
	
	$notify="Hire Candidate,schedule interview with this candidate";
	$type="user";
	$link="hire";

	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$hire_compid','$notify','$type','$link','$hdate')");
	
	?>
	<script>
		alert("Successfully ,We will contact you as soon as possible with the interview scheduling");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='user_resume?id=$hire_uid'";
	echo "</script>";
}

if(isset($_POST['sendmail']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$message=$_POST['message'];
	$userid=$_POST['userid'];
	
	$uid=$_SESSION['member_id'];
	$selabcom=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$uid'");
	$rowabcom=mysqli_fetch_array($selabcom);
	$com_nm=$rowabcom['industry'];
	
	$comp_uid=$rowabcom['comp_uid'];
	$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$comp_uid'");
	$rowa=mysqli_fetch_array($sela);
	$com_user=$rowa['user'];
	
	$selaus=mysqli_query($con,"SELECT * FROM `user` WHERE id='$userid'");
	$rowaus=mysqli_fetch_array($selaus);
	$fnln=$rowaus['fname']." ".$rowaus['lname'];
	$user_nm=$rowaus['user'];
	
	$to      = 'info@africaglobalnetwork.com';
	$subject = 'setup an interview';
	$message = $com_nm."user name as ( ".$com_user." ) setup an interview with Candidate ".$fnln." user name as ( ".$user_nm." )";
	$header = "From: ".$email."\r\n"; 
	$headers= 'From: Website plc <'.$email.'>' . "\r\n" .
			'Reply-To: '.$email.'' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

	$mail=mail($to, $subject, $message, $headers);
}

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='user_resume'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);
 ?>
<script type="text/javascript">
 function deleteConfirm(){
    var result = confirm("Are you sure you want to hire this candidate?");
    if(result){
        window.location.href='user_resume?hire_uid=<?php echo $rowa['id']; ?>&hire=hire';
    }else{
        window.location.href='user_resume?id=<?php echo $id; ?>';
    }
}
 </script>
        <section class="resume2 resume7">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-3 col-sm-5 col-xs-12">
                            <div class="profile-photo"><img src="upload/<?php echo $rowa['profile']; ?>" alt="" class="img-responsive"></div>
                            <div class="resume-social">
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="<?php echo $rowac['social_fb']; ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $rowac['social_tw']; ?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="<?php echo $rowac['social_gp']; ?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="<?php echo $rowac['social_li']; ?>" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-7 col-xs-12">
                            <div class="profile-info col-md-12">
								<div class="col-md-9">
									<h1 class="profile-title"><?php echo $rowa['fname']." ".$rowa['lname']; ?></h1>
									<h2 class="profile-position"><?php echo $rowab['exp_pos']; ?></h2>
								</div>
								<div class="col-md-3">
									<button class="btn btn-primary btn-custom" onclick="deleteConfirm()"><?php echo $result12['title1']; ?></button>
								</div>
							</div>
							
								<div class="col-md-9">
								<ul class="profile-list">
									<li class="">
										<strong class="title"><?php echo $result12['title2']; ?></strong>
										<span class="cont"><?php echo $rowa['jct']; ?></span>
									</li>
									<li class="">
										<strong class="title"><?php echo $result12['title3']; ?>:</strong>
										<span class="cont"><a href="mailto:resume@user.com"><?php echo $rowa['email']; ?></a></span>
									</li>
									<li class="">
										<strong class="title"><?php echo $result12['title4']; ?>:</strong>
										<span class="cont"><a href="tel:+9911154849901"><?php echo $rowa['phone']; ?></a></span>
									</li>
									<li class="">
										<strong class="title"><?php echo $result12['title5']; ?>:</strong>
										<span class="cont"><?php echo $rowa['address']; ?>  </span>
									</li>
									<li class="skills">
									<?php
									$selabc=mysqli_query($con,"SELECT * FROM `skill` WHERE skill_uid='$id'");
									$rowabc=mysqli_fetch_array($selabc);
									$fee_details = unserialize($rowabc['skill_nm']);
									for($j=0;$j<count($fee_details);$j++)
									{
									$fee_details_id=$fee_details[$j];
									$explode=explode(',',$fee_details_id);
									if($j==0)
									{
									?>
										<a href="#"> <?php echo $explode[0]; ?></a>
									<?php } else { ?>
									<a href="#"> <?php echo $explode[0]; ?></a>
									<?php } } ?>
									</li>
								</ul>
								</div>
								<div class="col-md-3">
								 <?php
									if($_SESSION['member_user']=="")
									{ ?>
									<a class="btn btn-primary" href="register"> <?php echo $result12['title6']; ?> </a>
									<?php } else { ?>
									<a class="btn btn-primary" target="_blank" href="resume/<?php echo $rowabcd['resume_nm']; ?>"> <?php echo $result12['title6']; ?> </a>
									<?php } ?>
								</div>
                            <!--<h4><strong> About Me:</strong></h4>
                            
                            -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                        	<div class="heading-inner">
                                <p class="title"><?php echo $result12['title7']; ?>:</p>
                            </div>
                            <p>
                               <?php echo $rowa['about']; ?>
                            </p>
                           
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                        	
                            <div class="form-area"> 
                            <h4 class="contact-me-heading"><?php echo $result12['title8']; ?></h4>
                                <form role="form" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"  required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                        <input type="hidden" class="form-control" name="userid" value="<?php echo $_GET['id']; ?>" readonly required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Message"  rows="2" required></textarea>
                                    </div>
									<?php
									if($_SESSION['member_user']=="")
									{ ?>
                                    <button type="button" onclick="window.location.href='register'" class="btn btn-default pull-right"><?php echo $result12['title9']; ?></button>
									<?php } else { ?>
									<button type="submit" name="sendmail" class="btn btn-default pull-right"><?php echo $result12['title9']; ?></button>
									<?php } ?>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="resume-box">
                                <div class="heading-inner">
                                    <p class="title"><?php echo $result12['title10']; ?></p>
                                </div>
								<?php
								$selabcd=mysqli_query($con,"SELECT * FROM `education` WHERE edu_uid='$id'");
								while($rowabcd=mysqli_fetch_array($selabcd))
								{
								?>
                                <div class="row education-box">
                                    <div class="col-md-4 col-xs-12 col-sm-4">
                                        <div class="resume-icon">
                                            <span class="icon-clipboard"></span>
                                        </div>
                                        <div class="insti-name">
                                            <h4><?php echo $rowabcd['edu_insti']; ?></h4>
                                            <span><?php echo $rowabcd['edu_sdate']; ?> to <?php echo $rowabcd['edu_edate']; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-8 col-sm-8">
                                        <div class="degree-info">
                                            <h4><?php echo $rowabcd['edu_title']; ?></h4>
                                            <p><?php echo $rowabcd['edu_info']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="resume-box">
                                <div class="heading-inner">
                                    <p class="title"><?php echo $result12['title11']; ?></p>
                                </div>
								<?php
								$selabcda=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$id'");
								while($rowabcda=mysqli_fetch_array($selabcda))
								{
								?>
                                <div class="row education-box">
                                    <div class="col-md-4 col-xs-12 col-sm-4">
                                        <div class="resume-icon">
                                            <span class="icon-clipboard"></span>
                                        </div>
                                        <div class="insti-name">
                                            <h4><?php echo $rowabcda['exp_cnm']; ?></h4>
                                            <span><?php echo $rowabcda['exp_jsdate']; ?> to <?php echo $rowabcda['exp_jedate']; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-8 col-sm-8">
                                        <div class="degree-info">
                                            <h4><?php echo $rowabcda['exp_pos']; ?></h4>
                                            <p><?php echo $rowabcda['exp_info']; ?></p>
                                        </div>
                                    </div>
                                </div>
                               <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="heading-inner">
                                <p class="title"><?php echo $result12['title12']; ?></p>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
								<?php
								  $id=$_GET['id'];
									$sel=mysqli_query($con,"SELECT * FROM `skill` WHERE skill_uid='$id' AND (id % 2) > 0 ORDER BY id DESC");
									while($row=mysqli_fetch_array($sel))
									{
										$fee_details = unserialize($row['skill_nm']);
										for($j=0;$j<count($fee_details);$j++)
										{
										$fee_details_id=$fee_details[$j];
										$explode=explode(',',$fee_details_id);
										if($j==0)
											{
									?>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $explode[1]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $explode[1]; ?>%;">
                                            <span class="sr-only"><?php echo $explode[1]; ?>% <?php echo $result12['title13']; ?></span>
                                        </div>
                                        <span class="progress-type"><?php echo $explode[0]; ?></span>
                                        <span class="progress-completed"><?php echo $explode[1]; ?>%</span>
                                    </div>
                                    <?php } else { ?>
									<div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $explode[1]; ?>%;">
                                            <span class="sr-only"><?php echo $explode[1]; ?>% <?php echo $result12['title13']; ?></span>
                                        </div>
                                        <span class="progress-type"><?php echo $explode[0]; ?></span>
                                        <span class="progress-completed"><?php echo $explode[1]; ?>%</span>
                                    </div>
									<?php } } }?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
<?php include('footer.php'); ?>