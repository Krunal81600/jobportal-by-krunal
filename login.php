<?php
	include('header.php');
	
if(isset($_POST['Login']))
{

$email=$_POST['email'];
$password=$_POST['password'];

$select=mysqli_query($con,"SELECT * FROM `user` where (email='".$email."' OR phone='".$email."') AND  password='".md5($password)."'");
$rew=mysqli_num_rows($select);
$row=mysqli_fetch_array($select);
$idu=$row['id'];

if($row['ac_dac']=="deactive")
{
	?>
<script>
	alert("Your Account has been deactivated by Admin, please contact the Admin to get your account activated. Thanks.");
</script>
   
<?php
	echo "<script type='text/javascript'>";
	echo "window.location='register'";
	echo "</script>";

}
else
{
	if($rew>0)
	{
		if($row['rtype']=="Employer")
		{
			if($row['cactive']==1)
			{
				$_SESSION['member_id']=$row['id'];
				$_SESSION['member_email'] = $row['email'];
				$_SESSION['member_user'] = $row['user'];
				
				$id=$row['id'];
				mysqli_query($con,"UPDATE `user` SET `online`='1' WHERE id='$id'");
				
				echo "<script type='text/javascript'>";
				echo "window.location='edit-profile-company'";
				echo "</script>";
				
			}
			else
			{
			?>
			<script>
				alert("Please Wait For Admin Approve..");
			</script>
			<?php
			}
		}
		else
		{
			$_SESSION['member_id']=$row['id'];
			$_SESSION['member_email'] = $row['email'];
			$_SESSION['member_user'] = $row['user'];
			
			$id=$row['id'];
			mysqli_query($con,"UPDATE `user` SET `online`='1' WHERE id='$id'");
			
			echo "<script type='text/javascript'>";
			echo "window.location='user-edit-profile'";
			echo "</script>";
		}
	}
	else
	{
		?>
	<script>
		alert("Your email or password is Wrong.");
	</script>
	<?php
	}
}
}

require_once 'fbConfig.php';
require_once 'User.php';

$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='login'");
$result12 = mysqli_fetch_array($sql12);
?>

        <section class="login-page light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="login-container">
                            <div class="loginbox">
							<form method="POST">
                                <div class="loginbox-title"><?php echo $result12['title1']; ?></div>
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="<?php echo htmlspecialchars($loginURL); ?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?php echo $authUrl; ?>" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                                <div class="loginbox-or">
                                    <div class="or-line"></div>
                                    <div class="or"><?php echo $result12['title2']; ?></div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $result12['title3']; ?>: <span class="required">*</span></label>
                                    <input placeholder="" class="form-control" type="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label><?php echo $result12['title4']; ?>: <span class="required">*</span></label>
                                    <input placeholder="" class="form-control" type="password" name="password">
                                </div>
                                <div class="loginbox-forgot">
                                    <a href="#"><?php echo $result12['title5']; ?></a>
                                </div>
                                <div class="loginbox-submit">
                                    <input type="submit" class="btn btn-default btn-block" value="Login" name="Login">
                                </div>
                                <div class="loginbox-signup">
                                    <a href="register"><?php echo $result12['title6']; ?></a>
                                </div>
							</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<div class="brand-logo-area clients-bg">
			<div class="clients-list">
				<?php
				$r2 = mysqli_query($con,"SELECT * FROM `brand`");
				while($row2 = mysqli_fetch_array($r2))
				{
				?>
				<div class="client-logo"> <a href="#"><img src="images/clients/<?php echo $row2['brand_img']; ?>" class="img-responsive" alt="Brand Image" /></a> </div>
				<?php } ?>
			</div>
		</div>
		<div class="fixed-footer">
		 <section class="footer-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-bottom">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p><?php echo $result12['title7']; ?></p>
                                   
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm">
                                    <ul class="footer-menu">
                                        <li> <a href="by_country?section=africa"><?php echo $result12['title8']; ?></a> </li>
                                        <li> <a href="by_country?section=us"><?php echo $result12['title9']; ?></a> </li>
                                        <li> <a href="by_country?section=asia"><?php echo $result12['title10']; ?> </a> </li>
                                        <li> <a href="by_country?section=europe"><?php echo $result12['title11']; ?> </a> </li>
                                        <li> <a href="by_country?section=canada"><?php echo $result12['title12']; ?></a> </li>
                                        <li> <a href="by_country?section=oceania"><?php echo $result12['title13']; ?></a> </li>
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

</html>