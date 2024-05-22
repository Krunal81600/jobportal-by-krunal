<?php
	include('header.php');
	$session_id=$_SESSION['member_id'];
$sel=mysqli_query($con,"SELECT * FROM `user` WHERE id='$session_id'");
$row=mysqli_fetch_array($sel);

$exp_pos=$row['id'];
$selex=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$exp_pos'");
$rowex=mysqli_fetch_array($selex);

$seld=mysqli_query($con,"SELECT * FROM `social` WHERE social_uid='$session_id'");
$rowd=mysqli_fetch_array($seld);

error_reporting(0);
if($_REQUEST['id'])
{
	$id=$_GET['id'];
	mysqli_query($con,"DELETE FROM `resume` WHERE id='$id'");
	echo "<script type='text/javascript'>";
	echo "window.location='user-resume'";
	echo "</script>";
}

if(isset($_POST['submit']))
{	
	$resume_title=$_POST['resume_title'];
	
	$error = array();
	$accepteble = array
	(
		'application/pdf',
		'application/doc',
		'application/docx',
		'application/xls',
		'application/xlsx',
		'application/msword',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
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
	$lfile = str_replace(' ','_',$img);
	$r = move_uploaded_file($tmp,'resume/'.$lfile);
	
	if(count($error) == 0)
	{
		$session_id=$_SESSION['member_id'];
		mysqli_query($con,"INSERT INTO `resume`(`resume_uid`, `resume_title`, `resume_nm`) VALUES ('$session_id','$resume_title','$lfile')");
		
		$notify="Upload Resume";
		$type="user";
		$link="resume?id=$session_id";
		$jct=date('Y-m-d H:i:s');
		$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
		
		?>
		<script type="text/javascript">
		alert("Successfully Uploaded");
		</script>
		<?php
		echo "<script type='text/javascript'>";
		echo "window.location='user-resume'";
		echo "</script>";
	}
	else
	{
		foreach($error as $err)
		{
			echo '<script>alert("'.$err.'");</script>';
			echo"<script type='text/javascript'>";	
			echo"window.location = 'user-resume'";
			echo"</script>";
		}
		die();
	}
	 
}

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='user-resume'");
$result12 = mysqli_fetch_array($sql12);

$sql123 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='sidebar'");
$result123 = mysqli_fetch_array($sql123);
?>
        <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="profile-card">
                                <div class="banner">
                                    <img src="upload/<?php echo $row['cover']; ?>" alt="" class="img-responsive">
                                </div>
                                <div class="user-image">
                                    <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive img-circle" alt="">
                                </div>
                                <div class="card-body">
                                    <h3><?php echo $row['user']; ?></h3>
                                    <span class="title"><?php echo $rowex['exp_pos']; ?></span>
                                </div>
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="<?php echo $rowd['social_fb']; ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="<?php echo $rowd['social_tw']; ?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a href="<?php echo $rowd['social_li']; ?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="<?php echo $rowd['social_gp']; ?>" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="profile-nav">
                                <div class="panel">
                                    <ul class="nav nav-pills nav-stacked">
										<li>
											<a href="user-dashboard"> <i class="fa fa-user"></i> <?php echo $result123['title1']; ?></a>
										</li>
										<li>
											<a href="user-edit-profile"> <i class="fa fa-edit"></i> <?php echo $result123['title2']; ?></a>
										</li>
										<li>
											<a href="build-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title3']; ?></a>
										</li>
										<li class="active">
											<a href="user-resume"> <i class="fa fa-file-o"></i><?php echo $result123['title4']; ?> </a>
										</li>
										<li>
											<a href="user-job-applied"> <i class="fa  fa-list-ul"></i> <?php echo $result123['title5']; ?></a>
										</li>
										<li>
											<a href="user-followed-companies"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title6']; ?> </a>
										</li>
										<li>
											<a href="paid_resume"> <i class="fa fa-money"></i> <?php echo $result123['title7']; ?></a>
										</li>
										<li>
											<a href="interest_in_company"> <i class="fa fa-file-o"></i> <?php echo $result123['title8']; ?></a>
										</li>
										<li>
											<a href="hire_company"> <i class="fa  fa-bookmark-o"></i> <?php echo $result123['title9']; ?> </a>
										</li>
									</ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="heading-inner first-heading">
                                <p class="title"><?php echo $result12['title1']; ?></p>
                                <a href="javascript:void(0)"><span class="pull-right add-button btn-default" data-target="#myModal" data-toggle="modal"> <?php echo $result12['title2']; ?></span></a>
								<div id="myModal" class="modal fade" role="dialog">
								<div class="modal-dialog"> 
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header rte">
											<h2 class="modal-title1"><?php echo $result12['title3']; ?></h2>
											<p><?php echo $result12['title4']; ?></p>
										</div>
										<form method="POST" enctype="multipart/form-data">
										<div class="modal-body">
											 <div class="form-group">
                                                <label><?php echo $result12['title5']; ?> <span class="required">*</span></label>
                                                <input type="text" name="resume_title"  placeholder="Resume Title" class="form-control" required>
                                             </div>
											 <div class="input-group image-preview form-group">
												<label><?php echo $result12['title6']; ?>: <span class="required">*</span></label>
												<input type="text" placeholder="Upload Cover Image" class="form-control image-preview-filename" disabled="disabled" style="display: none;">
												<span class="input-group-btn" style="padding-top: 0px;">
													<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
														<span class="glyphicon glyphicon-remove"></span> <?php echo $result12['title7']; ?>
													</button>
													<div class="btn btn-default image-preview-input">
														<span class="glyphicon glyphicon-folder-open"></span>
														<span class="image-preview-input-title"><?php echo $result12['title8']; ?></span>
														<input type="file" onchange="readURLA(this);" name="resume" accept="file_extension" name="input-file-preview" required/>
													</div>
												</span>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $result12['title9']; ?></button>
											<button type="submit"  name="submit" class="btn btn-Success" ><?php echo $result12['title10']; ?></button>
										</div>
										</form>
									</div>
								</div>
							</div>
                            </div>
                            <div class="resume-list">
                            	<div class="table-responsive">
                                    <table class="table  table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th><?php echo $result12['title11']; ?></th>
                                                <th><?php echo $result12['title12']; ?></th>
                                                <th><?php echo $result12['title13']; ?></th>
                                                <th><?php echo $result12['title14']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$no=0;
										
										if(isset($_REQUEST['start']))
										{
										$startno=$_REQUEST['start'];
										}
										else
										{
										$startno=0;
										}
										$pagesize=7;
										$i=0;
										$pageno=1;
										
										$uid=$_SESSION['member_id'];
										
										$SqlQueryRun1 = mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$uid'");
										$total_rows=mysqli_num_rows($SqlQueryRun1);
										
										$res=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$uid' limit $startno,$pagesize");
										while($rowre=mysqli_fetch_array($res))
										{
											$no=$no+1;
										?>
                                            <tr>
                                                <th scope="row"><?php echo $no; ?></th>
                                                <td>
                                                    <h5><?php echo $rowre['resume_title']; ?></h5></td>
                                                <td><a class="btn btn-primary" target="_blank" href="resume/<?php echo $rowre['resume_nm']; ?>"> <?php echo $result12['title13']; ?> </a></td>
                                                <td><a class="btn btn-danger" href="user-resume?id=<?php echo $rowre['id']; ?>"> <?php echo $result12['title15']; ?> </a></td>
                                            </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="pagination-box clearfix">
                                    <ul class="pagination">
                                        <li>
                                            <a href="user-resume?start=0" aria-label="Previous"> <span aria-hidden="true"><?php echo $result12['title16']; ?></span> </a>
                                        </li>
										<?php
										for($j=0;$j<$total_rows;$j=$j+$pagesize)
										{
										if($startno==$j)
										{
										?>
                                        <li><a href="user-resume?start=0"><?php echo $pageno; ?></a></li>
                                       <?php
										}
										else
										{
										?>
										<li><a href="user-resume?start=<?php echo $j; ?>"><?php echo $pageno; ?></a></li>
										<?php
										}
										$pageno++;
										}
										?>
                                        <li>
                                            <a href="user-resume?start=<?php echo $j-$pagesize; ?>" aria-label="Next"> <span aria-hidden="true"><?php echo $result12['title17']; ?></span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
<?php
	include('footer.php');
?>