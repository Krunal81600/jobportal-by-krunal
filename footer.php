<?php
$sql1dec = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='footer1'");
$result1dec = mysqli_fetch_array($sql1dec);
?>




 <div class="fixed-footer">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 col-xs-12">
					<?php
					$select_foot=mysqli_query($con,"SELECT * FROM `footer1` WHERE id='1'");
					$row_foot=mysqli_fetch_array($select_foot);
					?>
                        <div class="footer_block"> <a href="index.html" class="f_logo"><img src="images/<?php echo $row_foot['logo']; ?>" class="img-responsive" alt="logo"></a>
                            <p><?php echo $row_foot['content']; ?></p>
                            <div class="social-bar">
                                <ul>
									<?php
									if($row_foot['twitter']=="")
									{
										
									}
									else
									{
000									?>
                                    <li><a class="fa fa-twitter" href="<?php echo $row_foot['twitter']; ?>"></a></li>
									<?php } ?>
									<?php
									if($row_foot['skype']=="")
									{
										
									}
									else
									{
000									?>
                                    <li><a class="fa fa-skype" href="<?php echo $row_foot['skype']; ?>"></a></li>
									<?php } ?>
									<?php
									if($row_foot['facebook']=="")
									{
										
									}
									else
									{
000									?>
                                    <li><a class="fa fa-facebook" href="<?php echo $row_foot['facebook']; ?>"></a></li>
									<?php } ?>
									<?php
									if($row_foot['messanger']=="")
									{
										
									}
									else
									{
000									?>
                                    <li><a class="fa fa-instagram" href="<?php echo $row_foot['messanger']; ?>"></a></li>
									<?php } ?>
									<?php
									if($row_foot['indeed']=="")
									{
										
									}
									else
									{
000									?>
                                    <li><a class="fa fa-linkedin" href="<?php echo $row_foot['indeed']; ?>"></a></li>
									<?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2 col-xs-12">
                        <div class="footer_block">
                            <h4><?php echo $result1dec['title1']; ?></h4>
                            <ul class="footer-links">
							<?php
								$select_menu=mysqli_query($con,"SELECT * FROM `footermenu`");
								while($row_menu=mysqli_fetch_array($select_menu))
								{
							?>
                                <li><a href="<?php echo $row_menu['url']; ?>"><?php echo $row_menu['menu']; ?></a> </li>
							<?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xs-12">
                        <div class="footer_block dark_gry">
                            <h4><?php echo $result1dec['title2']; ?></h4>
                            <ul class="recentpost">
							<?php
								$select_blog=mysqli_query($con,"SELECT * FROM `blog` WHERE blog_status='1' LIMIT 3");
								while($row_blog=mysqli_fetch_array($select_blog))
								{
							?>
                                <li> <span><a class="plus" href="blog_view?id=<?php echo $row_blog['id']; ?>"><img src="images/<?php echo $row_blog['blog_img']; ?>" alt="" /><i>+</i></a></span>
                                    <p><a href="blog_view?id=<?php echo $row_blog['id']; ?>"><?php echo $row_blog['blog_title']; ?></a></p>
                                    <h3><?php echo $row_blog['blog_date']; ?></h3>
                                </li>
								<?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12">
                        <div class="footer_block">
                            <h4><?php echo $result1dec['title3']; ?></h4>
                            <ul class="personal-info">
								<?php
								$select_info=mysqli_query($con,"SELECT * FROM `contect-info` WHERE id='1'");
								$row_info=mysqli_fetch_array($select_info);
								?>
                                <li><i class="fa fa-map-marker"></i> <?php echo $row_info['address1']; ?></li>
								<li><i class="fa fa-map-marker"></i> <?php echo $row_info['address2']; ?></li>
                                <li><i class="fa fa-envelope"></i> <?php echo $row_info['mail1']; ?></li>
                                <li><i class="fa fa-phone"></i>  <?php echo $row_info['phone1']; ?> </li>
                                <li><i class="fa fa-whatsapp"></i>  <?php echo $row_info['phone2']; ?> </li>
                                <li><i class="fa fa-clock-o"></i> <?php echo $row_info['time']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <section class="footer-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-bottom">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p><?php echo $result1dec['title4']; ?> </p>
                                   
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm">
                                    <ul class="footer-menu">
                                        <li> <a href="by_country?section=africa"><?php echo $result1dec['title5']; ?> </a> </li>
                                        <li> <a href="by_country?section=us"><?php echo $result1dec['title6']; ?> </a> </li>
                                        <li> <a href="by_country?section=asia"><?php echo $result1dec['title7']; ?> </a> </li>
                                        <li> <a href="by_country?section=europe"><?php echo $result1dec['title8']; ?> </a> </li>
                                        <li> <a href="by_country?section=canada"><?php echo $result1dec['title9']; ?> </a> </li>
                                        <li> <a href="by_country?section=oceania"><?php echo $result1dec['title10']; ?></a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>

    <!-- JAVASCRIPT JS  --> 
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    
    <!-- JAVASCRIPT JS  --> 
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script> 
 
    <!-- BOOTSTRAP CORE JS --> 
    <script type="text/javascript" src="js/bootstrap.min.js"></script> 
    
    <!-- JQUERY SELECT --> 
    <script type="text/javascript" src="js/select2.min.js"></script> 
    
    <!-- MEGA MENU --> 
    <script type="text/javascript" src="js/mega_menu.min.js"></script> 
    
      
    
    <!-- JQUERY COUNTERUP --> 
    <script type="text/javascript" src="js/counterup.js"></script> 
    
    <!-- JQUERY WAYPOINT --> 
    <script type="text/javascript" src="js/waypoints.min.js"></script> 
    
    <!-- JQUERY REVEAL --> 
    <script type="text/javascript" src="js/footer-reveal.min.js"></script> 
    
    <!-- Owl Carousel --> 
    <script type="text/javascript" src="js/owl-carousel.js"></script> 
    
    <!-- CORE JS --> 
    <!-- FOR THIS PAGE ONLY -->
	<script type="text/javascript" src="js/jquery.tagsinput.min.js"></script>
	<script type="text/javascript">
		$(".questions-category").select2({
			placeholder: "Select Post Category",
			allowClear: true,
			maximumSelectionLength: 3,
			/*width: "50%",*/
		});
		$('#tags').tagsInput({
			width: 'auto'
		});
	</script>
    <script>
    	$(document).ready(function(e){
			$('.search-panel .dropdown-menu').find('a').click(function(e) {
				e.preventDefault();
				var param = $(this).attr("href").replace("#","");
				var concept = $(this).text();
				$('.search-panel span#search_concept').text(concept);
				$('.input-group #search_param').val(param);
			});
			$(window).scroll(function() {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > 300) {
					$(".mega-menu").addClass("navbar-fixed-top");
		
				} else if (scrollTop < 300) {
					$(".mega-menu").removeClass("navbar-fixed-top");
				}
			});
		});
    </script>
	 <script type="text/javascript" src="js/jquery.tagsinput.min.js"></script>
        <script type="text/javascript">
            $(".questions-category").select2({
                placeholder: "Select Post Category",
                allowClear: true,
                maximumSelectionLength: 3,
                /*width: "50%",*/
            });
            $('#tags').tagsInput({
                width: 'auto'
            });
        </script>
        <script src="http://cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
        <script type="text/javascript">
            CKEDITOR.replace('ckeditor');
			CKEDITOR.replace('ckeditor-experience');
			
        </script>
        <!-- WIZARD -->
        <script src="js/jquery-wizard.min.js" type="text/javascript"></script>
        <script>
            $('#exampleBasic').wizard({
                onFinish: function() {
                    //alert('finish');
                }
            });
        </script>
		<script type="text/javascript" src="js/custom.js"></script>
</div>
</body>

</html>