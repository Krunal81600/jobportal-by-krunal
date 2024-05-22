<?php
	include('header.php');
	
	$id=$_GET['id'];
	$resapp=mysqli_query($con,"SELECT * FROM `make_resume` WHERE id='$id'");
	$rowapp = mysqli_fetch_array($resapp);
	
	$user_id=$rowapp['user_id'];
	
	$res=mysqli_query($con,"SELECT * FROM `user` WHERE id='$user_id' ");
	$rowre=mysqli_fetch_array($res);
	
	if(isset($_POST['submit']))
	{
		$from_email="info@africaglobalnetwork.com";
		$user_email = mysqli_real_escape_string($con, $_POST['user_email']);
		//Capture POST data from HTML form and Sanitize them, 
		$subject        = filter_var($_POST["subjectus"], FILTER_SANITIZE_STRING); //get subject from HTML form
		$message        = filter_var($_POST["candidate"], FILTER_SANITIZE_STRING); //message
		
		$file_tmp_name    = $_FILES['my_file']['tmp_name'];
		$file_name        = $_FILES['my_file']['name'];
		$file_size        = $_FILES['my_file']['size'];
		$file_type        = $_FILES['my_file']['type'];
		$file_error       = $_FILES['my_file']['error'];
		
		$handle = fopen($file_tmp_name, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$encoded_content = chunk_split(base64_encode($content));

		$boundary = md5("sanwebe");
		//header
		$to      = $user_email;
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "From:".$from_email."\r\n"; 
		$headers .= "Reply-To: ".$from_email."" . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
		
		//plain text 
		$body = "--$boundary\r\n";
		$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
		$body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
		$body .= chunk_split(base64_encode($message)); 
		
		//attachment
		$body .= "--$boundary\r\n";
		$body .="Content-Type: $file_type; name=".$file_name."\r\n";
		$body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
		$body .="Content-Transfer-Encoding: base64\r\n";
		$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
		$body .= $encoded_content; 
		
		$sentMail = @mail($to, $subject, $body, $headers);
		
		if($sentMail)
		{ 
		$id=$_GET['id'];
		$resapp=mysqli_query($con,"SELECT * FROM `make_resume` WHERE id='$id'");
		$rowapp = mysqli_fetch_array($resapp);
		$user_id=$rowapp['user_id'];
		
		$resappa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$user_id'");
		$rowappa = mysqli_fetch_array($resappa);
		
		$notifya= $rowappa['user']."  Apply for Make Resume Approve Check you mail for view.";
		$typea="admin";
		$linka="create_resume";

		$query=mysqli_query($con,"insert into notification(user_id,	byuser_id,notify,type,link) values('$user_id','0','$notifya','$typea','$linka')");
		
		mysqli_query($con,"UPDATE `make_resume` SET `send_mail`='1' WHERE id='$id'");
		?>
		<script>
		alert('Successfully Send');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='make_resume'";
		echo "</script>";
		}
		else
		{ ?>
		<script>
		alert('Something Wrong Try after some time');
		</script>
		<?php		
		echo "<script type='text/javascript'>";
		echo "window.location='make_resume'";
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
												<label>Attachment</label>
												<input type="file" class="form-control" name="my_file"></textarea>
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
								<input type="hidden" value="<?php echo $rowre['email']; ?>" name="user_email" >
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