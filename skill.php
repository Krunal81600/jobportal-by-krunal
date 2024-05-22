<?php include('header.php'); 

$session_id=$_GET['id'];
$sela=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$session_id'");
$row=mysqli_fetch_array($sela);

if(isset($_POST['Update_profile']))
{
	$session_id=$_GET['id'];
    $slug=$_POST['skill_nm'];
	for($i=0;$i < count($slug);$i++)
	{
		$val[$i]=$_POST['skill_nm'][$i].",".$_POST['skill_pr'][$i];
	}
	$val_sea= serialize($val);
	mysqli_query($con,"UPDATE `skill` SET `skill_nm`='$val_sea' WHERE skill_uid='$session_id'");
	?>
	<script>
		alert("Successfully Updated");
	</script>
	<?php
	echo "<script type='text/javascript'>";
	echo "window.location='skill?id=$session_id'";
	echo "</script>";
		 
} 
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Update Skill <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Update Skill Info</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Update Skill</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <form Method="POST" enctype="multipart/form-data">
							<div class="field_wrapper">
								<?php
								for($j=0;$j<count($fee_details);$j++)
								{
								$fee_details_id=$fee_details[$j];
								$explode=explode(',',$fee_details_id);
								if($j==0)
									{
								?>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label>Skill Name <span class="required">*</span></label>
										<input type="text" placeholder="Skill Name" name="skill_nm[]" class="form-control" value="<?php echo $explode[0]; ?>"  required>
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label>Add Percentage (%) <span class="required">*</span></label>
										<input type="text" placeholder="Percentage %" name="skill_pr[]" class="form-control" value="<?php echo $explode[1]; ?>" required>
									</div>
								</div>
								<div class="col-md-2 col-sm-12">
									<a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png"/></a>
								</div>
							<?php } else { ?>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label>Skill Name <span class="required">*</span></label>
										<input type="text" placeholder="Skill Name" name="skill_nm[]" class="form-control" value="<?php echo $explode[0]; ?>"  required>
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label>Add Percentage (%) <span class="required">*</span></label>
										<input type="text" placeholder="Percentage %" name="skill_pr[]" class="form-control" value="<?php echo $explode[1]; ?>" required>
									</div>
								</div>
								<div class="col-md-2 col-sm-12">
									<a href="javascript:void(0);" class="remove_button" title="Add field"><img src="remove-icon.png"/></a>
								</div>
						<?php } } ?>
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
<script src="../jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div class="newdata"><div class="col-md-6 col-sm-12"><div class="form-group"><label>Skill Name <span class="required">*</span></label><input type="text" placeholder="Skill Name" class="form-control" name="skill_nm[]"></div></div><div class="col-md-4 col-sm-12"><div class="form-group"><label>Add Percentage (%) <span class="required">*</span></label><input type="text" name="skill_pr[]" placeholder="Percentage %" class="form-control"></div></div><div class="col-md-2 col-sm-12"><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div></div>'; //New input field html 
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('.newdata').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>
		   <?php include('footer.php'); ?>