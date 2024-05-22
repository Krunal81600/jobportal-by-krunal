<?php
	include('../config.php');
	error_reporting(0);
	include('header.php');
	$id = $_REQUEST['editid'];
	$sqli1 = mysqli_query($con,"SELECT * FROM `contect-info` WHERE id='$id'");
	$result1= mysqli_fetch_array($sqli1);
	if(isset($_POST['edit']))
	{
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$mail1 = $_POST['mail1'];
		$mail2 = $_POST['mail2'];
		$phone1 = $_POST['phone1'];
		$phone2 = $_POST['phone2'];
		$time = $_POST['time'];
		
		$result2 = mysqli_query($con,"UPDATE `contect-info` SET address1='$address2' , address2='$address2' , mail1='$mail1' , mail2='$mail1' , phone1='$phone1' , phone2='$phone2' , time='$time' WHERE id='$id'");
		if($result2){
			echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
			echo"<script type='text/javascript'>";
			echo"window.location='footer4.php'";
			echo"</script>";
		}
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2><strong>CATEGORY</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Dashboard</a>
                </li>
                <li class="active">Category</li>
              </ol>
            </div>
          </div>
			<div class="row">
				<div class="col-lg-12 portlets">
					<div class="panel panel-default no-bd">
						<div class="panel-header bg-dark">
						  <h2 class="panel-title"><strong> Edit </strong> Footer Contect </h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST">
							   <div class="form-group">										
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Branch Address :</label>
												<div class="append-icon">
												  <textarea name="address1" class="form-control" required value="<?php echo $result1['address1']; ?>"><textarea>
												  <i class="icon-location"></i>
												 </div>
											 </div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">office Address :</label>
												<div class="append-icon">
												  <textarea name="address2" class="form-control" required value="<?php echo $result1['address2']; ?>"><textarea>
												  <i class="icon-location"></i>
												 </div>
											 </div>
										</div>
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<div class="col-sm-4"><label class="control-label">Email :</label></div>
												<div class="append-icon col-sm-8">
												  <input name="mail1" class="form-control" type="email"><i class="icon-envelopes"></i>
												 </div>
											 </div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">										
												<div class="col-sm-4"><label class="control-label">Business Email :</label></div>
												<div class="append-icon col-sm-8">
												  <input name="mail2" class="form-control" type="email"><i class="icon-envelopes"></i>
												 </div>
											 </div>
										</div>
									</div>
								</div>
								
								<div class="form-group">	
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<div class="col-sm-4"><label class="control-label">Branch Phone :</label></div>
												<div class="append-icon col-sm-8">
												  <input name="phone1" class="form-control" type="text"><i class="icon-phone"></i>
												 </div>
											 </div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">										
												<div class="col-sm-4"><label class="control-label">Office Phone :</label></div>
												<div class="append-icon col-sm-8">
												  <input name="phone2" class="form-control" type="text"><i class="icon-phone"></i>
												 </div>
											 </div>
										</div>
									</div>
								</div>
								
								<div class="form-group">	
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<div class="col-sm-4"><label class="control-label">Time :</label></div>
												<div class="append-icon col-sm-8">
												  <input name="time" class="form-control" type="text"><i class="icon-timer"></i>
												 </div>
											 </div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">										
												<div class="col-sm-4"></div>
												<div class="append-icon col-sm-8">
												  <button type="submit" class="btn btn-embossed btn-primary" name="edit">Edit Contect </button>
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