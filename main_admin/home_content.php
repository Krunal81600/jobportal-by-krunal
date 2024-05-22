<?php
	include('../config.php');
	include('header.php');
	$sql1 = mysqli_query($con,"SELECT * FROM `home_content` WHERE id='1'");
	$result1 = mysqli_fetch_array($sql1);
	
	$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='index'");
	$result12 = mysqli_fetch_array($sql12);
		
	if(isset($_POST['submit']))
	{
		$search_title = mysqli_real_escape_string($con, $_POST['search_title']);
		$home_title = mysqli_real_escape_string($con, $_POST['home_title']);
		$homecn = mysqli_real_escape_string($con, $_POST['homecn']);
		$title1 = mysqli_real_escape_string($con, $_POST['title1']);
		$title2 = mysqli_real_escape_string($con, $_POST['title2']);
		$title3 = mysqli_real_escape_string($con, $_POST['title3']);
		$title4 = mysqli_real_escape_string($con, $_POST['title4']);
		$title5 = mysqli_real_escape_string($con, $_POST['title5']);
		$title6 = mysqli_real_escape_string($con, $_POST['title6']);
		$title7 = mysqli_real_escape_string($con, $_POST['title7']);
		$title8 = mysqli_real_escape_string($con, $_POST['title8']);
		$title9 = mysqli_real_escape_string($con, $_POST['title9']);
		$title10 = mysqli_real_escape_string($con, $_POST['title10']);
		$title11 = mysqli_real_escape_string($con, $_POST['title11']);
		$title12 = mysqli_real_escape_string($con, $_POST['title12']);
		$title13 = mysqli_real_escape_string($con, $_POST['title13']);
		
		if($_FILES['homeimg']['name'])
		{
			$img = $_FILES['homeimg']['name'];
			$size = $_FILES['homeimg']['size'];
			$tmp = $_FILES['homeimg']['tmp_name'];
						
			$err =array();
			if($size>204896)
			{
				$err[]="Size Of Image Too Large";
			}
			$rnd = mt_rand(0,9999);
			$image = 'img'.$rnd.$img;
			$logo = str_replace(" ","_",$image);
			if(count($err) === 0)
			{
			    move_uploaded_file($tmp,"../images/".$logo);
				$sql2 = mysqli_query($con,"UPDATE `home_content` SET search_title='$search_title' , home_title='$home_title' , homecn='$homecn' , homeimg='$logo' WHERE id='1'");
				
				$sql2 = mysqli_query($con,"UPDATE `all_title` SET title1='$title1',title2='$title2',title3='$title3',title4='$title4',title5='$title5',title6='$title6',title7='$title7',title8='$title8',title9='$title9',title10='$title10',title11='$title11',title12='$title12',title13='$title13' WHERE page_nm='index'");
				
				if($sql2){
					echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
					echo"<script type='text/javascript'>window.location = 'home_content';</script>";
				}
			}else{
				foreach($err as $error)
				{
					echo"<script type='text/javascript'>alert('".$error."');</script>";
					echo"<script type='text/javascript'>window.location='home_content';</script>";
				}
			}
		}
		else
		{
			$sql2 = mysqli_query($con,"UPDATE `home_content` SET search_title='$search_title' , home_title='$home_title' , homecn='$homecn' WHERE id='1'");
			
			$sql2 = mysqli_query($con,"UPDATE `all_title` SET title1='$title1',title2='$title2',title3='$title3',title4='$title4',title5='$title5',title6='$title6',title7='$title7',title8='$title8',title9='$title9',title10='$title10',title11='$title11',title12='$title12',title13='$title13' WHERE page_nm='index'");
			
			if($sql2){ echo"<script type='text/javascript'>alert('Edit Successfully');</script>"; }
			echo"<script type='text/javascript'>window.location = 'home_content';</script>";
		}
		
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
								  <div class="col-sm-12">
									<div class="form-group">
									  <label class="control-label">Search Title </label>
									  <div class="col-sm-12">
											<input type="text" name="search_title" class="form-control" value="<?php echo $result1['search_title']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <label class="control-label">Title </label>
									  <div class="col-sm-12">
											<input type="text" name="home_title" class="form-control" value="<?php echo $result1['home_title']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
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
										  <textarea rows="6" name="homecn" class="form-control"><?php echo $result1['homecn']; ?></textarea>
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
									  <label class="control-label">Select Image </label>
									  <div class="col-sm-12">
											<div class="col-sm-8">
												<input type="file" name="homeimg">
											</div>
											<div class="col-sm-4">
												<img src="../images/<?php echo $result1['homeimg']; ?>" alt="home_img" height="150" width="150">
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
									  <div class="col-sm-12">
											<input type="text" name="title7" class="form-control" value="<?php echo $result12['title7']; ?>">
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
											<input type="text" name="title8" class="form-control" value="<?php echo $result12['title8']; ?>">
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
											<input type="text" name="title9" class="form-control" value="<?php echo $result12['title9']; ?>">
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
											<input type="text" name="title10" class="form-control" value="<?php echo $result12['title10']; ?>">
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
											<input type="text" name="title11" class="form-control" value="<?php echo $result12['title11']; ?>">
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
											<input type="text" name="title12" class="form-control" value="<?php echo $result12['title12']; ?>">
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
											<input type="text" name="title13" class="form-control" value="<?php echo $result12['title13']; ?>">
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