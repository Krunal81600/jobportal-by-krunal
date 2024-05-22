<?php
	include('header.php');
	
	$id=$_GET['id'];
	$resapp=mysqli_query($con,"SELECT * FROM `job_app` WHERE id='$id'");
	$rowapp = mysqli_fetch_array($resapp);
	
	$job_app_uid=$rowapp['job_app_uid'];
	$job_app_compid=$rowapp['job_app_compid'];
	$job_app_post=$rowapp['job_app_post'];
	
	$res=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$job_app_post' ");
	$rowre=mysqli_fetch_array($res);
	
	
	$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_app_compid'");
	$rowab=mysqli_fetch_array($selab);
		
	$selabc=mysqli_query($con,"SELECT * FROM `user` WHERE id='$job_app_uid'");
	$rowabc=mysqli_fetch_array($selabc);
		
	if(isset($_POST['submit']))
	{
		$candidate = mysqli_real_escape_string($con, $_POST['candidate']);
		$user_email = mysqli_real_escape_string($con, $_POST['user_email']);
		$subjectus = mysqli_real_escape_string($con, $_POST['subjectus']);
		
		$to      = $user_email;
		$subject = $subjectus;
		$message = $candidate ;
		$header = "From: info@africaglobalnetwork.com\r\n"; 
		$headers= 'From: Website plc <info@africaglobalnetwork.com>' . "\r\n" .
				'Reply-To: info@africaglobalnetwork.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

		$mail=mail($to, $subject, $message, $header);
		
		if($mail)
		{ 
		$id=$_GET['id'];
		$resapp=mysqli_query($con,"SELECT * FROM `job_app` WHERE id='$id'");
		$rowapp = mysqli_fetch_array($resapp);
		$job_app_uid=$rowapp['job_app_uid'];
		$job_app_compid=$rowapp['job_app_compid'];
		$job_app_post=$rowapp['job_app_post'];
		
		$res=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$job_app_post' ");
		$rowre=mysqli_fetch_array($res);
		$job_details=$rowre['id'];
		
		$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_app_compid'");
		$rowab=mysqli_fetch_array($selab);
		$company_details=$rowab['comp_uid'];
		
		$selabc=mysqli_query($con,"SELECT * FROM `user` WHERE id='$job_app_uid'");
		$rowabc=mysqli_fetch_array($selabc);
		$user_resume=$rowabc['id'];
		
		$notifya= $rowabc['user']."  Apply for job post(".$rowre['job_title'].").";
		$typea="admin";
		$linka="user_resume?id=$user_resume";

		$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$job_app_uid','$job_app_compid','$notifya','$typea','$linka')");
		
		$notify= "Successfully Apply for job post(".$rowre['job_title'].")";
		$type="admin";
		$link="job_details?id=$job_details";

		$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$job_app_compid','$job_app_uid','$notify','$type','$link')");
		
		$success_send=$rowapp['success_send'];
		$total=$success_send+1;
		
		mysqli_query($con,"UPDATE `job_app` SET `success_send`='$total' WHERE id='$id'");
		?>
		<script>
		alert('Successfully Send');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='job_apply'";
		echo "</script>";
		}
		else
		{ ?>
		<script>
		alert('Something Wrong Try after some time');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='job_apply'";
		echo "</script>";
		}
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Send <strong>Mail</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Send Mail</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					  <h2 class="panel-title"><strong>Send </strong> Mail</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" enctype="multipart/form-data">
						  <div class="form-group">				 
		    				  <div class="row">
									<div class="col-md-12">
										<h2>APPLIED By : <?php echo $rowabc['user']; ?></h2>
										<h2>POST BY : <?php echo $rowab['industry']; ?></h2>
										<h2>POST TITLE : <?php echo $rowre['job_title']; ?></h2>
									</div>
								</div>
							</div>
							<div class="form-group">				 
		    				  <div class="row">
								<div class="col-md-12 portlets">
								  <div class="panel">
									<div class="panel-header panel-controls">
									</div>
									<div class="panel-content">
									<h3>Mail for <strong>Candidate</strong></h3>
										<div class="form-group">							  
											<div class="row">
											  <div class="col-sm-12">
												<div class="form-group">
												  <div class="option-group col-sm-12">
													 <input type="text" placeholder="Subject For Candidate" name="subjectus" class="form-control">
												  </div>
												</div>
											  </div>
											</div>  
										</div>
										  <div class="row">
											<div class="col-md-12">
											  <textarea class="summernote" name="candidate"></textarea>
											</div>
										  </div>
									</div>
								  </div>
								</div>
								<input type="hidden" value="<?php echo $rowabc['email']; ?>" name="user_email" >
							  </div>
							</div>
							<div class="form-group">	
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
										  <div class="col-sm-5"></div>
										  <div class="col-sm-7"><button type="submit" name="submit" class="btn btn-primary btn-lg"> Send </button></div>
										</div>
									</div>
								</div>
							</div>
						  </form>
						</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
        
<?php
	include('footer.php');
?>