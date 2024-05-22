<?php
	include('../config.php');
	include('header.php');
	$id=$_GET['id'];
	$sql1 = mysqli_query($con,"SELECT * FROM `blog` WHERE id='$id'");
	$result1 = mysqli_fetch_array($sql1);
		
	if(isset($_POST['submit']))
	{
		$blog_title = mysqli_real_escape_string($con, $_POST['blog_title']);
		$blog_content = mysqli_real_escape_string($con, $_POST['blog_content']);
		$blog_date = date('Y-m-d');
		$id=$_GET['id'];
		if($_FILES['blog_img']['name'])
		{
			$img = $_FILES['blog_img']['name'];
			$size = $_FILES['blog_img']['size'];
			$tmp = $_FILES['blog_img']['tmp_name'];
			$err =array();
			if($size>204896)
			{
				$err[]="Size Of Image Too Large";
			}
			$rnd = mt_rand(0,9999);
			$image = 'img'.$rnd.$img;
			$logo = str_replace(" ","_",$image);
			if(count($err) === 0)
			{
			    move_uploaded_file($tmp,"../images/".$logo);
				$sql2 = mysqli_query($con,"UPDATE `blog` SET blog_img='$logo' , blog_title='$blog_title' , blog_content='$blog_content' , blog_date='$blog_date' WHERE id='$id'");
				if($sql2){
					echo"<script type='text/javascript'>alert('Edit Successfully');</script>";
					echo"<script type='text/javascript'>window.location = 'list_blog';</script>";
				}
			}else{
				foreach($err as $error)
				{
					echo"<script type='text/javascript'>alert('".$error."');</script>";
					echo"<script type='text/javascript'>window.location='edit_blog?id=$id';</script>";
				}
			}
		}
		else
		{
			$sql2 = mysqli_query($con,"UPDATE `blog` SET blog_title='$blog_title' , blog_content='$blog_content' , blog_date='$blog_date' WHERE id='$id'");
			if($sql2){ echo"<script type='text/javascript'>alert('Edit Successfully');</script>"; }
			echo"<script type='text/javascript'>window.location = 'list_blog';</script>";
		}
	}
?>
	<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
  			<div class="header">
            <h2>Edit <strong>Blog Section</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Blog</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
					<div class="panel-header bg-dark">
					  <h2 class="panel-title"><strong>Edit </strong> Blog</h2>
					</div>
					<div class="panel-body bg-white">			
					  <div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
								  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Choose Image </label></div>
									  <div class="option-group col-sm-7">
										<input type="file" name="blog_img">
									  </div>
									</div>
								  </div>
								  <div class="col-sm-6">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Now Image  </label></div>
									  <div class="col-sm-7"> <img src="../images/<?php echo $result1['blog_img']; ?>" alt="logo" height="100" width="100"></div>
									  </div>
								  </div>
								</div>
							</div>
							
							<div class="form-group">							  
								<div class="row">
								  <div class="col-sm-12">
									<div class="form-group">
									  <div class="col-sm-5"><label class="control-label">Blog Title </label></div>
									  <div class="option-group col-sm-7">
										 <input type="text" name="blog_title" value="<?php echo $result1['blog_title']; ?>" class="form-control">
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
										  <textarea class="summernote" name="blog_content"><?php echo $result1['blog_content']; ?></textarea>
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