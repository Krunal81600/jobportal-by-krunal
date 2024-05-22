<?php
	include('../config.php');
	include('header.php');
	$sql1 = mysqli_query($con,"SELECT * FROM `aboutus` WHERE id='1'");
	$result1 = mysqli_fetch_array($sql1);
	
	$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='about'");
	$result12 = mysqli_fetch_array($sql12);
		
	if(isset($_POST['submit']))
	{
		$about = mysqli_real_escape_string($con, $_POST['about']);
		$abouta = mysqli_real_escape_string($con, $_POST['abouta']);
		$whoweare = mysqli_real_escape_string($con, $_POST['whoweare']);
		$whatwedo = mysqli_real_escape_string($con, $_POST['whatwedo']);
		$ourmission = mysqli_real_escape_string($con, $_POST['ourmission']);
		
		$title1 = mysqli_real_escape_string($con, $_POST['title1']);
		$title2 = mysqli_real_escape_string($con, $_POST['title2']);
		$title3 = mysqli_real_escape_string($con, $_POST['title3']);
		$title4 = mysqli_real_escape_string($con, $_POST['title4']);
		$title5 = mysqli_real_escape_string($con, $_POST['title5']);
		$title6 = mysqli_real_escape_string($con, $_POST['title6']);
		
		$sql2 = mysqli_query($con,"UPDATE `aboutus` SET about='$about' ,abouta='$abouta' ,  whoweare='$whoweare' , whatwedo='$whatwedo' , ourmission='$ourmission' WHERE id='1'");
		
		$sql2 = mysqli_query($con,"UPDATE `all_title` SET title1='$title1',title2='$title2',title3='$title3',title4='$title4',title5='$title5',title6='$title6' WHERE page_nm='about'");
		
		if($sql2){ echo"<script type='text/javascript'>alert('Edit Successfully');</script>"; }
		echo"<script type='text/javascript'>window.location = 'aboutus.php';</script>";
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Edit <strong>About Us Section</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">About Us</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					  <h2 class="panel-title"><strong>Edit </strong> About Us</h2>
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
									  <h3><i class="icon-note"></i> <strong>Edit</strong> Content</h3>
									</div>
									<div class="panel-content">
									  <div class="row">
										<div class="col-md-12">
										  <textarea class="summernote" name="about"><?php echo $result1['about']; ?></textarea>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">About Second Part </label></div>
									  <div class="option-group col-sm-7">
										 <textarea name="abouta" rows="8" class="form-control"><?php echo $result1['abouta']; ?></textarea>
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Who We Are </label></div>
									  <div class="option-group col-sm-7">
										 <textarea name="whoweare" rows="8" class="form-control"><?php echo $result1['whoweare']; ?></textarea>
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">What We Do </label></div>
									  <div class="option-group col-sm-7">
										 <textarea name="whatwedo" rows="8" class="form-control"><?php echo $result1['whatwedo']; ?></textarea>
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Our Mission </label></div>
									  <div class="option-group col-sm-7">
										 <textarea name="ourmission" rows="8" class="form-control"><?php echo $result1['ourmission']; ?></textarea>
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
											<input type="text" name="title1" class="form-control" value="<?php echo $result12['title1']; ?>">
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
											<input type="text" name="title2" class="form-control" value="<?php echo $result12['title2']; ?>">
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
											<input type="text" name="title3" class="form-control" value="<?php echo $result12['title3']; ?>">
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
											<input type="text" name="title4" class="form-control" value="<?php echo $result12['title4']; ?>">
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
											<input type="text" name="title5" class="form-control" value="<?php echo $result12['title5']; ?>">
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
											<input type="text" name="title6" class="form-control" value="<?php echo $result12['title6']; ?>">
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