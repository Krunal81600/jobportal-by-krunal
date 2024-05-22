<?php
	include('../config.php');
	include('header.php');
	
	$log=mysqli_query($con,"SELECT * FROM `logo` WHERE id='1'");
	$rowlogo=mysqli_fetch_array($log);
	
	if(isset($_POST['submit']))
	{
		$error = array();
		$accepteble = array
		(
			'image/jpg',
			'image/jpeg',
			'image/png'
		);
		
		$img = $_FILES['logonm']['name'];
		$tmp = $_FILES['logonm']['tmp_name'];
		$size = $_FILES['logonm']['size'];
		$type = $_FILES['logonm']['type'];
		
		if($size >= 2097152 || ($size == 0))
		{
			$error[] = "Logo Size too large. File must be less than 2 megabytes.$size";
		}
		if(!in_array($type,$accepteble) && (!empty($type)))
		{
			$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
		}
		
		if($_FILES['logonm']['name'])
		{
			if(count($error) == 0)
			{
			
			$rnd = mt_rand(1,99999);
			$fnm = "img". $rnd . $img;
			$lfile = str_replace(' ','_',$img);
			$r = move_uploaded_file($tmp,'../images/'.$lfile);
			$query = mysqli_query($con,"UPDATE `logo` SET `logonm`='$lfile' WHERE id='1'");
			
			echo '<script>alert("Successfully Updated");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'logo'";
			echo"</script>";
			
			}
			else
			{
				foreach($error as $err)
				{
					echo '<script>alert("'.$err.'");</script>';
					echo"<script type='text/javascript'>";	
					echo"window.location = 'logo'";
					echo"</script>";
				}
				die();
			}
		}
		else
		{
			$lfile=$row['logonm'];
		}
	}
	
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Change <strong>Logo</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Change Change</li>
              </ol>
            </div>
          </div>
		 
		<div class="row" style="min-height:590px">
			<div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					
					  <h2 class="panel-title"><strong> Change </strong> Logo</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" enctype="multipart/form-data">
							<div class="row">
							  <div class="col-sm-6">
								<div class="form-group">
									<div class="form-group">
									  <label class="control-label">Current Logo </label>
									  <div style="width:100%;float:left;">
									  <img src="../images/<?php echo $rowlogo['logonm']; ?>" alt="Logo" height="250" width="400">
									  </div>
									</div>
								  </div>
							  </div>
							  <div class="col-sm-6">
								  <div class="form-group">
									<label class="control-label">Select New One </label>
									<div class="append-icon">
									  <input type="file" name="logonm" class="form-control"  required>
									  <i class="icon-plus"></i>
									 </div>
								  </div>
							</div>
							</div>
							<div class="row">
							   <div class="col-sm-12"> 
								 <div class="text-center  m-t-20">
									<button type="submit" class="btn btn-embossed btn-primary" name="submit">Update</button>
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