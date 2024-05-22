<?php
	include('../config.php');
	error_reporting(0);
	include('header.php');
	if(isset($_POST['submit']))
	{
		$team_nm=mysqli_real_escape_string($con, $_POST['team_nm']);
		$position=mysqli_real_escape_string($con, $_POST['position']);
		$team_tite=mysqli_real_escape_string($con, $_POST['team_tite']);
		$content=mysqli_real_escape_string($con, $_POST['content']);
		$facebook=mysqli_real_escape_string($con, $_POST['facebook']);
		$twitter=mysqli_real_escape_string($con, $_POST['twitter']);
		$googleplus=mysqli_real_escape_string($con, $_POST['googleplus']);
		
		$error = array();
		$accepteble = array
		(
			'image/jpg',
			'image/jpeg',
			'image/png'
		);
		
		$img = $_FILES['team_img']['name'];
		$tmp = $_FILES['team_img']['tmp_name'];
		$size = $_FILES['team_img']['size'];
		$type = $_FILES['team_img']['type'];
		
		if($size >= 2097152 || ($size == 0))
		{
			$error[] = "Team Image too large. File must be less than 2 megabytes.$size";
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
		$r = move_uploaded_file($tmp,'../images/team/'.$lfile);
		
		$query = mysqli_query($con,"INSERT INTO `team`(`team_nm`,`position`,`team_img`,`team_tite`,`content`,`facebook`,`twitter`,`googleplus`) VALUES('$team_nm','$position','$lfile','$team_tite','$content','$facebook','$twitter','$googleplus')");
		if($query){ echo'<script type="text/javascript">alert("Team Inserted..")</script>'; }
		}
		else
		{
			foreach($error as $err)
			{
				echo '<script>alert("'.$err.'");</script>';
				echo"<script type='text/javascript'>";	
				echo"window.location = 'team'";
				echo"</script>";
			}
			die();
		}
		
	}
	
if($_REQUEST['on'])
{
	mysqli_query($con,"UPDATE `setting` SET `team`='1' WHERE id='1'");
	
	echo"<script type='text/javascript'>";	
	echo"window.location = 'team'";
	echo"</script>";
}
if($_REQUEST['off'])
{
	mysqli_query($con,"UPDATE `setting` SET `team`='0' WHERE id='1'");
	
	echo"<script type='text/javascript'>";	
	echo"window.location = 'team'";
	echo"</script>";
}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2><strong>Team</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Dashboard</a>
                </li>
                <li class="active">Team</li>
              </ol>
            </div>
          </div>
		  <div class="row">
				<div class="col-lg-12">
					<?php
						$onoff=mysqli_query($con,"SELECT * FROM `setting` WHERE id='1'");
						$rowonoff=mysqli_fetch_array($onoff);
						if($rowonoff['team']==1)
						{
					?>
					<h1>Show On Front End : <a href="team?off=off" class="btn btn-embossed btn-primary" >ON</a> </h1>
						<?php } else { ?>
					<h1>Show On Front End : <a href="team?on=on" class="btn btn-embossed btn-danger" >Off</a> </h1>
						<?php } ?>
				</div>
		  </div>
		 <?php
			if(empty($_REQUEST['opr']))
			{
		 ?>	  <div class="row">
				<div class="col-lg-12 portlets">
					<div class="panel panel-default no-bd">
						<div class="panel-header bg-dark">
						  <h2 class="panel-title"><strong>Add</strong> Team</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Team Member Name :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="team_nm">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Member Position :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="position">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Team Member Title :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="team_tite">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Member Content :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="content">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Team Member Facebook Url :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="facebook">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Team Member Twitter Url :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="twitter">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Team Member Google Plus Url :</label>
											<div class="append-icon">
												<input type="text" class="form-control" name="googleplus">
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="form-group">										
											<label class="control-label">Team Member Profile :</label>
											<div class="append-icon">
												<input type="file" class="form-control" name="team_img">
											 </div>
										 </div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6"> 
										 <div class="text-center  m-t-20">
											<button type="submit" class="btn btn-embossed btn-primary" name="submit">Add Team</button>
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
					  <h3><i class="fa fa-table"></i> <strong>Team List</strong></h3>
					</div>
					<div class="panel-content pagination2 table-responsive">
					  <table class="table table-hover table-dynamic">
						<thead>
						  <tr>
							<th> No. </th>
							<th> Team Member Name </th>
							<th> Position </th>
							<th> Title </th>
							<th> Content </th>
							<th> Facebook </th>
							<th> Twitter </th>
							<th> Google + </th>
							<th> Profile </th>
							<th> Edit </th>
							<th> Remove </th>
						  </tr>
						</thead>
						<tbody>
						<?php 
						$num = 0;
						$sql1 = mysqli_query ($con,"SELECT * FROM `team` ORDER BY  `id` DESC");
						while($row1 = mysqli_fetch_array($sql1))
						{	$num = $num + 1;
						?>
						  <tr>
							<td><?php echo $num; ?></td>
							<td><?php echo $row1['team_nm']; ?></td>
							<td><?php echo $row1['position']; ?></td>
							<td><?php echo $row1['team_tite']; ?></td>
							<td><?php echo $row1['content']; ?></td>
							<td><?php echo $row1['facebook']; ?></td>
							<td><?php echo $row1['twitter']; ?></td>
							<td><?php echo $row1['googleplus']; ?></td>
							<td><img src="../images/team/<?php echo $row1['team_img']; ?>" height="80" width="80"></td>
							<td><a href="team?editid=<?php echo $row1['id']; ?>&opr=edit" class="btn btn-primary">Edit</a></td>
							<td><a href="team?deleteid=<?php echo $row1['id']; ?>&opr=remove" class="btn btn-primary">Remove</a></td>
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
					$sqli1 = mysqli_query($con,"SELECT * FROM `team` WHERE id='$id'");
					$result1= mysqli_fetch_array($sqli1);
					if(isset($_POST['edit']))
					{
						$team_nm=$_POST['team_nm'];
						$position=$_POST['position'];
						$team_tite=$_POST['team_tite'];
						$content=$_POST['content'];
						$facebook=$_POST['facebook'];
						$twitter=$_POST['twitter'];
						$googleplus=$_POST['googleplus'];
						
						$error = array();
						$accepteble = array
						(
							'image/jpg',
							'image/jpeg',
							'image/png'
						);
						if($_FILES['team_img']['name'])
						{
						$img = $_FILES['team_img']['name'];
						$tmp = $_FILES['team_img']['tmp_name'];
						$size = $_FILES['team_img']['size'];
						$type = $_FILES['team_img']['type'];
						
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
						$r = move_uploaded_file($tmp,'../images/team/'.$lfile);
						
						}
						else
						{
							$lfile=$result1['team_img'];
						}
						if(count($error) == 0)
						{
						$query = mysqli_query($con,"UPDATE `team` SET `team_nm`='$team_nm',`position`='$position',`team_img`='$lfile',`team_tite`='$team_tite',`content`='$content',`facebook`='$facebook',`twitter`='$twitter',`googleplus`='$googleplus' WHERE id='$id'");
						if($query){ echo'<script type="text/javascript">alert("Team Updated..")</script>'; 
						echo"<script type='text/javascript'>";	
						echo"window.location = 'team'";
						echo"</script>";
						}
						}
						else
						{
							foreach($error as $err)
							{
								echo '<script>alert("'.$err.'");</script>';
								echo"<script type='text/javascript'>";	
								echo"window.location = 'team'";
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
												<label class="control-label">Team Member Name :</label>
												<div class="append-icon">
													<input type="text" class="form-control" name="team_nm" value="<?php echo $result1['team_nm']; ?>">
												 </div>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <div class="form-group">										
												<label class="control-label">Member Position :</label>
												<div class="append-icon">
													<input type="text" class="form-control" name="position" value="<?php echo $result1['position']; ?>">
												 </div>
											 </div>
										</div> 
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Team Member Title :</label>
												<div class="append-icon">
													<input type="text" class="form-control" name="team_tite" value="<?php echo $result1['team_tite']; ?>">
												 </div>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <div class="form-group">										
												<label class="control-label">Member Content :</label>
												<div class="append-icon">
													<input type="text" class="form-control" name="content" value="<?php echo $result1['content']; ?>">
												 </div>
											 </div>
										</div> 
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Team Member Facebook Url :</label>
												<div class="append-icon">
													<input type="text" class="form-control" name="facebook" value="<?php echo $result1['facebook']; ?>">
												 </div>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <div class="form-group">										
												<label class="control-label">Team Member Twitter Url :</label>
												<div class="append-icon">
													<input type="text" class="form-control" name="twitter" value="<?php echo $result1['twitter']; ?>">
												 </div>
											 </div>
										</div> 
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Team Member Google Plus Url :</label>
												<div class="append-icon">
													<input type="text" class="form-control" name="googleplus" value="<?php echo $result1['googleplus']; ?>">
												 </div>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <div class="form-group">										
												<label class="control-label">Team Member Profile :</label>
												<div class="append-icon">
													<input type="file" class="form-control" name="team_img">
													<img src="../images/team/<?php echo $result1['team_img']; ?>" height="80" width="80">
												</div>
											 </div>
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
					$remove = mysqli_query($con,"DELETE FROM `team` WHERE id='$id'");
					if($remove){
						echo"<script type='text/javascript'>";
						echo"window.location='team'";
						echo"</script>";
					}
				} 
			}
	?>
		
	</div> 
        
<?php
	include('footer.php');
?>