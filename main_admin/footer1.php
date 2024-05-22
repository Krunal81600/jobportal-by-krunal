<?php
	include('../config.php');
	include('header.php');
	$sql1 = mysqli_query($con,"SELECT * FROM `footer1` WHERE id='1'");
	$result1 = mysqli_fetch_array($sql1);
		
	if(isset($_POST['submit']))
	{
		$content = mysqli_real_escape_string($con, $_POST['content']);
		$twitter = mysqli_real_escape_string($con, $_POST['twitter']);
		$skype = mysqli_real_escape_string($con, $_POST['skype']);
		$messanger = mysqli_real_escape_string($con, $_POST['messanger']);
		$facebook = mysqli_real_escape_string($con, $_POST['facebook']);
		$indeed = mysqli_real_escape_string($con, $_POST['indeed']);
		$googleplus = mysqli_real_escape_string($con, $_POST['googleplus']);
		
		if($_FILES['logo']['name'])
		{
			$img = $_FILES['logo']['name'];
			$size = $_FILES['logo']['size'];
			$tmp = $_FILES['logo']['tmp_name'];
			$err =array();
			if($size>204896)
			{
				$err[]="Size Of Logo Too Large";
			}
			$rnd = mt_rand(0,9999);
			$image = 'img'.$rnd.$img;
			$logo = str_replace(" ","_",$image);
			if(count($err) === 0)
			{
			    move_uploaded_file($tmp,"../images/".$logo);
				$sql2 = mysqli_query($con,"UPDATE `footer1` SET logo='$logo' , content='$content' , twitter='$twitter' , skype='$skype' , messanger='$messanger' , facebook='$facebook' , indeed='$indeed', googleplus='$googleplus' WHERE id='1'");
				if($sql2){
					echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
					echo"<script type='text/javascript'>window.location = 'footer1';</script>";
				}
			}else{
				foreach($err as $error)
				{
					echo"<script type='text/javascript'>alert('".$error."');</script>";
					echo"<script type='text/javascript'>window.location='footer1';</script>";
				}
			}
		}
		else
		{
			$sql2 = mysqli_query($con,"UPDATE `footer1` SET content='$content' , twitter='$twitter' , skype='$skype' , messanger='$messanger' , facebook='$facebook' , indeed='$indeed', googleplus='$googleplus' WHERE id='1'");
			if($sql2){ echo"<script type='text/javascript'>alert('Edit Successfully');</script>"; }
			echo"<script type='text/javascript'>window.location = 'footer1';</script>";
		}
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Edit <strong>Footer Section</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Make</a>
                </li>
                <li><a href="tables.html">Tables</a>
                </li>
                <li class="active">Tables Dynamic</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					  <h2 class="panel-title"><strong>Edit </strong> Footer1</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
								  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Choose Logo </label></div>
									  <div class="option-group col-sm-7">
										<input type="file" name="logo">
									  </div>
									</div>
								  </div>
								  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Now Logo  </label></div>
									  <div class="col-sm-7"> <img src="../images/<?php echo $result1['logo']; ?>" alt="logo" height="100" width="100"></div>
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
										  <h3>HTML <strong>Editor</strong></h3>
										  <textarea class="summernote" name="content"><?php echo $result1['content']; ?></textarea>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
							
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Twitter Url </label></div>
									  <div class="option-group col-sm-7">
										 <input type="text" name="twitter" value="<?php echo $result1['twitter']; ?>" class="form-control">
									  </div>
									</div>
								  </div>
								  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Skype Url </label></div>
									  <div class="option-group col-sm-7">
										 <input type="text" name="skype" value="<?php echo $result1['skype']; ?>" class="form-control">
									  </div>
									</div>
								  </div>
								</div>  
							</div>  
							
							<div class="form-group">							
								<div class="row">
								  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Facebook Url </label></div>
									  <div class="option-group col-sm-7">
										 <input type="text" name="facebook" value="<?php echo $result1['facebook']; ?>" class="form-control">
									  </div>
									</div>
								  </div>
         						  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Messanger Url </label></div>
									  <div class="option-group col-sm-7">
										 <input type="text" name="messanger" value="<?php echo $result1['messanger']; ?>" class="form-control">
									  </div>
									</div>
								  </div>
								</div>  
							</div>  
							
							<div class="form-group">							 
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
										  <div class="col-sm-5"><label class="control-label">Linkedin Url </label></div>
										  <div class="option-group col-sm-7">
											 <input type="text" name="indeed" value="<?php echo $result1['indeed']; ?>" class="form-control">
										  </div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										  <div class="col-sm-5"><label class="control-label">Google+ Url </label></div>
										  <div class="option-group col-sm-7">
											 <input type="text" name="googleplus" value="<?php echo $result1['googleplus']; ?>" class="form-control">
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