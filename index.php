<?php
	include('header.php');
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	/*if($_REQUEST['apply'])
	{
		$uid=$_SESSION['member_id'];
		$comp_id=$_GET['comp_id'];
		
		mysqli_query($con,"INSERT INTO `job_app`(`job_app_uid`, `job_app_compid`) VALUES ('$uid','$comp_id')");
		
		$notify="Apply For Job";
		$type="user";
		$link="job_apply?id=$uid";

		$query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$uid','$notify','$type','$link')");
		
		?>
		<script>
			alert("Successfully Applied");
		</script>
		<?php
		
		echo "<script type='text/javascript'>";
		echo "window.location='index'";
		echo "</script>";
	}*/

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='index'");
$result12 = mysqli_fetch_array($sql12);	
	
$ip = $_SERVER['REMOTE_ADDR']; 
$freegeoipjson = file_get_contents("http://freegeoip.net/json/". $ip ."");
$jsondata = json_decode($freegeoipjson);
$countryfromip = $jsondata->country_name;
$cityfromip = $jsondata->city;

$cityip = $cityfromip; 

/*Get Country name by return array*/
$countryip = $countryfromip;
?>
    <section class="main-section parallex">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-xs-12 nopadding">
                    <div class="search-form-contaner" style="margin-top: 50px;">
					<?php
					$sql1hm = mysqli_query($con,"SELECT * FROM `home_content` WHERE id='1'");
					$resulthm = mysqli_fetch_array($sql1hm);	
					?>
                        <h1 class="search-main-title" style="font-size: 33px;"> <?php echo $resulthm['search_title']; ?> </h1>
						<form class="form-inline" method="POST" action="search" style="padding-bottom: 65px;">
                            <div class="col-md-4 col-sm-4 col-xs-12 nopadding">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search Keyword" name="tagsr">
                                    <i class="icon-magnifying-glass"></i>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 nopadding">
                                <div class="form-group">
                                    <select class="select-category form-control" name="categorysr">
                                        <option value="">&nbsp;</option>
                                        <?php 
											$r2 = mysqli_query($con,"SELECT * FROM `category`");
											while($row2 = mysqli_fetch_array($r2)){
												echo"<option value='".$row2['category']."'>".$row2['category']."</option>";
											}
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 nopadding">
                                <div class="form-group">
                                    <select class="select-location form-control" name="countrysr">
                                        <option label="Select Option"></option>
                                        <?php 
											$r2 = mysqli_query($con,"SELECT * FROM `country`");
											while($row2 = mysqli_fetch_array($r2)){
												echo"<option value='".$row2['id']."'>".$row2['countrynm']."</option>";
											}
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 nopadding">
                                <div class="form-group form-action">
                                    <button type="submit" name="search" class="btn btn-default btn-search-submit"><?php echo $result12['title1']; ?> <i class="fa fa-angle-right"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cat-tabs cat-tab-index-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="cat-title"><?php echo $result12['title2']; ?></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"> 
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
									<li class="active"> <a href="#tab4" data-toggle="tab"><i class="fa fa-map-marker"></i><span class="hidden-xs hidden-sm"><?php echo $result12['title3']; ?></span></a> </li>
									<li> <a href="#tab3" data-toggle="tab"><i class="fa fa-location-arrow"></i><span class="hidden-xs hidden-sm"><?php echo $result12['title4']; ?></span></a> </li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
								<div class="tab-pane active animated fadeInDown" id="tab4">
                                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                        <?php
										$selac=mysqli_query($con,"SELECT * FROM `country` WHERE countrynm='$countryip'");
									    $rowac=mysqli_fetch_array($selac);
										$couid=$rowac['id'];
										$today=date('Y-m-d');
										
									$sel=mysqli_query($con,"SELECT * FROM `post_job` WHERE app_status='1' AND job_paid='1' AND `job_edate` >  '$today' ORDER BY id ASC LIMIT 6");
									while($row=mysqli_fetch_array($sel))
									{
										$job_uid=$row['job_uid'];
										$sela=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_uid' ORDER BY industry ASC");
									    $rowa=mysqli_fetch_array($sela);
										
										$countryid=$row['country'];
										$selacou=mysqli_query($con,"SELECT * FROM `country` WHERE id='$countryid'");
									    $rowacou=mysqli_fetch_array($selacou);
										
										$cityipa=$row['job_location'];
										$selacity=mysqli_query($con,"SELECT * FROM `city` WHERE id='$cityipa'");
									    $rowacity=mysqli_fetch_array($selacity);
										
									?>
                                        <div class="job-box">
                                            <div class="col-md-1 col-sm-1 col-xs-12 nopadding hidden-xs hidden-sm">
                                                <div class="comp-logo"> <img src="upload/<?php echo $rowa['comp_logo']; ?>" class="img-responsive" alt="Company Logo"> </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="job-title-box"> <a href="job_details?id=<?php echo $row['id']; ?>">
                                                    <div class="job-title"> <?php echo $row['job_title']; ?></div>
                                                    </a> <a href="#"><span class="comp-name"><?php echo $rowa['industry']; ?></span></a> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacity['citynm']; ?> </div>
                                            </div>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacou['countrynm']; ?> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-type jt-full-time-color"> <i class="fa fa-clock-o"></i> <?php echo $row['job_type']; ?> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
												if($_SESSION['member_user']=="")
												{ ?>
												<button class="btn btn-primary btn-custom" onclick="window.location.href='register'"><?php echo $result12['title5']; ?></button>
												<?php } else { ?>
                                                <button class="btn btn-primary btn-custom" onclick="window.location.href='job_details?id=<?php echo $row['id']; ?>'"><?php echo $result12['title5']; ?></button>
												<?php } ?>
                                            </div>
                                        </div>
									<?php } ?>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeInDown" id="tab3">
                                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                        <?php
										$selacity=mysqli_query($con,"SELECT * FROM `city` WHERE citynm='$cityip'");
									    $rowacity=mysqli_fetch_array($selacity);
										$cityipa=$rowacity['id'];
										$today=date('Y-m-d');
										
										$sel=mysqli_query($con,"SELECT * FROM `post_job` WHERE app_status='1' AND job_paid='1' AND `job_edate` >  '$today' ORDER BY id ASC LIMIT 6");
										while($row=mysqli_fetch_array($sel))
										{
											
										$job_uid=$row['job_uid'];
										$sela=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$job_uid' ORDER BY industry ASC");
									    $rowa=mysqli_fetch_array($sela);
										
										$countryid=$row['country'];
										$selacou=mysqli_query($con,"SELECT * FROM `country` WHERE id='$countryid'");
									    $rowacou=mysqli_fetch_array($selacou);
									?>
                                        <div class="job-box">
                                            <div class="col-md-1 col-sm-1 col-xs-12 nopadding hidden-xs hidden-sm">
                                                <div class="comp-logo"> <img src="upload/<?php echo $rowa['comp_logo']; ?>" class="img-responsive" alt="scriptsbundle"> </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="job-title-box"> <a href="job_details?id=<?php echo $row['id']; ?>">
                                                    <div class="job-title"> <?php echo $row['job_title']; ?></div>
                                                    </a> <a href="#"><span class="comp-name"><?php echo $rowa['industry']; ?></span></a> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacity['citynm']; ?> </div>
                                            </div>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowacou['countrynm']; ?> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-type jt-full-time-color"> <i class="fa fa-clock-o"></i> <?php echo $row['job_type']; ?> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
												if($_SESSION['member_user']=="")
												{ ?>
												<button class="btn btn-primary btn-custom" onclick="window.location.href='register'"><?php echo $result12['title5']; ?></button>
												<?php } else { ?>
                                                <button class="btn btn-primary btn-custom" onclick="window.location.href='job_details?id=<?php echo $row['id']; ?>'"><?php echo $result12['title5']; ?></button>
												<?php } ?>
                                            </div>
                                        </div>
									<?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="load-more-btn">
										<button class="btn-default" onclick="window.location.href='job_listing'"> <?php echo $result12['title6']; ?> <i class="fa fa-angle-right"></i> </button>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	 <section class="employe-section">
        <div class="container-fluid">
            <div class="row">
			<?php
			$sql1hm = mysqli_query($con,"SELECT * FROM `home_content` WHERE id='1'");
			$resulthm = mysqli_fetch_array($sql1hm);	
			?>
			<div class="col-md-12" style="background-color: #242424;">
                <div class="col-md-6 col-sm-12 col-xs-12 nopadding" >
                    <div class="employe-detail-section">
                        <h2><?php echo $resulthm['home_title']; ?></h2>
                        <p><?php echo $resulthm['homecn']; ?></p>
						<a href="register" class="btn-default btn btn-employe-section"><?php echo $result12['title7']; ?></a>
                    </div>
                </div>
				<style>
				.employe-img-section-left {
					background: rgba(60, 146, 202, 0.7) url(images/<?php echo $resulthm['homeimg']; ?>) no-repeat scroll center center / cover !important;
					height: 450px;
				}
				</style>
                <div class="col-md-6 col-sm-6 col-xs-12 nopadding hidden-sm">
                    <div class="employe-img-section-left"> <!--<img src="images/employee-section1.jpg" alt="" class="img-responsive">--> </div>
                </div>
             </div>
            </div>
        </div>
    </section>
	
	 <section class="cat-tabs cat-tab-index-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="cat-title"><?php echo $result12['title8']; ?></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"> 
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
									<li class="active"> <a href="#tab3" data-toggle="tab"><i class="fa fa-map-marker"></i><span class="hidden-xs hidden-sm"><?php echo $result12['title9']; ?></span></a> </li>
									 <li> <a href="#tab2" data-toggle="tab"><i class="fa fa-location-arrow"></i><span class="hidden-xs hidden-sm"><?php echo $result12['title10']; ?></span></a> </li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
								<div class="tab-pane active tab-pane animated fadeInUp" id="tab3" >
                                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                        <?php
										$selabcountry=mysqli_query($con,"SELECT * FROM `country` WHERE countrynm='$countryip'");
									    $rowabcountry=mysqli_fetch_array($selabcountry);
										$rowabcountryr=$rowabcountry['id'];
										
									$sel=mysqli_query($con,"SELECT * FROM `user` WHERE paid_user_ap='1' AND (country='$rowabcountryr' OR countrya='$rowabcountryr') ORDER BY country ASC LIMIT 6");
									while($row=mysqli_fetch_array($sel))
									{
										$job_uid=$row['id'];
										$sela=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$job_uid'");
									    $rowa=mysqli_fetch_array($sela);
										
										$job_uid=$row['id'];
										$selab=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$job_uid' ORDER BY id DESC");
									    $rowab=mysqli_fetch_array($selab);
										
										$city=$row['city'];
										$selabc=mysqli_query($con,"SELECT * FROM `city` WHERE id='$city'");
									    $rowabc=mysqli_fetch_array($selabc);
										
										$countryus=$row['country'];
										$selabcou=mysqli_query($con,"SELECT * FROM `country` WHERE id='$countryus'");
									    $rowabcou=mysqli_fetch_array($selabcou);
									?>
                                        <div class="job-box">
                                            <div class="col-md-1 col-sm-1 col-xs-12 nopadding hidden-xs hidden-sm">
                                                <div class="comp-logo"> <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive" alt="scriptsbundle"> </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="job-title-box"> <a href="user_resume?id=<?php echo $row['id']; ?>">
                                                    <div class="job-title"> <?php echo $row['fname']." ".$row['lname']; ?></div>
                                                    </a> <a href="#"><span class="comp-name"><?php echo $rowa['exp_pos']; ?></span></a> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowabc['citynm']; ?> </div>
                                            </div>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowabcou['countrynm']; ?> </div>
                                            </div>
                                            <?php
											if($_SESSION['member_user']=="" || $row['rtype']=="Employee")
											{ ?>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-type jt-full-time-color"> <a class="btn btn-primary" href="register"> <?php echo $result12['title11']; ?> </a></div>
                                            </div>
											<?php } else { ?>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-type jt-full-time-color"> <a class="btn btn-primary" target="_blank" href="resume/<?php echo $rowab['resume_nm']; ?>"> <?php echo $result12['title11']; ?> </a></div>
                                            </div>
											<?php } ?>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
												if($_SESSION['member_user']=="")
												{ ?>
												<button class="btn btn-primary btn-custom" onclick="window.location.href='register'"><?php echo $result12['title5']; ?></button>
												<?php } else { ?>
                                                <button class="btn btn-primary btn-custom" onclick="window.location.href='user_resume?id=<?php echo $row['id']; ?>'"><?php echo $result12['title5']; ?></button>
												<?php } ?>
                                            </div>
                                        </div>
									<?php } ?>
                                    </div>
                                </div>
                                <div class="tab-pane tab-pane animated fadeInUp" id="tab2" >
                                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                        <?php
										$selabcity=mysqli_query($con,"SELECT * FROM `city` WHERE citynm='$cityip'");
									    $rowabcity=mysqli_fetch_array($selabcity);
										$cityr=$rowabcity['id'];
										
									$sel=mysqli_query($con,"SELECT * FROM `user` WHERE paid_user_ap='1' AND (city='$cityr' OR citya='$cityr') ORDER BY city ASC LIMIT 6");
									while($row=mysqli_fetch_array($sel))
									{
										$job_uid=$row['id'];
										$sela=mysqli_query($con,"SELECT * FROM `experience` WHERE exp_uid='$job_uid'");
									    $rowa=mysqli_fetch_array($sela);
										
										$job_uid=$row['id'];
										$selab=mysqli_query($con,"SELECT * FROM `resume` WHERE resume_uid='$job_uid' ORDER BY id DESC");
									    $rowab=mysqli_fetch_array($selab);
										
										$city=$row['city'];
										$selabc=mysqli_query($con,"SELECT * FROM `city` WHERE id='$city'");
									    $rowabc=mysqli_fetch_array($selabc);
										
										$countryus=$row['country'];
										$selabcou=mysqli_query($con,"SELECT * FROM `country` WHERE id='$countryus'");
									    $rowabcou=mysqli_fetch_array($selabcou);
									
									?>
                                        <div class="job-box">
                                            <div class="col-md-1 col-sm-1 col-xs-12 nopadding hidden-xs hidden-sm">
                                                <div class="comp-logo"> <img src="upload/<?php echo $row['profile']; ?>" class="img-responsive" alt="scriptsbundle"> </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="job-title-box"> <a href="user_resume?id=<?php echo $row['id']; ?>">
                                                    <div class="job-title"> <?php echo $row['fname']." ".$row['lname']; ?></div>
                                                    </a> <a href="#"><span class="comp-name"><?php echo $rowa['exp_pos']; ?></span></a> </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowabc['citynm']; ?> </div>
                                            </div>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-location"> <i class="fa fa-location-arrow"></i> <?php echo $rowabcou['countrynm']; ?> </div>
                                            </div>
											<?php
											if($_SESSION['member_user']=="" || $row['rtype']=="Employee")
											{ ?>
                                            <div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-type jt-full-time-color"> <a class="btn btn-primary" href="register"> <?php echo $result12['title11']; ?> </a></div>
                                            </div>
											<?php } else { ?>
											<div class="col-md-2 col-sm-2 col-xs-6">
                                                <div class="job-type jt-full-time-color"> <a class="btn btn-primary" target="_blank" href="resume/<?php echo $rowab['resume_nm']; ?>"> <?php echo $result12['title11']; ?> </a></div>
                                            </div>
											<?php } ?>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <?php
												if($_SESSION['member_user']=="")
												{ ?>
												<button class="btn btn-primary btn-custom" onclick="window.location.href='register'"><?php echo $result12['title5']; ?></button>
												<?php } else { ?>
                                                <button class="btn btn-primary btn-custom" onclick="window.location.href='user_resume?id=<?php echo $row['id']; ?>'"><?php echo $result12['title5']; ?></button>
												<?php } ?>
                                            </div>
                                        </div>
									<?php } ?>
                                    </div>
                                </div>
								<?php
								if($_SESSION['member_user']=="")
								{ } else {
								$user_idc=$_SESSION['member_id'];
								$selac=mysqli_query($con,"SELECT * FROM `user` WHERE id='$user_idc'");
								$rowac=mysqli_fetch_array($selac);
								if($rowac['rtype']=='Employer')
								{
     							?>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="load-more-btn">
										<button class="btn-default" onclick="window.location.href='user_listing'"> <?php echo $result12['title6']; ?> <i class="fa fa-angle-right"></i> </button>
									</div>
								</div>
								<?php } else { } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="category-section-3 light-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="Heading-title black">
                            <h1 style="color:white;"><?php echo $result12['title12']; ?></h1>
                        </div>
                    </div>
                    <?php 
					$r1 = mysqli_query($con,"SELECT * FROM `category` WHERE popular='1' AND shown='1' LIMIT 12"); 
					while($row1 = mysqli_fetch_array($r1))
					{
						$job_category=$row1['category'];
						$today=date('Y-m-d');
						$chk = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$job_category' AND `job_edate` >  '$today' AND ad_app='1' ");
						$rowchk = mysqli_num_rows($chk);
						if($rowchk > 0)
						{
					?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="category-section-3-box">
                            <div class="category-section-3-box-inner"> <i class="<?php echo $row1['category_icon']; ?>"></i>
                                <h4> <?php echo $row1['category']; ?> </h4>
                                <span>( <?php 
								$job_category=$row1['category'];
								$today=date('Y-m-d');
								$r12 = mysqli_query($con,"SELECT * FROM `post_job` WHERE job_category='$job_category' AND `job_edate` >  '$today' AND ad_app='1'"); 
					echo mysqli_num_rows($r12); ?> )</span> </div>
                            <div class="category-section-3-box-over-text animated fadeIn">
                                <h4><?php echo $row1['category_content']; ?></h4>
                                <p><a href="job-category?category=<?php echo $row1['category']; ?>"> <?php echo $result12['title13']; ?> </a></p>
                            </div>
                            <div class="icon-bottom">
                            	<i class="icon-browser"></i>
                            </div>
                        </div>
                    </div>
				<?php
					} else {} }?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<div class="load-more-btn">
                        	<button class="btn-default" onclick="window.location.href='all_category'"> <?php echo $result12['title6']; ?> <i class="fa fa-angle-right"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	
   <!-- <section class="featured-jobs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="Heading-title black">
                            <h1>Featured Jobs</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box">
                            <div class="img-box"><img src="images/company/1.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> Graphic Designer </a></h4>
                                    <p> Confidential Int. Pvt. Ltd. Pakistan </p>
                                </div>
                                <div class="feature-post-meta"> <a href="#"> <i class="fa fa-clock-o"></i> 1 days ago</a> <a href="#" class="mata-detail part">Part Time</a> </div>
                                <div class="feature-post-meta-bottom"> <span>$500<small>/ month</small></span> <a href="register" class="apply pull-right" > I'M INTERESTED</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box">
                            <div class="img-box"><img src="images/company/4.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> Software Engineer </a></h4>
                                    <p> Confidential Int. Pvt. Ltd. Pakistan </p>
                                </div>
                                <div class="feature-post-meta"> <a href="#"> <i class="fa fa-clock-o"></i> 5 days ago</a> <a href="#" class="mata-detail remote">Remote</a> </div>
                                <div class="feature-post-meta-bottom"> <span>$900<small>/ month</small></span> <a href="register" class="apply pull-right" > I'M INTERESTED</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box">
                            <div class="img-box"><img src="images/company/3.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> Netword Administrator </a></h4>
                                    <p> Confidential Int. Pvt. Ltd. Pakistan </p>
                                </div>
                                <div class="feature-post-meta"> <a href="#"> <i class="fa fa-clock-o"></i> 2 days ago</a> <a href="#" class="mata-detail full-time">Full Time</a> </div>
                                <div class="feature-post-meta-bottom"> <span>$1500<small>/ month</small></span> <a href="register" class="apply pull-right" > I'M INTERESTED</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box">
                            <div class="img-box"><img src="images/company/2.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> managing director </a></h4>
                                    <p> Kings Int. Pvt. Ltd. Pakistan </p>
                                </div>
                                <div class="feature-post-meta"> <a href="#"> <i class="fa fa-clock-o"></i> 2 days ago</a> <a href="#" class="mata-detail full-time">full Time</a> </div>
                                <div class="feature-post-meta-bottom"> <span>$2500<small>/ month</small></span> <a href="register" class="apply pull-right" > I'M INTERESTED</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box">
                            <div class="img-box"><img src="images/company/5.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> 54/A Ready Flat in Miami Beach </a></h4>
                                    <p> Confidential Int. Pvt. Ltd. Pakistan </p>
                                </div>
                                <div class="feature-post-meta"> <a href="#"> <i class="fa fa-clock-o"></i> 2 days ago</a> <a href="#" class="mata-detail remote">Freelancer</a> </div>
                                <div class="feature-post-meta-bottom"> <span>$500<small>/ month</small></span> <a href="register" class="apply pull-right" > I'M INTERESTED</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-image-box">
                            <div class="img-box"><img src="images/company/3.png" class="img-responsive center-block" alt=""></div>
                            <div class="content-area">
                                <div class="">
                                    <h4><a href="#"> Documentation Expert </a></h4>
                                    <p> XCosdo Int. Pvt. Ltd. Pakistan </p>
                                </div>
                                <div class="feature-post-meta"> <a href="#"> <i class="fa fa-clock-o"></i> 10 days ago</a> <a href="#" class="mata-detail intern">Intern</a> </div>
                                <div class="feature-post-meta-bottom"> <span>$400<small>/ month</small></span> <a href="register" class="apply pull-right" > I'M INTERESTED</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<div class="load-more-btn">
                        	<button class="btn-default"> View All <i class="fa fa-angle-right"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing-section-1 pricing-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="Heading-title black">
                                <h1>Resume Pricing</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Basic Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li class="cut"> Support </li>
                                            <li class="cut"> Access Resume </li>
                                            <li class="cut"> Contact Details </li>
                                            <li class="cut"> Interviews </li>
                                            <li class="cut"> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> Free<small>Always</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Premium Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li> Support </li>
                                            <li> Access Resume </li>
                                            <li class="cut"> Contact Details </li>
                                            <li class="cut"> Interviews </li>
                                            <li class="cut"> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> $29 <small>per month</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Standard Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li> Support </li>
                                            <li> Access Resume </li>
                                            <li> Contact Details </li>
                                            <li> Interviews </li>
                                            <li> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> $59 <small>per month</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 visible-sm">
                            <div class="ui_box">
                                <div class="ui_box__inner">
                                    <h2> Basic Plan </h2>
                                    <div class="features_left">
                                        <ul>
                                            <li> Posting </li>
                                            <li> Searching </li>
                                            <li> Documentation </li>
                                            <li class="cut"> Support </li>
                                            <li class="cut"> Access Resume </li>
                                            <li class="cut"> Contact Details </li>
                                            <li class="cut"> Interviews </li>
                                            <li class="cut"> Test Preprations </li>
                                        </ul>
                                    </div>
                                    <div class="price-rates"> Free<small>Always</small> </div>
                                    <p>Lorem ipsum dolor sit amet. Some more super groovy information.</p>
                                </div>
                                <div class="drop">
                                    <a href="#">
                                        <p>Select Plan</p>
                                    </a>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
		
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
   <?php
	include('footer.php');
   ?>