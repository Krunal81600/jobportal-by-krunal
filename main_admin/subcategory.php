<?php
	include('../config.php');
	error_reporting(0);
	include('header.php');
	if(isset($_POST['submit']))
	{
		$main_id = $_POST['main_id'];
		$subcategorynm = $_POST['subcategorynm'];
		$query = mysqli_query($con,"INSERT INTO `subcategory`(`main_id`,`subcategorynm`) VALUES('$main_id','$subcategorynm')");
		if($query){ echo'<script type="text/javascript">alert("Subcategory Inserted..")</script>'; }
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2><strong>SUB CATEGORY</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Dashboard</a>
                </li>
                <li class="active">Sub Category</li>
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
						  <h2 class="panel-title"><strong>Add</strong>Sub Category</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Select Main Category :</label>
											<select class="form-control" name="main_id" id="inputName1" >
											<option value="">Select Main Category</option>
											<?php 
												$sel=mysqli_query($con,"SELECT * FROM category");
												while($rowc=mysqli_fetch_array($sel))
												{
											?>
											<option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['category']; ?></option>
												<?php } ?>
										</select>
										 </div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Enter Sub Category Name :</label>
											<div class="append-icon">
												<input type="text" placeholder="Enter Sub Category Name" class="form-control" name="subcategorynm">
												<i class="icon-plus"></i>
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <div class="text-center  m-t-20">
											<button type="submit" class="btn btn-embossed btn-primary" name="submit">ADD Category</button>
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
					  <h3><i class="fa fa-table"></i> <strong>Category List</strong></h3>
					</div>
					<div class="panel-content pagination2 table-responsive">
					  <table class="table table-hover table-dynamic">
						<thead>
						  <tr>
							<th> No. </th>
							<th> Main Category </th>
							<th> Sub Category </th>
							<th> Edit </th>
							<th> Remove </th>
						  </tr>
						</thead>
						<tbody>
						<?php 
						$num = 0;
						$sql1 = mysqli_query ($con,"SELECT * FROM `subcategory`");
						while($row1 = mysqli_fetch_array($sql1))
						{	$num = $num + 1;
						$id=$row1['main_id'];
						$selectsub=mysqli_query($con,"SELECT * FROM `category` where id='$id'");
						$rowadsub=mysqli_fetch_array($selectsub);
						?>
						  <tr>
							<td><?php echo $num; ?></td>
							<td><?php echo $row1['subcategorynm']; ?></td>
							<td><?php echo $rowadsub['category']; ?></td>
							<td><a href="subcategory?editid=<?php echo $row1['id']; ?>&opr=edit" class="btn btn-primary">Edit</a></td>
							<td><a href="subcategory?deleteid=<?php echo $row1['id']; ?>&opr=remove" class="btn btn-primary">Remove</a></td>
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
					$sqli1 = mysqli_query($con,"SELECT * FROM `subcategory` WHERE id='$id'");
					$result1= mysqli_fetch_array($sqli1);
					if(isset($_POST['edit']))
					{
						$main_id = $_POST['main_id'];
						$subcategorynm = $_POST['subcategorynm'];
						$result2 = mysqli_query($con,"UPDATE `subcategory` SET main_id='$main_id' , subcategorynm='$subcategorynm' WHERE id='$id'");
						if($result2){
							echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
							echo"<script type='text/javascript'>";
							echo"window.location='subcategory'";
							echo"</script>";
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
								  <form method="POST">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Select Main Category :</label>
												<select class="form-control" name="main_id" id="inputName1" >
													<option value="">Select Main Category</option>
													<?php 
														$sel=mysqli_query($con,"SELECT * FROM category");
														while($rowc=mysqli_fetch_array($sel))
														{
													?>
													<option value="<?php echo $rowc['id']; ?>" <?php if($rowc['id']==$result1['main_id']) echo "selected='selected'";?>><?php echo $rowc['category']; ?></option>
														<?php } ?>
												</select>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <label class="control-label">Enter Sub Category :</label>
											<div class="append-icon">
											  <input type="text" placeholder="Enter Sub Category Name" class="form-control" name="subcategorynm" value="<?php echo $result1['subcategorynm']; ?>">
												<i class="icon-plus"></i>
											  </div>
										</div> 
									 <div class="col-sm-6"> 
									 <div class="text-center  m-t-20">
										<button type="submit" class="btn btn-embossed btn-primary" name="edit">Edit Location</button>
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
					$remove = mysqli_query($con,"DELETE FROM `subcategory` WHERE id='$id'");
					if($remove){
						echo"<script type='text/javascript'>";
						echo"window.location='subcategory'";
						echo"</script>";
					}
				} 
			}
	?>
		
	</div> 
        
<?php
	include('footer.php');
?>