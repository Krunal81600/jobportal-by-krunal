<?php
	include('../config.php');
	error_reporting(0);
	include('header.php');
	if(isset($_POST['submit']))
	{
		$category = $_POST['category'];
		$category_icon = $_POST['category_icon'];
		$category_content = $_POST['category_content'];
		$query = mysqli_query($con,"INSERT INTO `category`(`category`,`category_icon`,`category_content`) VALUES('$category','$category_icon','$category_content')");
		if($query){ echo'<script type="text/javascript">alert("Category Inserted..")</script>'; }
		
	}
	
	if($_REQUEST['popularct'])
	{
		$id = $_GET['id'];
		if($_REQUEST['popular'] == 0)
		{
			$popular= 1;
		}
		else
		{
			$popular= 0;
		}
		$pop = mysqli_query($con,"UPDATE `category` SET popular='$popular' WHERE id='$id'");
		
			echo"<script type='text/javascript'>";
			echo"window.location='category.php'";
			echo"</script>";
			echo"<script type='text/javascript'>alert('Successfully Changed');</script>";
		
	} 
	if($_REQUEST['hish'])
	{
		$id = $_REQUEST['id'];
		if($_REQUEST['shown'] == 0)
		{
			$shown= 1;
		}
		else
		{
			$shown= 0;
		}
		$pop = mysqli_query($con,"UPDATE `category` SET shown='$shown' WHERE id='$id'");
		
			echo"<script type='text/javascript'>";
			echo"window.location='category.php'";
			echo"</script>";
			echo"<script type='text/javascript'>alert('Successfully Changed');</script>";
		
	} 
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2><strong>CATEGORY</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Dashboard</a>
                </li>
                <li class="active">Category</li>
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
						  <h2 class="panel-title"><strong>Add</strong> Category</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Add Category :</label>
											<div class="append-icon">
											  <input type="text" name="category" class="form-control"  placeholder="Enter Category..." required>
											  <i class="icon-plus"></i>
											 </div>
										 </div>
									</div>
									<div class="col-sm-6"> 
										 <label class="control-label">Add Category Icon :</label>
										<div class="append-icon">
										  <input type="text" name="category_icon" class="form-control"  placeholder="Enter Category..." required><i class="icon-plus"></i></div>
									</div> 
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">										
											<label class="control-label">Content :</label>
											<div class="append-icon">
												<textarea class="form-control" name="category_content" cols="4"></textarea>
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
							<th> Category </th>
							<th> Category Icon </th>
							<th> Category Content </th>
							<th> Post Counter </th>
							<th> Edit </th>
							<th> Remove </th>
							<th> Popular </th>
							<th> Hide/Show </th>
						  </tr>
						</thead>
						<tbody>
						<?php 
						$num = 0;
						$today=date('Y-m-d');
						$sql1 = mysqli_query ($con,"SELECT * FROM `category` ORDER BY  `id` DESC");
						while($row1 = mysqli_fetch_array($sql1))
						{	$num = $num + 1;
						?>
						  <tr>
							<td><?php echo $num; ?></td>
							<td><?php echo $row1['category']; ?></td>
							<td><?php echo $row1['category_icon']; ?></td>
							<td><?php echo $row1['category_content']; ?></td>
							<td><span class="btn btn-success"><?php 
								$job_category=$row1['category'];
								$r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$job_category' AND `job_edate` >  '$today' AND ad_app='1'"); 
					echo mysqli_num_rows($r12); ?></span> </td>
							<td><a href="category?editid=<?php echo $row1['id']; ?>&opr=edit" class="btn btn-primary">Edit</a></td>
							<td><a href="category?deleteid=<?php echo $row1['id']; ?>&opr=remove" class="btn btn-primary">Remove</a></td>
							
							<td><a href="category.php?id=<?php echo $row1['id']; ?>&popular=<?php echo $row1['popular']; ?>&popularct=popularct" class="btn <?php if($row1['popular'] == 0){ ?>btn-info<?php }else{ ?>btn-warning<?php } ?>"><?php if($row1['popular'] == 0){ ?><i class="fa fa-star-o"></i> <?php }else{ ?><i class="fa fa-star"></i> <?php } ?></a></td>
							
							<td><a href="category.php?id=<?php echo $row1['id']; ?>&shown=<?php echo $row1['shown']; ?>&hish=hish" class="btn <?php if($row1['shown'] == 0){ ?>btn-danger<?php }else{ ?>btn-success<?php } ?>"><?php if($row1['shown'] == 0){ ?>Hide <?php }else{ ?>Show <?php } ?></a></td>
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
					$sqli1 = mysqli_query($con,"SELECT * FROM `category` WHERE id='$id'");
					$result1= mysqli_fetch_array($sqli1);
					if(isset($_POST['edit']))
					{
						$category = $_POST['category'];
						$category_icon = $_POST['category_icon'];
						$category_content = $_POST['category_content'];
						$result2 = mysqli_query($con,"UPDATE `category` SET category='$category' , category_icon='$category_icon' , category_content='$category_content' WHERE id='$id'");
						if($result2){
							echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
							echo"<script type='text/javascript'>";
							echo"window.location='category.php'";
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
												<label class="control-label">Add Category :</label>
												<div class="append-icon">
												  <input type="text" name="category" class="form-control"  placeholder="Enter Category..." required value="<?php echo $result1['category']; ?>">
												  <i class="icon-plus"></i>
												 </div>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <label class="control-label">Add Category Icon :</label>
											<div class="append-icon">
											  <input type="text" name="category_icon" class="form-control"  placeholder="Enter Category..." required value="<?php echo $result1['category_icon']; ?>"><i class="icon-plus"></i></div>
										</div> 
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">										
												<label class="control-label">Content :</label>
												<div class="append-icon">
													<textarea class="form-control" name="category_content" cols="4"><?php echo $result1['category_content']; ?></textarea>
												 </div>
											 </div>
										</div>
										<div class="col-sm-6"> 
											 <div class="text-center  m-t-20">
												<button type="submit" class="btn btn-embossed btn-primary" name="edit">Edit Category</button>
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
				$remove = mysqli_query($con,"DELETE FROM `category` WHERE id='$id'");
				if($remove){
					echo"<script type='text/javascript'>";
					echo"window.location='category.php'";
					echo"</script>";
				}
			} 
			}
	?>
		
	</div> 
        
<?php
	include('footer.php');
?>