<?php
	include('../config.php');
	include('header.php');
	if(isset($_POST['submit']))
	{
		$country_id = $_POST['country_id'];
		$citynm = $_POST['citynm'];
		$r = mysqli_query($con,"INSERT INTO `city`(`country_id`,`citynm`) VALUES('$country_id','$citynm')");
		if($r){ echo'<script type="text/javascript">alert("City Inserted..")</script>'; }
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
											while($row1= mysqli_fetch_array($countrynm)){
												echo'<option value='.$row1['id'].'>'.$row1['countrynm'].'</opiton>';
											}
										?>
									</select>
								  </div>
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
							  <div class="col-sm-6"> 
							   <div class="text-center  m-t-20">
									<button type="submit" class="btn btn-embossed btn-primary" name="submit">ADD CITY</button>
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
        
<?php
	include('footer.php');
?>