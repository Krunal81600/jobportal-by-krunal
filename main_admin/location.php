<?php
	include('../config.php');
	include('header.php');
	if(isset($_POST['submit']))
	{
		$country_id = $_POST['country_id'];
		if(empty($country_id))
		{
			$countrynm = $_POST['citynm'];
			echo'<script type="text/javascript">alert("'.$countrynm.'")</script>';
			if($_POST['africa']){
				$africa = 1;				
			}else{
				$africa = 0;
			}
			$query = mysqli_query($con,"INSERT INTO `country`(`countrynm`,`africa`) VALUES('$countrynm','$africa')");
			if($query){ echo'<script type="text/javascript">alert("Country Inserted..")</script>'; }
		}
		else
		{
			$citynm = $_POST['citynm'];
			$query = mysqli_query($con,"INSERT INTO `city`(`country_id`,`citynm`) VALUES('$country_id','$citynm')");
			if($query){ echo'<script type="text/javascript">alert("Country Inserted..")</script>'; }
		}
	}
?>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"employee-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Location <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Make</a>
                </li>
                <li class="active">Location List</li>
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
						  <h2 class="panel-title"><strong>Add</strong> Location</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST">
								<div class="row">
								  <div class="col-sm-6">
										<div class="form-group">
											  <label class="control-label">Select Country </label>
											  <select id="country" name="country_id" style="width:100%;">
												  <option value=""> None </option>
												  <?php
														$countrynm = mysqli_query($con,"SELECT * FROM `country`");
														while($row1= mysqli_fetch_array($countrynm)){
															echo'<option value='.$row1['id'].'>'.$row1['countrynm'].'</opiton>';
														}
													?>
												</select>
										</div>
									</div>
									<div class="col-sm-6">
									  <div class="form-group">
										<label class="control-label">Enter City </label>
										<div class="append-icon">
										  <input type="text" name="citynm" class="form-control"  placeholder="Enter City..." required>
										  <i class="icon-location"></i>
										 </div>
									  </div>
									</div>
								</div>
								<div class="row">
								  <div class="col-sm-6">
									<div class="form-group">
									   <div class="loginbox-forgot">
										  <input type="checkbox" name="africa"> If Country Involved In Africa  Then Check It.</a>
										</div>
									 </div>
								   </div>
								   <div class="col-sm-6"> 
									 <div class="text-center  m-t-20">
										<button type="submit" class="btn btn-embossed btn-primary" name="submit">ADD Location</button>
										<button type="reset" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</button>
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
					  <h3><i class="fa fa-table"></i> <strong>Location </strong> List</h3>
					</div>
					<div class="panel-content pagination2 table-responsive">
					  <table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
						<thead>
						  <tr>
							<th> No. </th>
							<th> City </th>
							<th> Country </th>
							<th> Edit </th>
							<th> Remove </th>
						  </tr>
						</thead>
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
					$id = $_REQUEST['sid'];
					$sqli1 = mysqli_query($con,"SELECT * FROM `city` WHERE id='$id'");
					$result1= mysqli_fetch_array($sqli1);
					
					$cid = $result1['country_id'];
					$cityid = $result1['id'];
					$sqli2 = mysqli_query($con,"SELECT * FROM `country` WHERE id='$cid'");
					$result2= mysqli_fetch_array($sqli2);	
					if(isset($_POST['edit'])){
						$countrynm =$_POST['ecountrynm'];
						$citynm =$_POST['ecitynm'];
						if(empty($_POST['eafrica'])){
							$africa = 0;
						}else{
							$africa = 1;
						}
						$r1 = mysqli_query($con,"UPDATE `city` SET citynm = '$citynm' WHERE id ='$cityid'");
						$r2 = mysqli_query($con,"UPDATE `country` SET countrynm = '$countrynm' ,africa='$africa' WHERE id ='$cid'");
						echo"<script type='text/javascript'>";
						echo"window.location='location.php'";
						echo"</script>";
					}
			?>
				<div class="row" style="min-height:590px">
					<div class="col-lg-12 portlets">
						<div class="panel panel-default no-bd">
							<div class="panel-header bg-dark">
							
							  <h2 class="panel-title"><strong> Edit </strong> Location</h2>
							</div>
							<div class="panel-body bg-white">			
							  <div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
								  <form method="POST">
									<div class="row">
									  <div class="col-sm-6">
										<div class="form-group">
											<div class="form-group">
											  <label class="control-label">Select Country </label>
											  <input type="text" name="ecountrynm" class="form-control" value="<?php echo $result2['countrynm']; ?>" required>
											  <i class="icon-plan"></i>
											</div>
										  </div>
										</div>
										<div class="col-sm-6">
										  <div class="form-group">
											<label class="control-label">Enter City </label>
											<div class="append-icon">
											  <input type="text" name="ecitynm" class="form-control" value="<?php echo $result1['citynm']; ?>"  required>
											  <i class="icon-location"></i>
											 </div>
										  </div>
										</div>
									</div>
									<div class="row">
									  <div class="col-sm-6">
										<div class="form-group">
										   <div class="loginbox-forgot">
											  <input type="checkbox" name="eafrica"<?php if($result2['africa'] == 1){ ?> checked	 <?php } ?> > If Country Involved In Africa  Then Check It.</a>
											</div>
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
		 <?php  }
				if($_REQUEST['opr'] == "remove")
				{
					$id = $_REQUEST['sid'];
					$remove = mysqli_query($con,"DELETE FROM `city` WHERE id='$id'");
					if($remove){
						echo"<script type='text/javascript'>";
						echo"window.location='location.php'";
						echo"</script>";
					}
				}
			}?>
		
	</div>
        
<?php
	include('footer.php');
?>