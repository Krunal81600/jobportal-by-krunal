<?php
	include('header.php');
?>


        <section class="login-page light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="login-container">
                            <div class="loginbox">
                                <div class="loginbox-title">Sign Up using social accounts</div>
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                                <div class="loginbox-or">
                                    <div class="or-line"></div>
                                    <div class="or">OR</div>
                                </div>
                                <div class="form-group">
                                    <label>Username: <span class="required">*</span></label>
                                    <input placeholder="" class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Email: <span class="required">*</span></label>
                                    <input placeholder="" class="form-control" type="email">
                                </div>
                                <div class="form-group">
                                    <label>Password: <span class="required">*</span></label>
                                    <input placeholder="" class="form-control" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password: <span class="required">*</span></label>
                                    <input placeholder="" class="form-control" type="password">
                                </div>
                                <div class="loginbox-forgot">
                                    <input type="checkbox"> I accept <a href="#">Term and consitions?</a>
                                </div>
                                <div class="loginbox-submit">
                                    <input type="button" class="btn btn-default btn-block" value="Register">
                                </div>
                                <div class="loginbox-signup"> Already have account <a href="login.php">Sign in</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

	<div class="fixed-footer">
		 <section class="footer-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-bottom">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p>Copyright &copy;2017  - Africa Global Network - All rights Reserved. </p>
                                   
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm">
                                    <ul class="footer-menu">
                                        <li> <a href="#">Jobs in australia</a> </li>
                                        <li> <a href="#">Jobs in malaysia</a> </li>
                                        <li> <a href="#">Jobs in england</a> </li>
                                        <li> <a href="#">Jobs in saudi arabia</a> </li>
                                        <li> <a href="#">Jobs in south africa</a> </li>
                                        <li> <a href="#">Jobs in saudi Pakistan</a> </li>
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
    <script type="text/javascript" src="js/custom.js"></script>
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
</div>
</body>

<!-- Mirrored from templates.scriptsbundle.com/opportunities-v3/demo/index8.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Aug 2017 05:14:53 GMT -->
</html>