<?php
include('header.php');
$session_id=$_SESSION['member_id'];
$selcm=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$session_id'");
$rowcm=mysqli_fetch_array($selcm);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar2'");
$result123 = mysqli_fetch_array($sql123);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='coresume'");
$result12 = mysqli_fetch_array($sql12);

error_reporting(0);
if($_REQUEST['id'])
{
	$id=$_GET['id'];
	mysqli_query($con,"DELETE FROM `job_app` WHERE id='$id'");
	echo "<script type='text/javascript'>";
	echo "window.location='company-dashboard-resume'";
	echo "</script>";
}
if($_REQUEST['hire'])
{
	$hire_compid=$_SESSION['member_id'];
	$hire_uid=$_GET['hire_uid'];
	$hdate=date('Y-m-d H:i:s');
	
	mysqli_query($con,"INSERT INTO `hire`(`hire_uid`, `hire_compid`, `hdate`) VALUES ('$hire_uid','$hire_compid','$hdate')");
	
	$notify="Hire Candidate,schedule interview with this candidate";
	$type="user";
	$link="hire";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$hire_compid','$notify','$type','$link','$jct')");
	
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
                                    <img class="img-responsive center-block" src="upload/<?php echo $rowcm['comp_logo']; ?>" alt="Image">
                                </div>
                                <div class="text-center dashboard-logo-sidebar-title">
                                    <h4><?php echo $rowcm['industry']; ?></h4>
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
                                        <li  class="active">
                                            <a href="company-dashboard-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title3']; ?></a>
                                        </li>
                                        <li>
                                            <a href="company-dashboard-active-jobs"> <i class="fa  fa-list-alt"></i> <?php echo $result123['title4']; ?></a>
                                        </li>
                                        <li>
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
                            <div class="resume-list">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th><?php echo $result12['title2']; ?></th>
                                                <th><?php echo $result12['title3']; ?></th>
                                                <th><?php echo $result12['title4']; ?></th>
                                                <th><?php echo $result12['title5']; ?></th>
                                                <th><?php echo $result12['title6']; ?></th>
                                                <th><?php echo $result12['title7']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$no=0;
										$a=mysqli_query($con,"SELECT * FROM `job_app` WHERE job_app_compid='$session_id' ORDER BY  `id` DESC");
										while($row=mysqli_fetch_array($a))
										{
											$job_app_uid=$row['job_app_uid'];
											$job_app_post=$row['job_app_post'];
											
											$selus=mysqli_query($con,"SELECT * FROM `user` WHERE id='$job_app_uid'");
											$rowus=mysqli_fetch_array($selus);

											$selps=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$job_app_post'");
											$rowps=mysqli_fetch_array($selps);
											
											$selrs=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$job_app_uid' ORDER BY  `id` DESC");
											$rowrs=mysqli_fetch_array($selrs);
											$no=$no+1;
										?>
                                            <tr>
                                                <td scope="row"><?php echo $no; ?></td>
                                                <td><h5><?php echo $rowus['fname']." ".$rowus['lname']; ?></h5></td>
                                                <td><h5><?php echo $rowps['job_title']; ?></h5></td>
                                                <td><a class="btn btn-primary" href="resume/<?php echo $rowrs['resume_nm']; ?>"> <?php echo $result12['title8']; ?> </a></td>
                                                <td><a class="btn btn-info" href="user_resume?hire_uid=<?php echo $rowa['id']; ?>&hire=hire"> <?php echo $result12['title9']; ?> </a></td>
                                                <td><a class="btn btn-danger" href="company-dashboard-resume?id=<?php echo $row['id']; ?>"> <?php echo $result12['title7']; ?> </a></td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
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