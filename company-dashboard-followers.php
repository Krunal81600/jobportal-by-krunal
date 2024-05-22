<?php
	include('header.php');
	$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$session_id'");
$row=mysqli_fetch_array($sel);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar2'");
$result123 = mysqli_fetch_array($sql123);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='followers'");
$result12 = mysqli_fetch_array($sql12);

if($_REQUEST['hire'])
{
	$hire_compid=$_SESSION['member_id'];
	$hire_uid=$_GET['hire_uid'];
	$hdate=date('Y-m-d');
	
	mysqli_query($con,"INSERT INTO `hire`(`hire_uid`, `hire_compid`, `hdate`) VALUES ('$hire_uid','$hire_compid','$hdate')");
	
	$notify="Hire Candidate,schedule interview with this candidate";
	$type="user";
	$link="hire";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$hire_compid','$notify','$type','$link','$jct')");
	
	$selectaaa=mysqli_query($con,"SELECT * FROM `company` where comp_uid='$hire_compid'");
	$rowaaa=mysqli_fetch_array($selectaaa);
	
	$notifya= $rowaaa['industry']."  reviewed your resume and will be notified as soon as possible.";
	$typea="admin";
	$linka="#";

	$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link,noti_time) values('$hire_compid','$hire_uid','$notifya','$typea','$linka','$jct')");
	?>
	<script>
		alert("Successfully ,We will contact you as soon as possible with the interview scheduling");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='user_resume?id=$hire_uid'";
	echo "</script>";
}
?>
       <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="panel">
                                <div class="dashboard-logo-sidebar">
                                    <img class="img-responsive center-block" src="upload/<?php echo $row['comp_logo']; ?>" alt="Image">
                                </div>
                                <div class="text-center dashboard-logo-sidebar-title">
                                    <h4><?php echo $row['industry']; ?></h4>
                                </div>
                            </div>
                            <div class="profile-nav">
                                <div class="panel">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li>
                                            <a href="company-dashboard"> <i class="fa fa-user"></i> <?php echo $result123['title1']; ?></a>
                                        </li>
                                        <li>
                                            <a href="edit-profile-company"> <i class="fa fa-edit"></i> <?php echo $result123['title2']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title3']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-active-jobs"> <i class="fa  fa-list-alt"></i> <?php echo $result123['title4']; ?></a>
                                        </li>
                                        <li  class="active">
                                            <a href="company-dashboard-followers"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title5']; ?> </a>
                                        </li>
										<li>
                                            <a href="hire_candidate"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title6']; ?> </a>
                                        </li>
										<li>
                                            <a href="interest_in_candidate"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title7']; ?> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title1']; ?></p>
                            </div>
                            <div class="follower-section">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="" id="followers">
                                        <ul class="list-group list-group-dividered list-group-full">
										<?php
										$sel=mysqli_query($con,"SELECT * FROM `follow` WHERE comp_id='$session_id' AND (id % 2) > 0 ORDER BY id ASC");
										while($row=mysqli_fetch_array($sel))
										{
											$job_uid=$row['user_id'];
											$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$job_uid'");
											$rowa=mysqli_fetch_array($sela);
										?>
                                            <li class="list-group-item">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a class="avatar avatar-online" href="javascript:void(0)">
                                                            <img src="upload/<?php echo $rowa['profile']; ?>" class="img-responsive" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="pull-right">
                                                            <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='company-dashboard-followers?hire_uid=<?php echo $rowa['id']; ?>&hire=hire'"><?php echo $result12['title2']; ?></button>
                                                        </div>
                                                        <div><a class="name" href="user_resume?id=<?php echo $rowa['id']; ?>"><?php echo $rowa['fname']." ".$rowa['lname']; ?></a></div>
                                                        <small><?php echo $rowa['email']; ?></small>
                                                    </div>
                                                </div>
                                            </li>
										<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="" id="followers">
                                        <ul class="list-group list-group-dividered list-group-full">
                                            <?php
										$sel=mysqli_query($con,"SELECT * FROM `follow` WHERE comp_id='$session_id' AND (id % 2) = 0 ORDER BY id ASC");
										while($row=mysqli_fetch_array($sel))
										{
											$job_uid=$row['user_id'];
											$sela=mysqli_query($con,"SELECT * FROM `user` WHERE id='$job_uid'");
											$rowa=mysqli_fetch_array($sela);
										?>
                                            <li class="list-group-item">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a class="avatar avatar-online" href="javascript:void(0)">
                                                            <img src="upload/<?php echo $rowa['profile']; ?>" class="img-responsive" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="pull-right">
                                                            <button type="button" class="btn btn-default btn-sm"><?php echo $result12['title2']; ?></button>
                                                        </div>
                                                        <div><a class="name" href="user_resume?id=<?php echo $rowa['id']; ?>"><?php echo $rowa['fname']." ".$rowa['lname']; ?></a></div>
                                                        <small><?php echo $rowa['email']; ?></small>
                                                    </div>
                                                </div>
                                            </li>
										<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
	include('footer.php');
?>