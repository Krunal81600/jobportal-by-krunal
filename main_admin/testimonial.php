<?php
	include('../config.php');
	error_reporting(0);
	include('header.php');
	if(isset($_POST['submit']))
	{
		$testi_title=mysqli_real_escape_string($con, $_POST['testi_title']);
		$testi_content=mysqli_real_escape_string($con, $_POST['testi_content']);
		$testi_user=mysqli_real_escape_string($con, $_POST['testi_user']);
		$testi_location=mysqli_real_escape_string($con, $_POST['testi_location']);
		
		$error = array();
		$accepteble = array
		(
			'image/jpg',
			'image/jpeg',
			'image/png'
		);
		
		$img = $_FILES['testi_img']['name'];
		$tmp = $_FILES['testi_img']['tmp_name'];
		$size = $_FILES['testi_img']['size'];
		$type = $_FILES['testi_img']['type'];
		
		if($size >= 2097152 || ($size == 0))
		{
			$error[] = "Testimonial Image too large. File must be less than 2 megabytes.$size";
		}
		if(!in_array($type,$accepteble) && (!empty($type)))
		{
			$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
		}
		
		if(count($error) == 0)
		{
		
		$rnd = mt_rand(1,99999);
		$fnm = "img". $rnd . $img;
		$lfile = str_replace(' ','_',$img);
		$r = move_uploaded_file($tmp,'../images/users/'.$lfile);
		
		$query = mysqli_query($con,"INSERT INTO `testimonial`(`testi_title`,`testi_content`,`testi_img`,`testi_user`,`testi_location`) VALUES('$testi_title','$testi_content','$lfile','$testi_user','$testi_location')");
		if($query){ echo'<script type="text/javascript">alert("Testimonial Inserted..")</script>'; }
		}
		else
		{
			foreach($error as $err)
			{
				echo '<script>alert("'.$err.'");</script>';
				echo"<script type='text/javascript'>";	
				echo"window.location = 'testimonial'";
				echo"</script>";
			}
			die();
		}
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2><strong>Testimonial</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Dashboard</a>
                </li>
                <li class="active">Testimonial</li>
              </ol>
            </div>
          </div>
		 <?php
			if(empty($_REQUEST['opr']))
			{
		 ?>	  <div class="row">
				<div class="col-lg-12 portlets">
					<div class="panel panel-default no-bd">
						<div class="panel-header bg-dark">
						  <h2 class="panel-title"><strong>Add</strong> Testimonial</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Testimonial Title :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_title">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Testimonial Content :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_content">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Testimonial Member Name :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_user">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Member Location :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_location">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Testimonial Member Profile :</label>
											<div class="append-icon">
												<input type="file" class="form-control" name="testi_img">
											 </div>
										 </div>
									</div> 
									<div class="col-sm-6"> 
										 <div class="text-center  m-t-20">
											<button type="submit" class="btn btn-embossed btn-primary" name="submit">Add Testimonial</button>
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
			<div class="row">
				<div class="col-lg-12 portlets">
				  <div class="panel">
					<div class="panel-header panel-controls">
					  <h3><i class="fa fa-table"></i> <strong>Testimonial List</strong></h3>
					</div>
					<div class="panel-content pagination2 table-responsive">
					  <table class="table table-hover table-dynamic">
						<thead>
						  <tr>
							<th> No. </th>
							<th> Testimonial Title </th>
							<th> Content </th>
							<th> User Name </th>
							<th> Location </th>
							<th> Profile </th>
							<th> Edit </th>
							<th> Remove </th>
						  </tr>
						</thead>
						<tbody>
						<?php 
						$num = 0;
						$sql1 = mysqli_query ($con,"SELECT * FROM `testimonial` ORDER BY  `id` DESC");
						while($row1 = mysqli_fetch_array($sql1))
						{	$num = $num + 1;
						?>
						  <tr>
							<td><?php echo $num; ?></td>
							<td><?php echo $row1['testi_title']; ?></td>
							<td><?php echo $row1['testi_content']; ?></td>
							<td><?php echo $row1['testi_user']; ?></td>
							<td><?php echo $row1['testi_location']; ?></td>
							<td><img src="../images/users/<?php echo $row1['testi_img']; ?>" height="80" width="80"></td>
							<td><a href="testimonial?editid=<?php echo $row1['id']; ?>&opr=edit" class="btn btn-primary">Edit</a></td>
							<td><a href="testimonial?deleteid=<?php echo $row1['id']; ?>&opr=remove" class="btn btn-primary">Remove</a></td>
						  </tr>
						 <?php 
						 }
						?>
						</tbody>
					  </table>
					</div>
				  </div>
				</div>
			  </div>
			<?php
			} 
			else
			{
				if($_REQUEST['opr'] == "edit")
				{ 
					$id = $_REQUEST['editid'];
					$sqli1 = mysqli_query($con,"SELECT * FROM `testimonial` WHERE id='$id'");
					$result1= mysqli_fetch_array($sqli1);
					if(isset($_POST['edit']))
					{
						$testi_title=$_POST['testi_title'];
						$testi_content=$_POST['testi_content'];
						$testi_user=$_POST['testi_user'];
						$testi_location=$_POST['testi_location'];
						
						$error = array();
						$accepteble = array
						(
							'image/jpg',
							'image/jpeg',
							'image/png'
						);
						if($_FILES['testi_img']['name'])
						{
						$img = $_FILES['testi_img']['name'];
						$tmp = $_FILES['testi_img']['tmp_name'];
						$size = $_FILES['testi_img']['size'];
						$type = $_FILES['testi_img']['type'];
						
						if($size >= 2097152 || ($size == 0))
						{
							$error[] = "Team Image too large. File must be less than 2 megabytes.$size";
						}
						if(!in_array($type,$accepteble) && (!empty($type)))
						{
							$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
						}
						
						$rnd = mt_rand(1,99999);
						$fnm = "img". $rnd . $img;
						$lfile = str_replace(' ','_',$img);
						$r = move_uploaded_file($tmp,'../images/users/'.$lfile);
						
						}
						else
						{
							$lfile=$result1['testi_img'];
						}
						if(count($error) == 0)
						{
						$query = mysqli_query($con,"UPDATE `testimonial` SET `testi_title`='$testi_title',`testi_content`='$testi_content',`testi_img`='$lfile',`testi_user`='$testi_user',`testi_location`='$testi_location' WHERE id='$id'");
						if($query){ echo'<script type="text/javascript">alert("Testimonial Updated..")</script>'; 
						echo"<script type='text/javascript'>";	
						echo"window.location = 'testimonial'";
						echo"</script>";
						}
						}
						else
						{
							foreach($error as $err)
							{
								echo '<script>alert("'.$err.'");</script>';
								echo"<script type='text/javascript'>";	
								echo"window.location = 'testimonial'";
								echo"</script>";
							}
							die();
						}
					}
				}
			?>
				<div class="row" style="min-height:590px">
					<div class="col-lg-12 portlets">
						<div class="panel panel-default no-bd">
							<div class="panel-header bg-dark">
							  <h2 class="panel-title"><strong> Edit </strong> Category </h2>
							</div>
							<div class="panel-body bg-white">			
							  <div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
								  <form method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Testimonial Title :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_title" value="<?php echo $result1['testi_title']; ?>">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Testimonial Content :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_content" value="<?php echo $result1['testi_content']; ?>">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Testimonial Member Name :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_user" value="<?php echo $result1['testi_user']; ?>">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Member Location :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="testi_location" value="<?php echo $result1['testi_location']; ?>">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Testimonial Member Profile :</label>
											<div class="append-icon">
												<input type="file" class="form-control" name="testi_img">
											 </div>
										 </div>
									</div> 
									<div class="col-sm-6"> 
										 <img src="../images/users/<?php echo $result1['testi_img']; ?>" height="80" width="80">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6"> 
										 <div class="text-center  m-t-20">
											<button type="submit" class="btn btn-embossed btn-primary" name="edit">Update Team</button>
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
	<?php   
				if($_REQUEST['opr'] == "remove")
				{
					$id = $_REQUEST['deleteid'];
					$remove = mysqli_query($con,"DELETE FROM `testimonial` WHERE id='$id'");
					if($remove){
						echo"<script type='text/javascript'>";
						echo"window.location='testimonial'";
						echo"</script>";
					}
				} 
			}
	?>
		
	</div> 
        
<?php
	include('footer.php');
?>