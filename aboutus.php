<?php include('header.php'); 
$sql1 = mysqli_query($con,"SELECT * FROM `aboutus` WHERE id='1'");
$result1 = mysqli_fetch_array($sql1);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='about'");
$result12 = mysqli_fetch_array($sql12);
?>

        <section class="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="Heading-title black ">
                                <h1><?php echo $result12['title1']; ?></h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p><?php echo $result1['about']; ?></p>
                            <blockquote><?php echo $result1['abouta']; ?></blockquote>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading tab-collapsed" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                    <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                       <?php echo $result12['title2']; ?>
                                        <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                    </a>
                                  </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                                        <div class="panel-body">
                                            <div class="panel-body-icon"><i class="fa fa-magic"></i></div>
                                            <?php echo $result1['whoweare']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                        <a class="collapse-controle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <?php echo $result12['title3']; ?>
                                            <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                        </a>
                                    </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                                        <div class="panel-body">
                                            <div class="panel-body-icon"><i class="fa fa-crop"></i></div>
                                            <?php echo $result1['whatwedo']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                    <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                       <?php echo $result12['title4']; ?>
                                        <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                    </a>
                                  </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                                        <div class="panel-body">
                                            <div class="panel-body-icon"><i class="fa fa-cogs"></i></div>
                                            <?php echo $result1['ourmission']; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="testimonials-section light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="Heading-title black">
                            <h1 style="color:white;"><?php echo $result12['title5']; ?></h1>
                        </div>
                    </div>
                    <div class="owl-testimonial-2">
					<?php
					$r2t = mysqli_query($con,"SELECT * FROM `testimonial`");
					while($row2t = mysqli_fetch_array($r2t))
					{
					?>
                        <div class="single_testimonial">
                            <h4><?php echo $row2t['testi_title']; ?></h4>
                            <p><?php echo $row2t['testi_content']; ?></p>
                            <img src="images/users/<?php echo $row2t['testi_img']; ?>" alt="">
                            <h3 class=""><?php echo $row2t['testi_user']; ?></h3>
                            <p class=""><?php echo $row2t['testi_location']; ?></p>
                        </div>
					<?php } ?>
                    </div>
                </div>
            </div>
        </section>
		
		<?php 
		$r2s = mysqli_query($con,"SELECT * FROM `setting` WHERE id='1'");
		$row2s = mysqli_fetch_array($r2s);
		if($row2s['team']==1)
		{
		?>
        <section class="team">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="Heading-title black">
                            <h1><?php echo $result12['title6']; ?></h1>
                        </div>
                    </div>
					<?php
					$r2 = mysqli_query($con,"SELECT * FROM `team`");
					while($row2 = mysqli_fetch_array($r2))
					{
					?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="team-member">
                            <div class="team-img col-pic1"> <img src="images/team/<?php echo $row2['team_img']; ?>" alt="team member" class="img-responsive">
                                <div class="team-intro light-txt">
                                    <h5><?php echo $row2['team_nm']; ?></h5>
                                    <span><?php echo $row2['position']; ?></span> </div>
                            </div>
                            <div class="team-hover">
                                <div class="desk">
                                    <h4><?php echo $row2['team_tite']; ?></h4>
                                    <p><?php echo $row2['content']; ?></p>
                                </div>
                                <div class="s-link"> <a href="<?php echo $row2['facebook']; ?>"><i class="fa fa-facebook"></i></a> <a href="<?php echo $row2['twitter']; ?>"><i class="fa fa-twitter"></i></a> <a href="<?php echo $row2['googleplus']; ?>"><i class="fa fa-google-plus"></i></a> </div>
                            </div>
                        </div>
                    </div>
					<?php } ?>
                </div>
            </div>
        </section>
		<?php } else {} ?>
	<?php include('footer.php'); ?>