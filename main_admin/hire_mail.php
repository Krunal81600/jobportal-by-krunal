<?php
	include('header.php');
	
	$id=$_GET['id'];
	$resapp=mysqli_query($con,"SELECT * FROM `hire` WHERE id='$id'");
	$rowapp = mysqli_fetch_array($resapp);
	
	$hire_uid=$rowapp['hire_uid'];
	$hire_compid=$rowapp['hire_compid'];
	
	$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$hire_compid'");
	$rowab=mysqli_fetch_array($selab);
	
	$selabc=mysqli_query($con,"SELECT * FROM `user` WHERE id='$hire_uid'");
	$rowabc=mysqli_fetch_array($selabc);
		
	if(isset($_POST['submit']))
	{
		$candidate =mysqli_real_escape_string($con,  $_POST['candidate']);
		$company = mysqli_real_escape_string($con, $_POST['company']);
		$user_email = mysqli_real_escape_string($con, $_POST['user_email']);
		$comp_email = mysqli_real_escape_string($con, $_POST['comp_email']);
		
		$to      = $user_email;
		$subject = 'You are hired by company';
		$message = $candidate ;
		$header = "From: info@africaglobalnetwork.com\r\n"; 
		$headers= 'From: Website plc <info@africaglobalnetwork.com>' . "\r\n" .
				'Reply-To: info@africaglobalnetwork.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

		$mail=mail($to, $subject, $message, $header);
		
		$toa      = $comp_email;
		$subjecta = 'Hired a Candidate';
		$messagea = $company;
		$header = "From: info@africaglobalnetwork.com\r\n"; 
		$headers= 'From: Website plc <info@africaglobalnetwork.com>' . "\r\n" .
				'Reply-To: info@africaglobalnetwork.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

		$mail=mail($toa, $subjecta, $messagea, $header);
		
		if($mail)
		{ 
		$id=$_GET['id'];
		mysqli_query($con,"UPDATE `hire` SET `hire_status`='1' WHERE id='$id'");
		
		$a=mysqli_query($con,"SELECT * FROM `hire` WHERE `id`='$id'");
	    $row=mysqli_fetch_array($a);
		
		$hire_uid=$row['hire_uid'];
		$hire_compid=$row['hire_compid'];

		$aa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$hire_uid'");
		$rowa=mysqli_fetch_array($aa);
		
		$selectaaa=mysqli_query($con,"SELECT * FROM `company` where comp_uid='$hire_compid'");
		$rowaaa=mysqli_fetch_array($selectaaa);
		
		$notifya= $rowaaa['industry']."  reviewed your resume and will be notified as soon as possible.";
		$typea="admin";
		$linka="#";

		$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$hire_compid','$hire_uid','$notifya','$typea','$linka')");
		
		?>
		<script>
		alert('Successfully Send');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='hire'";
		echo "</script>";
		}
		else
		{ ?>
		<script>
		alert('Something Wrong Try after some time');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='hire_mail'";
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
								<div class="col-md-12 portlets">
								  <div class="panel">
									<div class="panel-header panel-controls">
									</div>
									<div class="panel-content">
									  <div class="row">
										<div class="col-md-12">
										  <h3>Mail for <strong>Candidate</strong></h3>
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
								<div class="col-md-12 portlets">
								  <div class="panel">
									<div class="panel-header panel-controls">
									</div>
									<div class="panel-content">
									  <div class="row">
										<div class="col-md-12">
										  <h3>Mail for <strong>Company</strong></h3>
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