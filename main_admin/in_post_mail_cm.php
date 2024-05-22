<?php
	include('header.php');
	
	$id=$_GET['id'];
	$resapp=mysqli_query($con,"SELECT * FROM `interest` WHERE id='$id'");
	$rowapp = mysqli_fetch_array($resapp);
	
	$us_id=$rowapp['us_id'];
	$cm_id=$rowapp['cm_id'];
	$ps_id=$rowapp['ps_id'];
	
	$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$cm_id'");
	$rowab=mysqli_fetch_array($selab);
	
	$selabc=mysqli_query($con,"SELECT * FROM `user` WHERE id='$us_id'");
	$rowabc=mysqli_fetch_array($selabc);
	
	$aaaab=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$ps_id'");
    $rowaaap=mysqli_fetch_array($aaaab);
		
	if(isset($_POST['submit']))
	{
		$company = mysqli_real_escape_string($con, $_POST['company']);
		$comp_email = mysqli_real_escape_string($con, $_POST['comp_email']);
		$subjectcm = mysqli_real_escape_string($con, $_POST['subjectcm']);
		
		$toa      = $comp_email;
		$subjecta = $subjectcm;
		$messagea = $company;
		$header = "From: info@africaglobalnetwork.com\r\n"; 
		$headers= 'From: Website plc <info@africaglobalnetwork.com>' . "\r\n" .
				'Reply-To: info@africaglobalnetwork.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

		$mail=mail($toa, $subjecta, $messagea, $header);
		
		if($mail)
		{ 
			$id=$_GET['id'];
			$a=mysqli_query($con,"SELECT * FROM `interest` WHERE `id`='$id'");
			$row=mysqli_fetch_array($a);
			
			$us_id=$row['us_id'];
			$cm_id=$row['cm_id'];
			$ps_id=$row['ps_id'];
			$aa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$us_id'");
			$rowa=mysqli_fetch_array($aa);
			$user_resume=$rowa['id'];
			
			$aaaa=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$ps_id'");
			$rowaaa=mysqli_fetch_array($aaaa);
			$job_details=$rowaaa['id'];
			
			$notifya= $rowa['user']." is interested in your post for " .$rowaaa['job_title'];
			$typea="admin";
			$link="user_resume?id=$user_resume";

			$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$us_id','$cm_id','$notifya','$typea','$linka')");
			
			$notifya= "your interested in ".$rowaaa['job_title']." post successfully approved";
			$typea="admin";
			$link="job_details?id=$job_details";

			$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$us_id','$cm_id','$notifya','$typea','$linka')");
			
			$success_send=$row['in_status_cm'];
			$total=$success_send+1;
			mysqli_query($con,"UPDATE `interest` SET `in_status_cm`='$total' WHERE id='$id'");
		
		?>
		<script>
		alert('Successfully Send');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='interest_post'";
		echo "</script>";
		}
		else
		{ ?>
		<script>
		alert('Something Wrong Try after some time');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='in_post_mail'";
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
										<h2>Interested By : <?php echo $rowabc['user']; ?></h2>
										<h2>Interested In : <?php echo $rowab['industry']; ?></h2>
										<h2>POST TITLE : <?php echo $rowaaap['job_title']; ?></h2>
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
									<h3>Mail for <strong>Company</strong></h3>
										<div class="form-group">							  
											<div class="row">
											  <div class="col-sm-12">
												<div class="form-group">
												  <div class="option-group col-sm-12">
													 <input type="text" placeholder="Subject For Company" name="subjectcm" class="form-control">
												  </div>
												</div>
											  </div>
											</div>  
										</div>
									  <div class="row">
										<div class="col-md-12">
										  <textarea class="summernote" name="company"></textarea>
										</div>
									  </div>
									</div>
								  </div>
								</div>
								<input type="hidden" value="<?php echo $rowab['comp_email']; ?>" name="comp_email" >
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