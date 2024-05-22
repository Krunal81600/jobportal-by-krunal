<?php
	include('../config.php');
	error_reporting(0);
	include('header.php');
	if(isset($_POST['submit']))
	{
		$brand_link="http://".$_POST['brand_link'];
		$error = array();
		$accepteble = array
		(
			'image/jpg',
			'image/jpeg',
			'image/png'
		);
		
		$img = $_FILES['brand_img']['name'];
		$tmp = $_FILES['brand_img']['tmp_name'];
		$size = $_FILES['brand_img']['size'];
		$type = $_FILES['brand_img']['type'];
		
		if($size >= 2097152 || ($size == 0))
		{
			$error[] = "Brand Image too large. File must be less than 2 megabytes.$size";
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
		$r = move_uploaded_file($tmp,'../images/clients/'.$lfile);
		
		$query = mysqli_query($con,"INSERT INTO `brand`(`brand_img`,`brand_link`) VALUES('$lfile','$brand_link')");
		if($query){ echo'<script type="text/javascript">alert("Brand Inserted..")</script>'; }
		}
		else
		{
			foreach($error as $err)
			{
				echo '<script>alert("'.$err.'");</script>';
				echo"<script type='text/javascript'>";	
				echo"window.location = 'brand'";
				echo"</script>";
			}
			die();
		}
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2><strong>Brand</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Dashboard</a>
                </li>
                <li class="active">Brand</li>
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
						  <h2 class="panel-title"><strong>Add</strong> Brand</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Choose Brand :</label>
											<div class="append-icon">
												<input type="file" class="form-control" name="brand_img">
											 </div>
										 </div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Brand Link:</label>
												<div class="append-icon">
													<input type="text" class="form-control" placeholder="Brand Link" name="brand_link">
												 </div>
											 </div>
										</div>
									</div>
									<div class="col-sm-12"> 
										 <div class="text-center  m-t-20">
											<button type="submit" class="btn btn-embossed btn-primary" name="submit">Add Brand</button>
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
					  <h3><i class="fa fa-table"></i> <strong>Brand List</strong></h3>
					</div>
					<div class="panel-content pagination2 table-responsive">
					  <table class="table table-hover table-dynamic">
						<thead>
						  <tr>
							<th> No. </th>
							<th> Brand </th>
							<th> Link </th>
							<th> Edit </th>
							<th> Remove </th>
						  </tr>
						</thead>
						<tbody>
						<?php 
						$num = 0;
						$sql1 = mysqli_query ($con,"SELECT * FROM `brand` ORDER BY  `id` DESC");
						while($row1 = mysqli_fetch_array($sql1))
						{	$num = $num + 1;
						?>
						  <tr>
							<td><?php echo $num; ?></td>
							<td><img src="../images/clients/<?php echo $row1['brand_img']; ?>" height="80" width="80"></td>
							<td><a href="<?php echo $row1['brand_link']; ?>"><?php echo $row1['brand_link']; ?></a></td>
							<td><a href="brand?editid=<?php echo $row1['id']; ?>&opr=edit" class="btn btn-primary">Edit</a></td>
							<td><a href="brand?deleteid=<?php echo $row1['id']; ?>&opr=remove" class="btn btn-primary">Remove</a></td>
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
					$sqli1 = mysqli_query($con,"SELECT * FROM `brand` WHERE id='$id'");
					$result1= mysqli_fetch_array($sqli1);
					if(isset($_POST['edit']))
					{
						$brand_link="http://".$_POST['brand_link'];
						$error = array();
						$accepteble = array
						(
							'image/jpg',
							'image/jpeg',
							'image/png'
						);
						if($_FILES['brand_img']['name'])
						{
						$img = $_FILES['brand_img']['name'];
						$tmp = $_FILES['brand_img']['tmp_name'];
						$size = $_FILES['brand_img']['size'];
						$type = $_FILES['brand_img']['type'];
						
						if($size >= 2097152 || ($size == 0))
						{
							$error[] = "Brand Image too large. File must be less than 2 megabytes.$size";
						}
						if(!in_array($type,$accepteble) && (!empty($type)))
						{
							$error[] = "Invalid file type. Only JPG and PNG types are accepted. ";
						}
						
						$rnd = mt_rand(1,99999);
						$fnm = "img". $rnd . $img;
						$lfile = str_replace(' ','_',$img);
						$r = move_uploaded_file($tmp,'../images/clients/'.$lfile);
						
						}
						else
						{
							$lfile=$result1['brand_img'];
						}
						if(count($error) == 0)
						{
						$query = mysqli_query($con,"UPDATE `brand` SET `brand_img`='$lfile',`brand_link`='$brand_link' WHERE id='$id'");
						if($query){ echo'<script type="text/javascript">alert("Brand Updated..")</script>'; 
						echo"<script type='text/javascript'>";	
						echo"window.location = 'brand'";
						echo"</script>";
						}
						}
						else
						{
							foreach($error as $err)
							{
								echo '<script>alert("'.$err.'");</script>';
								echo"<script type='text/javascript'>";	
								echo"window.location = 'brand'";
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
												<label class="control-label">Choose Brand :</label>
												<div class="append-icon">
													<input type="file" class="form-control" name="brand_img">
												 </div>
											 </div>
										</div>
										 <div class="col-sm-6">
											<div class="form-group">										
												<img src="../images/clients/<?php echo $result1['brand_img']; ?>" height="200" width="200">
											 </div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">										
												<label class="control-label">Brand Link:</label>
												<div class="append-icon">
													<input type="text" class="form-control" placeholder="Brand Link" value="<?php echo $result1['brand_link']; ?>" name="brand_link">
												 </div>
											 </div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6"> 
											 <div class="text-center  m-t-20">
												<button type="submit" class="btn btn-embossed btn-primary" name="edit">Update Brand</button>
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
					$remove = mysqli_query($con,"DELETE FROM `brand` WHERE id='$id'");
					if($remove){
						echo"<script type='text/javascript'>";
						echo"window.location='brand'";
						echo"</script>";
					}
				} 
			}
	?>
		
	</div> 
        
<?php
	include('footer.php');
?>