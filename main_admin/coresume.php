<?php
	include('../config.php');
	include('header.php');
	$sql1 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='coresume'");
	$result1 = mysqli_fetch_array($sql1);
		
	if(isset($_POST['submit']))
	{
		$title1 = mysqli_real_escape_string($con, $_POST['title1']);
		$title2 = mysqli_real_escape_string($con, $_POST['title2']);
		$title3 = mysqli_real_escape_string($con, $_POST['title3']);
		$title4 = mysqli_real_escape_string($con, $_POST['title4']);
		$title5 = mysqli_real_escape_string($con, $_POST['title5']);
		$title6 = mysqli_real_escape_string($con, $_POST['title6']);
		$title7 = mysqli_real_escape_string($con, $_POST['title7']);
		$title8 = mysqli_real_escape_string($con, $_POST['title8']);
		$title9 = mysqli_real_escape_string($con, $_POST['title9']);
		
		$sql2 = mysqli_query($con,"UPDATE `all_title` SET title1='$title1',title2='$title2',title3='$title3',title4='$title4',title5='$title5',title6='$title6',title7='$title7',title8='$title8' WHERE page_nm='coresume'");
		
		if($sql2){
			echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
			echo"<script type='text/javascript'>window.location = 'coresume';</script>";
		}
			
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Edit <strong>Company Resume Page</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Company Resume</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					  <h2 class="panel-title"><strong>Edit </strong> Company Resume Page</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" enctype="multipart/form-data">
						  
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title1" class="form-control" value="<?php echo $result1['title1']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title2" class="form-control" value="<?php echo $result1['title2']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title3" class="form-control" value="<?php echo $result1['title3']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title4" class="form-control" value="<?php echo $result1['title4']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title5" class="form-control" value="<?php echo $result1['title5']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title6" class="form-control" value="<?php echo $result1['title6']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title7" class="form-control" value="<?php echo $result1['title7']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title8" class="form-control" value="<?php echo $result1['title8']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title9" class="form-control" value="<?php echo $result1['title9']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
										  <div class="col-sm-5"></div>
										  <div class="col-sm-7"><button type="submit" name="submit" class="btn btn-primary btn-lg"> Edit </button></div>
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