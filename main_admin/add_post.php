<?php include('header.php'); 

if(isset($_POST['submit']))
{
    $job_title=$_POST['job_title'];
    $job_location=$_POST['job_location'];
    $job_details=$_POST['job_details'];
    $job_category=$_POST['job_category'];
    $job_type=$_POST['job_type'];
    $job_salary=$_POST['job_salary'];
    $job_tags=$_POST['job_tags'];
    $job_exp=$_POST['job_exp'];
    $job_edate=$_POST['job_edate'];
    $job_uid=$_POST['job_uid'];
	$selecou=mysqli_query($con,"SELECT * FROM `user` WHERE id='$job_uid'");
	$rowcou=mysqli_fetch_array($selecou);
	$country=$_POST['country'];
    $job_date=date("Y-m-d h:i:sa");
    
	mysqli_query($con,"INSERT INTO `post_job`(`job_title`,`job_location`,`job_details`,`job_category`,`job_type`,`job_exp`,`job_salary`,`job_tags`,`job_uid`,`job_date`,`job_edate`,`country`) VALUES ('$job_title','$job_location','$job_details','$job_category','$job_type','$job_exp','$job_salary','$job_tags','$job_uid','$job_date','$job_edate','$country')");
	
	?>
	<script>
		alert("Successfully Posted");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='add_post'";
	echo "</script>";
}
?>
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Add Post <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Add Post</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Add Post</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <form class="row" method="POST">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Job Post By</label>
									<select class="questions-category form-control" name="job_uid">
										<option value="0">All Categories</option>
										<?php 
										$r2 = mysqli_query($con,"SELECT * FROM `company`");
										while($row2 = mysqli_fetch_array($r2)){
											echo"<option value='".$row2['comp_uid']."'>".$row2['industry']."</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Title</label>
									<input type="text" placeholder="Job Title" name="job_title" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Select Job Expire Date</label>
									<input type="date" placeholder="Select Job Expire Date" name="job_edate" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Category</label>
									<select class="form-control" name="job_category">
										<option value="0">All Categories</option>
										<?php 
										$r2 = mysqli_query($con,"SELECT * FROM `category`");
										while($row2 = mysqli_fetch_array($r2)){
											echo"<option value='".$row2['category']."'>".$row2['category']."</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Type</label>
									<select class="questions-category form-control" name="job_type">
										<option value="Full Time">Full Time</option>
										<option value="Part Time">Part Time</option>
										<option value="Remote">Remote</option>
										<option value="Freelancer">Freelancer</option>
									</select>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Job Experience</label>
									<select class="questions-category form-control" name="job_exp">
										<option value="Fresher">Fresher</option>
										<option value="1 Year">1 Year</option>
										<option value="2 Year">2 Years</option>
										<option value="3 Year">3 Years</option>
										<option value="4 Year">4 Years</option>
										<option value="5 Year">5 Years</option>
										<option value="6+ Year">6+ Years</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Expected Salary</label>
									<select class="questions-category form-control" name="job_salary">
									   <option value="Less than 10,000">Less than 10,000</option>
										<option value="10,000 +">10,000 +</option>
										<option value="20,000 +">20,000 +</option>
										<option value="30,000 +">30,000 +</option>
										<option value="40,000 +">40,000 +</option>
										<option value="50,000 +">50,000 +</option>
										<option value="100,000 +">100,000 +</option>
										<option value="Negotiables">Negotiable</option>
									</select>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Tags</label>
									<input type="text" id="tags" name="job_tags" value="software ,laravel, html" class="form-control" data-role="tagsinput">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Country</label>
									<select class="form-control" id="country" name="country" required>
										<option value="">Select Country</option>
										 <option value="">Other</option>
										<?php 
										$r2 = mysqli_query($con,"SELECT * FROM `country`");
										while($row2 = mysqli_fetch_array($r2))
										{ ?>
										<option value="<?php echo $row2['id']; ?>"><?php echo $row2['countrynm']; ?></option>	
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Location</label>
									<select class="form-control" id="city" name="job_location" required>
										<option value="">-----Choose Country First-----</option>
										<option value="Other">Other</option>
									</select>
									
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Job Detials</label>
									<textarea class="cke-editor" name="job_details" ></textarea>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button class="btn btn-default pull-right" type="submit" name="submit">Post Job <i class="fa fa-angle-right"></i></button>
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
 <script src="../jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">-----Choose Country First-----</option>');
        }
    });
    
});
</script>         
		   <?php include('footer.php'); ?>