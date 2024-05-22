  <?php include('../config.php'); ?>
  <?php include('header.php'); 
	
	
	if($_REQUEST['DELETE']){
		$id = $_REQUEST['id'];
		mysqli_query($con,"DELETE FROM `city` WHERE id = '$id'");
		echo'<script type="text/javascript">window.location="location_list"</script>';
	}
  ?>

        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Tables <strong>Dynamic</strong></h2>
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
		  <?php
		  if($_REQUEST['EDIT']){
			$id = $_REQUEST['id'];
			$fetchcity = mysqli_query($con,"SELECT * FROM `city` WHERE id= '$id'");
			$row3 = mysqli_fetch_array($fetchcity);
			$cid = $row3['country_id'];
			?>
			 <div class="row">
				<div class="col-lg-12 portlets">
					<div class="panel panel-default no-bd">
						<div class="panel-header bg-dark">
						  <h2 class="panel-title"><strong>Sign Up</strong> to our website</h2>
						</div>
						<div class="panel-body bg-white">			
						  <div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
							  <form method="POST" >
								<div class="row">
								  <div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label">Choose Country </label>
									  <div class="option-group">
										<select id="country" name="country_id"  required>
										  <option value="">Select Country...</option>
										  <?php
												$countrynm = mysqli_query($con,"SELECT * FROM `country`");
												while($row1= mysqli_fetch_array($countrynm)){ ?>
													<option value=<?php echo $row1['id']; if($cid == $row1['id']){ ?> selected <?php }?>><?php echo $row1['countrynm']; ?></option>
										  <?php }
											?>
										</select>
									  </div>
									</div>
								  </div>
								  <div class="col-sm-6">
									<div class="form-group">
									  <label class="control-label">EDIT City </label>
									  <div class="append-icon">
										<input type="text" name="citynm" class="form-control"  placeholder="Edit City..." required value="<?php echo $row3['citynm']; ?> ">
										<i class="icon-location"></i>
									  </div>
									</div>
								  </div>
								  <div class="col-sm-6"> 
								   <div class="text-center  m-t-20">
										<button type="submit" class="btn btn-embossed btn-primary" name="submit">EDIT CITY</button>
										<button type="reset" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</button>
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
	<?php } 
		else
		{  ?>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Sorting </strong> table</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
					  <?php
						$num = 0;
						$city = mysqli_query($con,"SELECT * FROM `city`");
					  ?>
                      <tr>
						<th> No. </th>
                        <th> City Name </th>
                        <th> Country Name </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						while($row1 = mysqli_fetch_array($city)){
							$num = $num + 1;
							$id=$row1['country_id'];
							$result2 = mysqli_query($con,"SELECT * FROM `country` WHERE id = '$id'");
							$row2 = mysqli_fetch_array($result2);
							echo"<tr>";
								echo"<td>".$num."</td>";
								echo"<td>".$row1['citynm']."</td>";
								echo"<td>".$row2['countrynm']."</td>";
							?>
								<td><a  class="btn btn-primary" href="location_list?id=<?php echo$row1['id']; ?>&EDIT=EDIT">EDIT</a></td>
								<td><a class="btn btn-primary" href="location_list?id=<?php echo$row1['id']; ?>&DELETE=DELETE">DELETE</a></td>
					<?php  echo"</tr>";
						}
                     ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
		   <?php include('footer.php'); ?>