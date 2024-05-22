<?php include('header.php'); 

if(isset($_POST['resume_up']))
{	
	$resume_title=$_POST['resume_title'];
	
	$error = array();
	$accepteble = array
	(
		'application/pdf',
		'application/doc'
	);
	
	$img = $_FILES['resume']['name'];
	$tmp = $_FILES['resume']['tmp_name'];
	$size = $_FILES['resume']['size'];
	$type = $_FILES['resume']['type'];
	
	if($size >= 2097152 || ($size == 0))
	{
		$error[] = "Resume Size too large. File must be less than 2 megabytes.$size";
	}
	if(!in_array($type,$accepteble) && (!empty($type)))
	{
		$error[] = "Invalid file type. Only PDF and DOC types are accepted. ";
	}
	
	$rnd = mt_rand(1,99999);
	$fnm = "resume". $rnd . $img;
	$lfile = str_replace(' ','_',$fnm);
	$r = move_uploaded_file($tmp,'../resume/'.$lfile);
	
	if(count($error) == 0)
	{
		$session_id=$_GET['id'];
		mysqli_query($con,"INSERT INTO `resume`(`resume_uid`, `resume_title`, `resume_nm`) VALUES ('$session_id','$resume_title','$lfile')");
		?>
		<script type="text/javascript">
		alert("Successfully Uploaded");
		</script>
		<?php
		echo "<script type='text/javascript'>";      
		echo "window.location='resume?id=$session_id'";
		echo "</script>";
	}
	else
	{
		foreach($error as $err)
		{
			echo '<script>alert("'.$err.'");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'resume?id=$session_id'";
			echo"</script>";
		}
		die();
	}
	 
} 
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Add Resume <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">Add Resume Info</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Add Resume</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
						<form method="POST" enctype="multipart/form-data">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Resume Title <span class="required">*</span></label>
									<input type="text" name="resume_title" placeholder="Resume Title" class="form-control" required>
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Browse Resume <span class="required">*</span></label>
									<input type="file" name="resume" placeholder="Upload Resume" class="form-control"  required>
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
								<button class="btn btn-success pull-right" name="resume_up" type="submit"> Upload </button>
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Resume </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Sr. #</th>
						<th>Resume Title</th>
						<th>Download</th>
						<th>Remove</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					$no=0;
					$uid=$_GET['id'];
					$res=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$uid'");
					while($rowre=mysqli_fetch_array($res))
					{
						$no=$no+1;
					?>
						<tr>
							<th scope="row"><?php echo $no; ?></th>
							<td>
								<h5><?php echo $rowre['resume_title']; ?></h5></td>
							<td><a class="btn btn-primary" target="_blank" href="../resume/<?php echo $rowre['resume_nm']; ?>"> Download </a></td>
							<td><a class="btn btn-danger" href="user-resume?id=<?php echo $rowre['id']; ?>"> Delete </a></td>
						</tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
		   <?php include('footer.php'); ?>