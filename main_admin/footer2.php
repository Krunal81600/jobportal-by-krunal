<?php
	include('../config.php');
	error_reporting(0);
	include('header.php');
	if(isset($_POST['submit']))
	{
		$menu = mysqli_real_escape_string($con, $_POST['menu']);
		$url = mysqli_real_escape_string($con, $_POST['url']);
		$query = mysqli_query($con,"INSERT INTO `footermenu`(`menu`,`url`) VALUES('$menu','$url')");
		if($query){ echo'<script type="text/javascript">alert("Menu Inserted..")</script>'; }
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2><strong>Footer Menu</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Dashboard</a>
                </li>
                <li class="active">Footer2</li>
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
						  <h2 class="panel-title"><strong>Add</strong> Footer Menu</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Add Footer Menu :</label>
											<div class="append-icon">
											  <input type="text" name="menu" class="form-control"  placeholder="Enter Menu..." required>
											  <i class="icon-plus"></i>
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <label class="control-label">Add Menu Url :</label>
										<div class="append-icon">
										  <input type="text" name="url" class="form-control"  placeholder="Enter Menu URL..." required><i class="icon-web"></i></div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6"></div>
									<div class="col-sm-6"> 
										 <div class="text-center  m-t-20">
											<button type="submit" class="btn btn-embossed btn-primary" name="submit">ADD Menu</button>
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
					  <h3><i class="fa fa-table"></i> <strong>Menu List</strong></h3>
					</div>
					<div class="panel-content pagination2 table-responsive">
					  <table class="table table-hover table-dynamic">
						<thead>
						  <tr>
							<th> No. </th>
							<th> Menu </th>
							<th> Menu URL </th>
							<th> Edit </th>
							<th> Remove </th>
						  </tr>
						</thead>
						<tbody>
						<?php 
						$num = 0;
						$sql1 = mysqli_query ($con,"SELECT * FROM `footermenu`");
						while($row1 = mysqli_fetch_array($sql1))
						{	$num = $num + 1;
						?>
						  <tr>
							<td><?php echo $num; ?></td>
							<td><?php echo $row1['menu']; ?></td>
							<td><?php echo $row1['url']; ?></td>
							<td><a href="footer2.php?editid=<?php echo $row1['id']; ?>&opr=edit" class="btn btn-primary">Edit</a></td>
							<td><a href="footer2.php?deleteid=<?php echo $row1['id']; ?>&opr=remove" class="btn btn-primary">Remove</a></td>
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
					$sqli1 = mysqli_query($con,"SELECT * FROM `footermenu` WHERE id='$id'");
					$result1= mysqli_fetch_array($sqli1);
					if(isset($_POST['edit']))
					{
						$menu = $_POST['menu'];
						$url = $_POST['url'];
						$result2 = mysqli_query($con,"UPDATE `footermenu` SET menu='$menu' , url='$url' WHERE id='$id'");
						if($result2){
							echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
							echo"<script type='text/javascript'>";
							echo"window.location='footer2.php'";
							echo"</script>";
						}
					}
				}
			?>
				<div class="row">
					<div class="col-lg-12 portlets">
						<div class="panel panel-default no-bd">
							<div class="panel-header bg-dark">
							  <h2 class="panel-title"><strong> Edit </strong> Category </h2>
							</div>
							<div class="panel-body bg-white">			
							  <div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
								  <form method="POST">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Add Menu :</label>
												<div class="append-icon">
												  <input type="text" name="menu" class="form-control"  required value="<?php echo $result1['menu']; ?>">
												  <i class="icon-plus"></i>
												 </div>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <label class="control-label">Add Menu URL :</label>
											<div class="append-icon">
											  <input type="text" name="url" class="form-control" required value="<?php echo $result1['url']; ?>"><i class="icon-plus"></i></div>
										</div> 
									</div>
									<div class="row">
										<div class="col-sm-6"></div>
										<div class="col-sm-6"> 
											 <div class="text-center  m-t-20">
												<button type="submit" class="btn btn-embossed btn-primary" name="edit">Edit Menu</button>
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
					$remove = mysqli_query($con,"DELETE FROM `footermenu` WHERE id='$id'");
					if($remove){
						echo"<script type='text/javascript'>";
						echo"window.location='footer2.php'";
						echo"</script>";
					}
				} 
			}
	
	?>
		
	</div> 
        
<?php
	include('footer.php');
?>