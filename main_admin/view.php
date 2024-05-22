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
							  <p class="text">Candidate Acoount Info</p>
							</div>
							<a href="info?id=<?php echo $id; ?>" class="btn btn-space bg-green active" style="width:100%;">View More</a>
						  </div>
						</div>
					  </div>
					</div>
					<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="panel">
						<div class="panel-content widget-info">
						  <div class="row">
							<div class="left">
							  <i class="fa fa-graduation-cap bg-blue"></i>
							</div>
							<div class="right">
							  <p class="number countup" data-from="0" data-to="<?php 
								$idb=$_GET['id'];
                               $qry_rowb=mysqli_query($con,"SELECT * FROM `education` WHERE edu_uid='$idb'"); echo mysqli_num_rows($qry_rowb)
							?>"></p>
							  <p class="text">Candidate Education Info</p>
							</div>
							<a href="education?id=<?php echo $id; ?>" class="btn btn-space bg-blue active" style="width:100%;">View More</a>
						  </div>
						</div>
					  </div>
					</div>
					<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="panel">
						<div class="panel-content widget-info">
						  <div class="row">
							<div class="left">
							  <i class="fa fa-star-o bg-red"></i>
							</div>
							<div class="right">
							  <p class="number countup" data-from="0" data-to="<?php 
								$idc=$_GET['id'];
                               $qry_rowc=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$idc'"); echo mysqli_num_rows($qry_rowc)
							?>"></p>
							  <p class="text">Candidate Experience Info</p>
							</div>
							<a href="experience?id=<?php echo $id; ?>" class="btn btn-space bg-red active" style="width:100%;">View More</a>
						  </div>
						</div>
					  </div>
					</div>
					<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="panel">
						<div class="panel-content widget-info">
						  <div class="row">
							<div class="left">
							  <i class="fa fa-asterisk bg-purple"></i>
							</div>
							<div class="right">
							  <p class="number countup" data-from="0" data-to="<?php 
							$idd=$_GET['id'];
                             $qry_rowd=mysqli_query($con,"SELECT * FROM `skill` WHERE skill_uid='$idd'"); echo mysqli_num_rows($qry_rowd);
				            ?>"></p>
							  <p class="text">Candidate Skill Info</p>
							</div>
							<a href="skill?id=<?php echo $id; ?>" class="btn btn-space bg-purple active" style="width:100%;">View More</a>
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
							  <p class="text">Candidate Social Info</p>
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
							  <i class="fa fa-file-pdf-o bg-orange"></i>
							</div>
							<div class="right">
							  <p class="number countup" data-from="0" data-to="<?php 	
								$idf=$_GET['id'];
                               $qry_rowf=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$idf'"); echo mysqli_num_rows($qry_rowf)
						     ?>"></p>
							  <p class="text">Candidate Resume List</p>
							</div>
							<a href="resume?id=<?php echo $id; ?>" class="btn btn-space bg-orange active" style="width:100%;">View More</a>
						  </div>
						</div>
					  </div>
					</div>
				</div>
			</div>
          
         
          
		  <?php include('footer.php'); ?>