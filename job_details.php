<?php include('header.php'); 
$_SESSION['url'] = $_SERVER['REQUEST_URI'];

$id=$_GET['id'];

if($_REQUEST['id'] && $_SESSION['member_id']!="")
{	
	$uid=$_SESSION['member_id'];

	$id=$_GET['id'];
	$sel=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$id'");
	$row=mysqli_fetch_array($sel);
	$job_title=$row['job_title'];
	$job_uid=$row['job_uid'];
	$postid=$row['id'];
	
	$selcm=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_uid'");
	$rowcm=mysqli_fetch_array($selcm);
	$industry=$rowcm['industry'];
	$jct=date('Y-m-d H:i:s');
	
	$notify="Interested in ".$industry." for Post ".$job_title;
	$type="user";
	$link="interest_post";

	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$uid','$notify','$type','$link','$jct')");
	
	mysqli_query($con,"INSERT INTO `interest`(`us_id`, `cm_id`, `ps_id`, `us_type`, `jct`) VALUES ('$uid','$job_uid','$postid','us','$jct')");
}

$sel=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$id'");
$row=mysqli_fetch_array($sel);

$cityipa=$row['job_location'];
$selacity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cityipa'");
$rowacity=mysqli_fetch_array($selacity);

$job_uid=$row['job_uid'];
$sela=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_uid'");
$rowa=mysqli_fetch_array($sela);

$selab=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$job_uid'");
$rowab=mysqli_fetch_array($selab);

if($_REQUEST['apply'])
{
	$uid=$_SESSION['member_id'];
	$comp_id=$_GET['comp_id'];
	$postid=$_GET['postid'];
	
	mysqli_query($con,"INSERT INTO `job_app`(`job_app_uid`, `job_app_compid`, `job_app_post`) VALUES ('$uid','$comp_id','$postid')");
	
	$notify="Apply For Job";
	$type="user";
	$link="job_apply?id=$uid";

	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$uid','$notify','$type','$link')");
	
	?>
	<script>
		alert("Successfully Applied");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='job_details?id=$postid'";
	echo "</script>";
}

if($_REQUEST['follow'])
{
	$uid=$_SESSION['member_id'];
	$comp_id=$_GET['comp_id'];
	$postid=$_GET['postid'];
	
	mysqli_query($con,"INSERT INTO `follow`(`user_id`, `comp_id`) VALUES ('$uid','$comp_id')");
	
	$notify="Follow Company";
	$type="user";
	$link="job_follow?id=$uid";

	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$uid','$notify','$type','$link')");
	
	$selectaaa=mysqli_query($con,"SELECT * FROM `user` where id='$uid'");
	$rowaaa=mysqli_fetch_array($selectaaa);
	
	$notifya= $rowaaa['user']." Follow You";
	$typea="admin";
	$linka="#";

	$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$uid','$comp_id','$notifya','$typea','$linka')");
	?>
	<script>
		alert("Successfully Follow");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='job_details?id=$postid'";
	echo "</script>";
}

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='job_details'");
$result12 = mysqli_fetch_array($sql12);
?>
<script type="text/javascript">
 function deleteConfirm(){
    var result = confirm("Are you sure you want to apply this job?");
    if(result){
        window.location.href='job_details?comp_id=<?php echo $rowa['comp_uid']; ?>&postid=<?php echo $_GET['id']; ?>&apply=apply';
    }else{
        window.location.href='job_details?id=<?php echo $id; ?>';
    }
}
 </script>
        <section class="single-job-section single-job-section-2">
            <div class="container">
                <div class="row">
                	<div class="col-md-12 col-sm-12 col-xs-12">
                    	<div class="single-job-detail-box">
                            <div class="col-md-9 col-sm-12 col-xs-12">
                                <div class="company-img">
                                    <img  src="upload/<?php echo $rowa['comp_logo']; ?>" class="img-responsi"  alt="">
                                </div>
                                <div class="job-detail-2">
                                    <h2><?php echo $row['job_title']; ?></h2>
                                    <div class="job-detail-meta">
                                        <ul>
                                            <li><i class="fa fa-location-arrow"></i><?php echo $rowacity['citynm']; ?></li>
                                            <li><?php echo $row['currency']; ?> <?php echo $row['job_salary']; ?>/<?php echo $result12['title1']; ?></li>
                                            <li><i class="fa fa-clock-o"></i> <?php echo $row['job_type']; ?></li>
                                            <li><i class="fa fa-calendar-o"></i> <?php echo $result12['title2']; ?>: <?php echo $row['job_edate']; ?> </li>
                                        </ul>
                                    </div>
                                    <div class="b-socials full-socials">
                                       <ul class="list-unstyled">
                                          <li><a href="<?php echo $rowab['social_fb']; ?>" target="_blank"><i class="fa fa-facebook fa-fw"></i><?php echo $result12['title3']; ?></a></li>
                                          <li><a href="<?php echo $rowab['social_tw']; ?>" target="_blank"><i class="fa fa-twitter fa-fw"></i><?php echo $result12['title4']; ?></a></li>
                                          <li><a href="<?php echo $rowab['social_li']; ?>" target="_blank"><i class="fa fa-linkedin fa-fw"></i><?php echo $result12['title5']; ?></a></li>
                                          <li><a href="<?php echo $rowab['social_gp']; ?>" target="_blank"><i class="fa fa-google-plus fa-fw"></i><?php echo $result12['title6']; ?></a></li>
                                       </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                            	<div class="apply-job">
									 <?php
									if($_SESSION['member_user']=="")
									{ ?>
                                    <button class="btn btn-default" onclick="window.location.href='register'"><i class="fa fa-upload"></i><?php echo $result12['title7']; ?></button>
									<?php } else { 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `job_app` WHERE job_app_uid='$uid' AND job_app_compid='$job_uid' AND job_app_post='$id'");
									$countfl=mysqli_num_rows($cnt);
									if($countfl > 0)
									{
									?>
									<button class="btn btn-default"><i class="fa fa-upload"></i><?php echo $result12['title8']; ?></button>
									<?php } else { ?>
									<button class="btn btn-default" onclick="deleteConfirm()"><i class="fa fa-upload"></i><?php echo $result12['title7']; ?></button>
									<?php } } ?>
									<?php
									if($_SESSION['member_user']=="")
									{ ?>
                                    <button class="btn btn-default bookmark" onclick="window.location.href='register'"><i class="fa fa-star"></i> <?php echo $result12['title9']; ?></button>
									<?php } else { 
									$uid=$_SESSION['member_id'];
									$cnt=mysqli_query($con,"SELECT * FROM `follow` WHERE user_id='$uid' AND comp_id='$job_uid'");
									$countfl=mysqli_num_rows($cnt);
									if($countfl > 0)
									{
									?>
									<button class="btn btn-default bookmark"><i class="fa fa-star"></i> <?php echo $result12['title10']; ?></button>
									<?php } else { ?>
									<button class="btn btn-default bookmark" onclick="window.location.href='job_details?comp_id=<?php echo $rowa['comp_uid']; ?>&postid=<?php echo $_GET['id']; ?>&follow=follow'"><i class="fa fa-star-o"></i> <?php echo $result12['title9']; ?></button>
									<?php } } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="single-job-page-2 job-short-detail">
                                <div class="heading-inner">
                                    <p class="title"><?php echo $result12['title11']; ?></p>
                                </div>
                                <div class="job-desc job-detail-boxes">
                                    <?php echo $row['job_details']; ?>
                                    
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div class="widget">
                                <div class="widget-heading"><span class="title"><?php echo $result12['title12']; ?></span></div>
                                <ul class="short-decs-sidebar">
                                    
                                    <li>
                                        <div>
                                            <h4><?php echo $result12['title13']; ?>:</h4></div>
                                        <div><i class="fa fa-clock-o"></i><?php echo $row['job_exp']; ?></div>
                                    </li>
                                    
                                    <li>
                                        <div>
                                            <h4><?php echo $result12['title14']; ?>:</h4></div>
                                        <div><i class="fa fa-calendar"></i><?php echo $row['job_date']; ?></div>
                                    </li>
                                    <li>
                                        <div>
                                            <h4><?php echo $result12['title15']; ?>:</h4></div>
                                        <div><?php echo $row['currency']; ?> <?php echo $row['job_salary']; ?>/<?php echo $result12['title1']; ?> </div>
                                    </li>
                                </ul>
                            </div>
                            <aside>
                                <div class="company-detail widget">
                                    <div class="widget-heading"><span class="title"><?php echo $result12['title16']; ?></span></div>
                                    <div class="company-contact-detail">
                                        <table>
                                            <tr>
                                                <th><?php echo $result12['title17']; ?>:</th>
                                                <td> <?php echo $rowa['industry']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $result12['title18']; ?>:</th>
                                                <td> <?php echo $rowa['comp_email']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $result12['title19']; ?>:</th>
                                                <td> <?php echo $rowa['comp_phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $result12['title20']; ?>:</th>
                                                <td> <?php echo $rowa['comp_website']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $result12['title21']; ?>:</th>
                                                <td> <?php echo $rowa['comp_address']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </aside>
                            <div class="single-job-map">
                                <div id="map-contact"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="brand-logo-area clients-bg">
		<div class="clients-list">
			<?php
			$r2 = mysqli_query($con,"SELECT * FROM `brand`");
			while($row2 = mysqli_fetch_array($r2))
			{
			?>
			<div class="client-logo"> <a href="<?php echo $row2['brand_link']; ?>"><img src="images/clients/<?php echo $row2['brand_img']; ?>" class="img-responsive" alt="Brand Image" /></a> </div>
			<?php } ?>
		</div>
	</div>

     <?php include('footer.php'); ?>