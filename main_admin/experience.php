<?php include('header.php'); 

$session_id=$_GET['id'];
$sela=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$session_id'");
$row=mysqli_fetch_array($sela);

if(isset($_POST['Update_profile']))
{
	$session_id=$_GET['id'];
    $exp_cnm=$_POST['exp_cnm'];
    $exp_pos=$_POST['exp_pos'];
    $exp_jsdate=$_POST['exp_jsdate'];
    $exp_jedate=$_POST['exp_jedate'];
	
	mysqli_query($con,"UPDATE `experience` SET `exp_cnm`='$exp_cnm',`exp_pos`='$exp_pos',`exp_jsdate`='$exp_jsdate',`exp_jedate`='$exp_jedate' WHERE exp_uid='$session_id'");
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='experience?id=$session_id'";
	echo "</script>";
		 
} 
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Update Experience <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Update Experience Info</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Update Experience</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form Method="POST" enctype="multipart/form-data">
                        <div class="form-group">
									<label for="inputName1" class="control-label">Company Name</label>
									<input type="text" class="form-control" id="inputName1" name="exp_cnm" placeholder="Enter Company Name" value="<?php echo $row['exp_cnm']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Position</label>
									<input type="text" class="form-control" id="inputName1" name="exp_pos"  placeholder="Enter Position" value="<?php echo $row['exp_pos']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Job start Date</label>
									<input type="date" class="form-control" id="inputEmail" name="exp_jsdate"  placeholder="Job start Date" value="<?php echo $row['exp_jsdate']; ?>">
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Job End Date</label>
									<input type="date" class="form-control" id="inputEmail" name="exp_jedate"  placeholder="Job End Date" value="<?php echo $row['exp_jedate']; ?>">
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