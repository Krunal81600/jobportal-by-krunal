<?php include('header.php'); 

$session_id=$_GET['id'];
$sela=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$row=mysqli_fetch_array($sela);

if(isset($_POST['Update_profile']))
{
	$social_fb=$_POST['social_fb'];
    $social_tw=$_POST['social_tw'];
    $social_li=$_POST['social_li'];
	$social_gp=$_POST['social_gp'];
	
	mysqli_query($con,"UPDATE `social` SET `social_fb`='$social_fb',`social_tw`='$social_tw',`social_li`='$social_li',`social_gp`='$social_gp' WHERE social_uid='$session_id'");
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='social?id=$session_id'";
	echo "</script>";
		 
} 
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Update Social <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Update Social Info</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Update Social</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form Method="POST" enctype="multipart/form-data">
                        <div class="form-group">
									<label for="inputName1" class="control-label">Facebook</label>
									<input type="text" class="form-control" id="inputName1" name="social_fb" placeholder="Enter Facebook" value="<?php echo $row['social_fb']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Twitter</label>
									<input type="text" class="form-control" id="inputName1" name="social_tw"  placeholder="Enter Twitter" value="<?php echo $row['social_tw']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Linkedin</label>
									<input type="text" class="form-control" id="inputEmail" name="social_li"  placeholder="Enter Linkedin" value="<?php echo $row['social_li']; ?>">
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Google+</label>
									<input type="text" class="form-control" id="inputEmail" name="social_gp"  placeholder="Enter Google+" value="<?php echo $row['social_gp']; ?>">
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-success btn-square" id="inputName1" value="Update" name="Update_profile" >
								</div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>