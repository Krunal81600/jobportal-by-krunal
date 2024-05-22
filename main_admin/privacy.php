<?php
	include('../config.php');
	include('header.php');
	$sql1 = mysqli_query($con,"SELECT * FROM `privacy` WHERE id='1'");
	$result1 = mysqli_fetch_array($sql1);
	
	$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='privacy'");
	$result12 = mysqli_fetch_array($sql12);
	
	if(isset($_POST['submit']))
	{
		$content = mysqli_real_escape_string($con, $_POST['content']);
		$title1 = mysqli_real_escape_string($con, $_POST['title1']);
		
		$sql2 = mysqli_query($con,"UPDATE `privacy` SET content='$content' WHERE id='1'");
		
		$sql2 = mysqli_query($con,"UPDATE `all_title` SET title1='$title1' WHERE page_nm='privacy'");
		
		if($sql2){ echo"<script type='text/javascript'>alert('Edit Successfully');</script>"; }
		echo"<script type='text/javascript'>window.location = 'privacy';</script>";
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Edit <strong>Privancy Page</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Privancy</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					  <h2 class="panel-title"><strong>Edit </strong> Privancy</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" enctype="multipart/form-data">
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-12">
											<input type="text" name="title1" class="form-control" value="<?php echo $result12['title1']; ?>">
									  </div>
									</div>
								  </div>
								</div>
							</div>
							<div class="form-group">				 
		    				  <div class="row">
								<div class="col-md-12 portlets">
								  <div class="panel">
									<div class="panel-header panel-controls">
									  <h3><i class="icon-note"></i> <strong>Edit</strong> Content</h3>
									</div>
									<div class="panel-content">
									  <div class="row">
										<div class="col-md-12">
										  <textarea class="summernote" name="content"><?php echo $result1['content']; ?></textarea>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							  </div>
							</div>
							<div class="form-group">	
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
										  <div class="col-sm-5"></div>
										  <div class="col-sm-7"><button type="submit" name="submit" class="btn btn-primary btn-lg"> Edit </button></div>
										</div>
									</div>
								</div>
							</div>
						  </form>
						</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
        
<?php
	include('footer.php');
?>