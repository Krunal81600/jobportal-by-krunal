<?php
	include('../config.php');
	include('header.php');
	if(isset($_POST['submit']))
	{
		if($_POST['africa']){
			$africa = 1;
		}else{
			$africa = 0;
		}
		$countrynm = $_POST['countrynm'];
		$r = mysqli_query($con,"INSERT INTO `country`(`countrynm`,`africa`) VALUES('$countrynm','$africa')");
		if($r){ echo'<script type="text/javascript">alert("Country Inserted..")</script>'; }
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
					  <h2 class="panel-title"><strong>Add</strong>Country</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" >
							<div class="row">
							  <div class="col-sm-6">
								<div class="form-group">
								  <label class="control-label">Enter Country </label>
								  <div class="append-icon">
									<input type="text" name="countrynm" class="form-control"  placeholder="Enter Country..." required>
									<i class="icon-plane"></i>
								  </div>
								</div>
							  </div>
							  <div class="col-sm-oofset-6"></div>
							  </div>
							  <div class="row">
								  <div class="col-sm-6"> 
									<div class="text-center  m-t-20">
										<button type="submit" class="btn btn-embossed btn-primary" name="submit">ADD COUNTRY</button>
										<button type="reset" class="cancel btn btn-embossed btn-default m-b-10 m-r-0">Cancel</button>
									</div>
								  </div>
									<div class="col-sm-6">
										<div class="form-group">
											<div class="loginbox-forgot">
											   <input type="checkbox" name="africa"> If Country Involved In Africa  Then Check It.</a>
											</div>
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