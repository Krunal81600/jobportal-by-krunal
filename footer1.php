 <?php
$sql1dec = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='footer1'");
$result1dec = mysqli_fetch_array($sql1dec);
?>
 <div class="fixed-footer" style=" position: relative !important;">
       
        <section class="footer-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-bottom">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="color:#fff;"><?php echo $result1dec['title4']; ?> </p>
                                   
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
		<script type="text/javascript">
		$(".country_list").select2({
			placeholder: "Select Country",
			allowClear: false,
			maximumSelectionLength: 3,
			/*width: "50%",*/
		});
		$('#tags').tagsInput({
			width: 'auto'
		});
	</script> 	
		<script src="js/ckeditor.js"></script>
        <script type="text/javascript">
            CKEDITOR.replace('ckeditor.html');
        </script>
        <!-- WIZARD -->
        <script src="js/jquery-wizard.min.js" type="text/javascript"></script>
        <script>
            $('#exampleBasic').wizard({
                onFinish: function() {
                    alert('finish');
                }
            });
        </script>
</div>
</body>

</html> 