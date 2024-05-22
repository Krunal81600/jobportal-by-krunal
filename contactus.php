 <?php include('header.php'); 
 
 $sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='contactus'");
$result12 = mysqli_fetch_array($sql12);
 ?>

        <section class="contact-us ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                           <!--  <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="Heading-title-left black small-heading">
                                    <h3><?php echo $result12['title1']; ?></h3>
                                </div>
                                <form class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title2']; ?> <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title3']; ?> <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title4']; ?> <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title5']; ?> <span class="required">*</span></label>
                                            <input placeholder="" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $result12['title6']; ?> <span class="required">*</span></label>
                                            <textarea cols="6" rows="8" placeholder="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <a href="#" class="btn btn-default"> <?php echo $result12['title7']; ?> <i class="fa fa-angle-right"></i> </a>
                                    </div>
                                </form>
                            </div> -->

                            
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="Heading-title-left black small-heading">
                                    <h3><?php echo $result12['title8']; ?></h3>
                                </div>
								<?php
								$select_info=mysqli_query($con,"SELECT * FROM `contect-info` WHERE id='1'");
								$row_info=mysqli_fetch_array($select_info);
								?>
                                <div class="contact_block-2">
                                    <div class="content-block-box">
                                        <div class="icon-box">
                                            <i class="icon-map-pin"></i>
                                        </div>
                                        <div class="detail-box">
                                            <p><?php echo $row_info['address1']; ?>,</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="contact_block-2">
                                    <div class="content-block-box">
                                        <div class="icon-box">
                                            <i class=" icon-phone"></i>
                                        </div>
                                        <div class="detail-box">
                                            <p><b class="pull-left"><?php echo $result12['title9']; ?></b><a href="tel:229 97-69-23-56" class="pull-right"> <?php echo $row_info['phone1']; ?></a></p>
                                            <p><b class="pull-left"><?php echo $result12['title10']; ?></b><a href="tel:+229 96-84-46-84" class="pull-right"><?php echo $row_info['phone2']; ?></a></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="contact_block-2">
                                    <div class="content-block-box">
                                        <div class="icon-box">
                                            <i class="icon-envelope"></i>
                                        </div>
                                        <div class="detail-box">
                                            <p><a href="mailto:information@africaglobalnetwork.com"><?php echo $row_info['mail1']; ?></a></p>
                                        </div>
                                    </div>

                                </div>
								<?php
								$select_foot=mysqli_query($con,"SELECT * FROM `footer1` WHERE id='1'");
								$row_foot=mysqli_fetch_array($select_foot);
								?>
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="<?php echo $row_foot['facebook']; ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $row_foot['twitter']; ?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="<?php echo $row_foot['googleplus']; ?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="<?php echo $row_foot['indeed']; ?>" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <div id="map-contact"></div> -->
 <?php include('footer.php'); ?>