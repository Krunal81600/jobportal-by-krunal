 <?php include('header.php'); ?>
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
          <div class="row" style="min-height:590px">
				<div class="col-md-12">
					<div class="widget-infobox">
						<div class="infobox col-md-3">
						  <div class="left">
							<i class="fa fa-users bg-blue"></i>
						  </div>
						  <div class="right">
							<div>
							  <span class="c-primary pull-left"><?php 	
                              $qry_row=mysqli_query($con,"SELECT * FROM `user` WHERE rtype='Employee'"); echo mysqli_num_rows($qry_row)
							?></span>
							</div>
							<div class="txt">Total User</div>
						  </div>
						</div>
						<div class="infobox col-md-3">
						  <div class="left">
							<i class="fa fa-building-o bg-red"></i>
						  </div>
						  <div class="right">
							<div class="clearfix">
							  <div>
								<span class="c-red pull-left"><?php 	
                              $qry_row=mysqli_query($con,"SELECT * FROM `user` WHERE rtype='Employer'"); echo mysqli_num_rows($qry_row)
							?></span>
							  </div>
							  <div class="txt">Total Company</div>
							</div>
						  </div>
						</div>
						<div class="infobox col-md-3">
						  <div class="left">
							<i class="fa fa-pencil-square bg-green"></i>
						  </div>
						  <div class="right">
							<div class="clearfix">
							  <div>
								<span class="c-green pull-left"><?php 	
                              $qry_row=mysqli_query($con,"SELECT * FROM `post_job`"); echo mysqli_num_rows($qry_row)
							?></span>
							  </div>
							  <div class="txt">Total Post</div>
							</div>
						  </div>
						</div>
						<div class="infobox col-md-3">
						  <div class="left">
							<i class="fa fa-tasks bg-purple"></i>
						  </div>
						  <div class="right">
							<div class="clearfix">
							  <div>
								<span class="c-primary pull-left"><?php 	
                              $qry_row=mysqli_query($con,"SELECT * FROM `job_app`"); echo mysqli_num_rows($qry_row)
							?></span>
							  </div>
							  <div class="txt">Total Job Apply</div>
							</div>
						  </div>
						</div>
						<div class="infobox col-md-3">
						  <div class="left">
							<i class="icon-heart bg-orange"></i>
						  </div>
						  <div class="right">
							<div class="clearfix">
							  <div>
								<span class="c-red pull-left"><?php 	
                              $qry_row=mysqli_query($con,"SELECT * FROM `hire`"); echo mysqli_num_rows($qry_row)
							?></span>
							  </div>
							  <div class="txt">Total Job Hire</div>
							</div>
						  </div>
						</div>
						<!--<div class="infobox">
						  <div class="left">
							<i class="icon-microphone bg-dark"></i>
						  </div>
						  <div class="right">
							<div class="clearfix">
							  <div>
								<span class="c-green pull-left">16</span>
								<span class="c-green pull-right">24%</span>
							  </div>
							  <div class="txt">records</div>
							</div>
						  </div>
						</div>
					  </div>-->
				</div>
			</div>
			</div>
          
         
          
		  <?php include('footer.php'); ?>