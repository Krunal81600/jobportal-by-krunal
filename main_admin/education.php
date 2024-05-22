<?php include('header.php'); 

$session_id=$_GET['id'];
$sela=mysqli_query($con,"SELECT * FROM `education` WHERE edu_uid='$session_id'");
$row=mysqli_fetch_array($sela);

if(isset($_POST['Update_profile']))
{
	$session_id=$_GET['id'];
    $edu_title=$_POST['edu_title'];
    $edu_sdate=$_POST['edu_sdate'];
    $edu_edate=$_POST['edu_edate'];
    $edu_info=$_POST['edu_info'];
	
	mysqli_query($con,"UPDATE `education` SET `edu_title`='$edu_title',`edu_sdate`='$edu_sdate',`edu_edate`='$edu_edate',`edu_info`='$edu_info' WHERE edu_uid='$session_id'");
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='education?id=$session_id'";
	echo "</script>";
		 
} 
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Update Education <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Update Education Info</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Update Education</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form Method="POST" enctype="multipart/form-data">
                        <div class="form-group">
									<label for="inputName1" class="control-label">Degree Title</label>
									<input type="text" class="form-control" id="inputName1" name="edu_title" placeholder="Enter Degree Title" value="<?php echo $row['edu_title']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Degree start Date</label>
									<input type="date" class="form-control" id="inputName1" name="edu_sdate"  placeholder="Enter Degree start Date" value="<?php echo $row['edu_sdate']; ?>" >
								</div>
								<div class="form-group">
									<label for="inputEmail" class="control-label">Degree End Date</label>
									<input type="date" class="form-control" id="inputEmail" name="edu_edate"  placeholder="Degree End Date"
										value="<?php echo $row['edu_edate']; ?>"
									   >
								</div>
								<div class="form-group">
									<label for="inputName1" class="control-label">Description</label>
									<textarea class="form-control" id="inputName1"  rows="8" name="edu_info"  placeholder="Enter Description" ><?php echo $row['edu_info']; ?></textarea>
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