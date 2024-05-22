<?php
	include('../config.php');
	include('header.php');
	$sql1 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='build-resume'");
	$result1 = mysqli_fetch_array($sql1);
		
	if(isset($_POST['submit']))
	{
		$title1 = mysqli_real_escape_string($con, $_POST['title1']);
		$title2 = mysqli_real_escape_string($con, $_POST['title2']);
		$title3 = mysqli_real_escape_string($con, $_POST['title3']);
		$title4 = mysqli_real_escape_string($con, $_POST['title4']);
		$title5 = mysqli_real_escape_string($con, $_POST['title5']);
		$title6 = mysqli_real_escape_string($con, $_POST['title6']);
		$title7 = mysqli_real_escape_string($con, $_POST['title7']);
		$title8 = mysqli_real_escape_string($con, $_POST['title8']);
		$title9 = mysqli_real_escape_string($con, $_POST['title9']);
		$title10 = mysqli_real_escape_string($con, $_POST['title10']);
		$title11 = mysqli_real_escape_string($con, $_POST['title11']);
		$title12 = mysqli_real_escape_string($con, $_POST['title12']);
		$title13 = mysqli_real_escape_string($con, $_POST['title13']);
		$title14 = mysqli_real_escape_string($con, $_POST['title14']);
		$title15 = mysqli_real_escape_string($con, $_POST['title15']);
		$title16 = mysqli_real_escape_string($con, $_POST['title16']);
		$title17 = mysqli_real_escape_string($con, $_POST['title17']);
		$title18 = mysqli_real_escape_string($con, $_POST['title18']);
		$title19 = mysqli_real_escape_string($con, $_POST['title19']);
		$title20 = mysqli_real_escape_string($con, $_POST['title20']);
		$title21 = mysqli_real_escape_string($con, $_POST['title21']);
		$title22 = mysqli_real_escape_string($con, $_POST['title22']);
		$title23 = mysqli_real_escape_string($con, $_POST['title23']);
		$title24 = mysqli_real_escape_string($con, $_POST['title24']);
		$title25 = mysqli_real_escape_string($con, $_POST['title25']);
		$title26 = mysqli_real_escape_string($con, $_POST['title26']);
		$title27 = mysqli_real_escape_string($con, $_POST['title27']);
		$title28 = mysqli_real_escape_string($con, $_POST['title28']);
		$title29 = mysqli_real_escape_string($con, $_POST['title29']);
		$title30 = mysqli_real_escape_string($con, $_POST['title30']);
		$title31 = mysqli_real_escape_string($con, $_POST['title31']);
		$title32 = mysqli_real_escape_string($con, $_POST['title32']);
		$title33 = mysqli_real_escape_string($con, $_POST['title33']);
		$title34 = mysqli_real_escape_string($con, $_POST['title34']);
		$title35 = mysqli_real_escape_string($con, $_POST['title35']);
		$title36 = mysqli_real_escape_string($con, $_POST['title36']);
		
		
		
		$sql2 = mysqli_query($con,"UPDATE `all_title` SET title1='$title1',title2='$title2',title3='$title3',title4='$title4',title5='$title5',title6='$title6',title7='$title7',title8='$title8',title9='$title9',title10='$title10',title11='$title11',title12='$title12',title13='$title13',title14='$title14',title15='$title15',title16='$title16',title17='$title17',title18='$title18',title19='$title19',title20='$title20',`title20`='$title20',`title21`='$title21',`title22`='$title22',`title23`='$title23',`title24`='$title24',`title25`='$title25',`title26`='$title26',`title27`='$title27',`title28`='$title28',`title29`='$title29',`title30`='$title30',`title31`='$title31',`title32`='$title32',`title33`='$title33',`title34`='$title34',`title35`='$title35',`title36`='$title36' WHERE page_nm='build-resume'");
		
		if($sql2){
			echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
			echo"<script type='text/javascript'>window.location = 'build-resume';</script>";
		}
			
		
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Edit <strong>Build Resume Page</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Build Resume</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					  <h2 class="panel-title"><strong>Edit </strong> Build Resume Page</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" enctype="multipart/form-data">
						  
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title1" class="form-control" value="<?php echo $result1['title1']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title2" class="form-control" value="<?php echo $result1['title2']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title3" class="form-control" value="<?php echo $result1['title3']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title4" class="form-control" value="<?php echo $result1['title4']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title5" class="form-control" value="<?php echo $result1['title5']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title6" class="form-control" value="<?php echo $result1['title6']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title7" class="form-control" value="<?php echo $result1['title7']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title8" class="form-control" value="<?php echo $result1['title8']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title9" class="form-control" value="<?php echo $result1['title9']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title10" class="form-control" value="<?php echo $result1['title10']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title11" class="form-control" value="<?php echo $result1['title11']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title12" class="form-control" value="<?php echo $result1['title12']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title13" class="form-control" value="<?php echo $result1['title13']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title14" class="form-control" value="<?php echo $result1['title14']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title15" class="form-control" value="<?php echo $result1['title15']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title16" class="form-control" value="<?php echo $result1['title16']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title17" class="form-control" value="<?php echo $result1['title17']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title18" class="form-control" value="<?php echo $result1['title18']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title19" class="form-control" value="<?php echo $result1['title19']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title20" class="form-control" value="<?php echo $result1['title20']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title21" class="form-control" value="<?php echo $result1['title21']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title22" class="form-control" value="<?php echo $result1['title22']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title23" class="form-control" value="<?php echo $result1['title23']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title24" class="form-control" value="<?php echo $result1['title24']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title25" class="form-control" value="<?php echo $result1['title25']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title26" class="form-control" value="<?php echo $result1['title26']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title27" class="form-control" value="<?php echo $result1['title27']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title28" class="form-control" value="<?php echo $result1['title28']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title29" class="form-control" value="<?php echo $result1['title29']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title30" class="form-control" value="<?php echo $result1['title30']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title31" class="form-control" value="<?php echo $result1['title31']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title32" class="form-control" value="<?php echo $result1['title32']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title33" class="form-control" value="<?php echo $result1['title33']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title34" class="form-control" value="<?php echo $result1['title34']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title35" class="form-control" value="<?php echo $result1['title35']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title36" class="form-control" value="<?php echo $result1['title36']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							
							<div class="form-group">	
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
										  <div class="col-sm-5"></div>
										  <div class="col-sm-7"><button type="submit" name="submit" class="btn btn-primary btn-lg"> Edit </button></div>
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