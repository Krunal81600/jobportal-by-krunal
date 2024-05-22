<?php include('header.php'); 

$id=$_GET['id'];
$sela=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$id'");
$rowa=mysqli_fetch_array($sela);

if($_REQUEST['delete'])
{
	$id=$_GET['id'];
	$session_id=$_SESSION['member_id'];
	mysqli_query($con,"DELETE FROM `post_job` WHERE id='$id'");
	
	$notify="Delete One Post";
	$type="user";
	$link="apppost";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
	
	?>
	<script>
		alert("Successfully Deleted");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='company-dashboard-active-jobs'";
	echo "</script>";
}

if(isset($_POST['submit']))
{
    $job_title=$_POST['job_title'];
    $job_location=$_POST['job_location'];
    $job_details=$_POST['job_details'];
    $job_category=$_POST['job_category'];
    $job_type=$_POST['job_type'];
    $currency=$_POST['currency'];
    $job_salary=$_POST['job_salary'];
    $job_tags=$_POST['job_tags'];
    $job_exp=$_POST['job_exp'];
    $job_edate=$_POST['job_edate'];
	$country=$_POST['country'];
    $idu=$_GET['id'];
	$session_id=$_SESSION['member_id'];
    
	mysqli_query($con,"UPDATE `post_job` SET `job_title`='$job_title',`job_location`='$job_location',`job_details`='$job_details',`job_category`='$job_category',`job_type`='$job_type',`job_exp`='$job_exp',`currency`='$currency',`job_salary`='$job_salary',`job_tags`='$job_tags',`job_edate`='$job_edate',`country`='$country' WHERE id='$idu'");
		
	$notify="Update His Post Details";
	$type="user";
	$link="apppost?id=$idu&edit=edit";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
	
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='company-dashboard-active-jobs'";
	echo "</script>";
}

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='post-job'");
$result12 = mysqli_fetch_array($sql12);
?>
        <section class="post-job ">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="Heading-title-left black small-heading">
                            <h3><?php echo $result12['title1']; ?></h3>
                        </div>
                        <div class="post-job2-panel">
                            <form class="row" method="POST">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title2']; ?></label>
                                        <input type="text" placeholder="<?php echo $result12['title2']; ?>" value="<?php echo $rowa['job_title']; ?>" name="job_title" class="form-control" required>
                                    </div>
                                </div>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title3']; ?></label>
                                        <input type="date" placeholder="<?php echo $result12['title3']; ?>" value="<?php echo $rowa['job_edate']; ?>" name="job_edate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title4']; ?></label>
                                        <select class="questions-category form-control" name="job_category" required>
                                            <option value="0"><?php echo $result12['title5']; ?></option>
											<?php 
											$r2 = mysqli_query($con,"SELECT * FROM `category`");
											while($row2 = mysqli_fetch_array($r2))
											{ ?>
											<option value="<?php echo $row2['category']; ?>" <?php if($rowa['job_category']==$row2['category']) echo "selected='selected'"; ?>><?php echo $row2['category']; ?></option>	
											<?php
											}
											?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title6']; ?></label>
                                        <select class="questions-category form-control" name="job_type" required>
                                            <option value="Full Time" <?php if($rowa['job_type']=="Full Time") echo "selected='selected'"; ?>><?php echo $result12['title7']; ?></option>
											<option value="Part Time" <?php if($rowa['job_type']=="Part Time") echo "selected='selected'"; ?>><?php echo $result12['title8']; ?></option>
											<option value="Remote" <?php if($rowa['job_type']=="Remote") echo "selected='selected'"; ?>><?php echo $result12['title9']; ?></option>
											<option value="Freelancer" <?php if($rowa['job_type']=="Freelancer") echo "selected='selected'"; ?>><?php echo $result12['title10']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title11']; ?></label>
                                        <select class="questions-category form-control" name="job_exp" required>
                                            <option value="Fresher" <?php if($rowa['job_exp']=="Fresher") echo "selected='selected'"; ?>><?php echo $result12['title12']; ?></option>
											<option value="1 Year" <?php if($rowa['job_exp']=="1 Year") echo "selected='selected'"; ?>><?php echo $result12['title13']; ?></option>
											<option value="2 Year" <?php if($rowa['job_exp']=="2 Year") echo "selected='selected'"; ?>><?php echo $result12['title14']; ?></option>
											<option value="3 Year" <?php if($rowa['job_exp']=="3 Year") echo "selected='selected'"; ?>><?php echo $result12['title15']; ?></option>
											<option value="4 Year" <?php if($rowa['job_exp']=="4 Year") echo "selected='selected'"; ?>><?php echo $result12['title16']; ?></option>
											<option value="5 Year" <?php if($rowa['job_exp']=="5 Year") echo "selected='selected'"; ?>><?php echo $result12['title17']; ?></option>
											<option value="6+ Year" <?php if($rowa['job_exp']=="6+ Year") echo "selected='selected'"; ?>><?php echo $result12['title18']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-4">
										<div class="form-group">
											<label><?php echo $result12['title19']; ?></label>
											<input type="text" name="currency" placeholder="<?php echo $result12['title19']; ?>" value="<?php echo $rowa['currency']; ?>" class="form-control" required>
										</div>
                                    </div>
									<div class="col-md-8">
										<div class="form-group">
											<label><?php echo $result12['title20']; ?></label>
											<input type="text" placeholder="<?php echo $result12['title20']; ?>" name="job_salary" value="<?php echo $rowa['job_salary']; ?>" class="form-control" required>
										</div>
									</div>
                                </div>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title23']; ?></label>
                                        <select class="questions-category form-control" id="country" name="country" required>
                                            <option value="0"><?php echo $result12['title24']; ?></option>
											<?php 
											$r2 = mysqli_query($con,"SELECT * FROM `country`");
											while($row2 = mysqli_fetch_array($r2))
											{ ?>
											<option value="<?php echo $row2['id']; ?>" <?php if($rowa['country']==$row2['id']) echo "selected='selected'"; ?>><?php echo $row2['countrynm']; ?></option>	
											<?php
											}
											?>
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title25']; ?></label>
                                        <select class="form-control" id="city" name="job_location" required>
                                            <option value="">-----<?php echo $result12['title26']; ?>-----</option>
                                            <option value=""><?php echo $result12['title27']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title21']; ?></label>
                                        <input type="text" id="tags" name="job_tags" value="<?php echo $rowa['job_tags']; ?>"  class="form-control" data-role="tagsinput" required>
                                    </div>
                                </div>
								
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label><?php echo $result12['title28']; ?></label>
                                        <textarea id="ckeditor" name="job_details" required><?php echo $rowa['job_details']; ?> </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-default pull-right" type="submit" name="submit"><?php echo $result12['title29']; ?> <i class="fa fa-angle-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="widget">
                            <div class="widget-heading"><span class="title"><?php echo $result12['title30']; ?></span></div>
                            <div class="" id="followers">
                                <ul class="list-group list-group-dividered list-group-full">
								<?php
									$sel=mysqli_query($con,"SELECT * FROM `user` WHERE paid_user_ap='1' ORDER BY id ASC LIMIT 6");
									while($row=mysqli_fetch_array($sel))
									{
									?>
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="avatar avatar-online" href="javascript:void(0)">
                                                    <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive" alt="">
                                                    <i></i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-default btn-sm"><?php echo $result12['title31']; ?></button>
                                                </div>
                                                <div><a class="name" href="user_resume?id=<?php echo $row['id']; ?>"><?php echo $row['fname']." ".$row['lname']; ?></a></div>
                                                <small><?php echo $row['email']; ?></small>
                                            </div>
                                        </div>
                                    </li>
                                   <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="brand-logo-area clients-bg">
		<div class="clients-list">
			<?php
			$r2 = mysqli_query($con,"SELECT * FROM `brand`");
			while($row2 = mysqli_fetch_array($r2))
			{
			?>
			<div class="client-logo"> <a href="<?php echo $row2['brand_link']; ?>" target="_blank"><img src="images/clients/<?php echo $row2['brand_img']; ?>" class="img-responsive" alt="Brand Image" /></a> </div>
			<?php } ?>
		</div>
	</div>
<script src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData2.php',
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