 <?php include('header.php'); 
 $id=$_GET['id'];
 ?>
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
          <div class="row" style="min-height:590px">
				<div class="col-md-12">
					<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="panel">
						<div class="panel-content widget-info">
						  <div class="row">
							<div class="left">
							  <i class="fa fa-user bg-green"></i>
							</div>
							<div class="right">
							  <p class="number countup" data-from="0" data-to="<?php 	
								$ida=$_GET['id'];
                               $qry_rowa=mysqli_query($con,"SELECT * FROM `user` WHERE id='$ida'"); echo mysqli_num_rows($qry_rowa)
							  ?>"></p>
							  <p class="text">Company Info</p>
							</div>
							<a href="infoc?id=<?php echo $id; ?>" class="btn btn-space bg-green active" style="width:100%;">View More</a>
						  </div>
						</div>
					  </div>
					</div>
					<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="panel">
						<div class="panel-content widget-info">
						  <div class="row">
							<div class="left">
							  <i class="fa fa-external-link bg-pink"></i>
							</div>
							<div class="right">
							  <p class="number countup" data-from="0" data-to="<?php 			
                                       $qry_rowe=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$id'"); echo mysqli_num_rows($qry_rowe)
									?>"></p>
							  <p class="text">Company Social Info</p>
							</div>
							<a href="social?id=<?php echo $id; ?>" class="btn btn-space bg-pink active" style="width:100%;">View More</a>
						  </div>
						</div>
					  </div>
					</div>
					<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="panel">
						<div class="panel-content widget-info">
						  <div class="row">
							<div class="left">
							  <i class="fa fa-tasks bg-blue"></i>
							</div>
							<div class="right">
							  <p class="number countup" data-from="0" data-to="<?php 
								$idb=$_GET['id'];
                               $qry_rowb=mysqli_query($con,"SELECT * FROM `post_job` WHERE job_uid='$idb'"); echo mysqli_num_rows($qry_rowb)
							?>"></p>
							  <p class="text">Company Post Job</p>
							</div>
							<a href="post_job?id=<?php echo $id; ?>" class="btn btn-space bg-blue active" style="width:100%;">View More</a>
						  </div>
						</div>
					  </div>
					</div>
					
				</div>
			</div>
          
         
          
		  <?php include('footer.php'); ?>