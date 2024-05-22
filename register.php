<?php include('header1.php'); 

if(isset($_POST['submit']))
{
    $user=$_POST['user'];
    $email=$_POST['email'];
    $mdpassword=md5($_POST['password']);
    $password2=$_POST['password2'];
    $password=$_POST['password'];
    $city=$_POST['city'];
    $citya=$_POST['citya'];
    $country=$_POST['country'];
    $countrya=$_POST['countrya'];
    $phone=$_POST['phone'];
    $rtype=$_POST['rtype'];
    $jct=date("Y-m-d h:i:sa");
    if($password == $password2)
	{
        $sel=mysqli_query($con,"SELECT COUNT(*) FROM `user` WHERE user='$user'");
        $row=mysqli_fetch_row($sel);
        $nr = $row[0];
        if($nr==1)
        {
            ?>
            <script>
                alert("Nom d'utilisateur déjà enregistré");
            </script>
            <?php
        }
        else
        {
            $select=mysqli_query($con,"SELECT COUNT(*) FROM `user` WHERE email='$email'");
            $rew=mysqli_fetch_row($select);
            $nra = $rew[0];
            if($nra==1)
            {
                ?>
                <script>
                alert("Email Déjà enregistré ");
                </script>
                <?php
            }
            else
            {
				if($rtype=="Employer")
				{
                mysqli_query($con,"INSERT INTO `user`(`user`,`email`,`password`,`phone`,`rtype`,`country`,`city`,`jct`) VALUES ('$user','$email','$mdpassword','$phone','$rtype','$country','$city','$jct')");	
				
				$last_id = mysqli_insert_id($con);
				
				$query=mysqli_query($con,"insert into company(`comp_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into social(`social_uid`) values('$last_id')");
				}
				else
				{
				mysqli_query($con,"INSERT INTO `user`(`user`,`email`,`password`,`phone`,`rtype`,`country`,`city`,`countrya`,`citya`,`jct`) VALUES ('$user','$email','$mdpassword','$phone','$rtype','$country','$city','$countrya','$citya','$jct')");
				
				$last_id = mysqli_insert_id($con);
				
				$query=mysqli_query($con,"insert into education(`edu_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into experience(`exp_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into skill(`skill_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into social(`social_uid`) values('$last_id')");
				}
				
                $notify="Registered";
                $type="user";
                $link="view?id=$last_id";
				$jct=date('Y-m-d H:i:s');
				
                $query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$last_id','$notify','$type','$link','$jct')");
                

                $_SESSION['member_id']=$last_id;
                $_SESSION['member_email'] = $email;
                $_SESSION['member_user'] = $user;
				
				$msg="S'enregistrer avec succès...";
				if(isset($_SESSION['url']))
				{
					?>
					<script>
						setTimeout(function () { window.location.href= '<?php echo $_SESSION['url']; ?>'; },5000);
					</script>
					<?php
				}
				else
				{
					if($rtype=="Employee")
					{
					?>
					<script>
						setTimeout(function () { window.location.href= 'user-edit-profile'; },5000);
					</script>
					<?php
					}
					else
					{
					?>
					<script>
						setTimeout(function () { window.location.href= 'edit-profile-company'; },5000);
					</script>
					<?php
					}
				}
               
            }
        }
	}
	else
	{
		?>
		<script>
			alert("Mot de passe ne correspond pas");
		</script>
		<?php
	}
}

$sql12 = mysqli_query($con,"SELECT * FROM `all_title` WHERE page_nm='register'");
$result12 = mysqli_fetch_array($sql12);
?>
	
<div class="page">
	 <section class="login-page light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="login-container">
                            <div class="loginbox">
							<form method="POST" enctype="multipart/form-data">
                                <div class="loginbox-title"><?php echo $result12['title1']; ?></div>
                                <p style="color:#fff;"><?php echo $result12['title2']; ?></p>
								<?php
								if(isset($_POST['submit']) && $msg!="")
								{
								?>
								<div role="alert" class="alert alert-success alert-dismissible">
									<strong><?php echo $msg; ?></strong> 
								</div>
								<?php } else {} ?>
                                <div class="form-group">
                                    <label><?php echo $result12['title3']; ?>: <span class="required">*</span></label>
                                    <select name="rtype" onchange='CheckColors(this.value);' class="form-control emp" required>
                                       <option value="">-----<?php echo $result12['title4']; ?>-----</option>
                                       <option value="Employee" <?php if($_POST['rtype']=="Employee") echo 'selected="selected"' ; ?>><?php echo $result12['title5']; ?></option>
                                       <option value="Employer" <?php if($_POST['rtype']=="Employer") echo 'selected="selected"' ; ?>><?php echo $result12['title6']; ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $result12['title7']; ?>: <span class="required">*</span></label>
                                    <input placeholder="<?php echo $result12['title7']; ?>" name="user" pattern=".{4,}" title="Mininum 4 lettre et numéro permettent" value="<?php echo $_POST['user']; ?>" onkeyup="checkname();" class="form-control" id="UserName" type="text" required>
									<p id="name_status" style="text-align:left;color:red;"></p>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $result12['title8']; ?>: <span class="required">*</span></label>
                                    <input placeholder="<?php echo $result12['title8']; ?>" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="UserEmail" value="<?php echo $_POST['email']; ?>" onkeyup="checkemail();" class="form-control" type="email" required>
									<p id="email_status" style="text-align:left;color:red;"></p>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $result12['title9']; ?>: <span class="required">*</span></label>
                                    <input placeholder="<?php echo $result12['title9']; ?>" pattern=".{6,}" title="Six caractères ou plus" id="txtNewPassword" name="password" class="form-control" type="password" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $result12['title10']; ?>: <span class="required">*</span></label>
                                    <input placeholder="<?php echo $result12['title10']; ?>" id="txtConfirmPassword" onkeyup="checkPasswordMatch();" name="password2" class="form-control" type="password" required>
									<p id="divCheckPasswordMatch" style="text-align:left;color:red;"></p>
                                </div>
								<div class="form-group">
                                    <label><?php echo $result12['title11']; ?>: <span class="required">*</span></label>
                                    <input placeholder="<?php echo $result12['title11']; ?>" name="phone" value="<?php echo $_POST['phone']; ?>" class="form-control" type="text" required>
                                </div>
									<div class="form-group" id="rtype" style='display:none;'>
                                    <label><?php echo $result12['title12']; ?>: <span>*</span></label>
                                    <select id="countrya" name="countrya" class="form-control">
                                       <option value="">-----<?php echo $result12['title13']; ?>-----</option>
									   <?php
									   $cou=mysqli_query($con,"SELECT * FROM `country` ORDER BY countrynm ASC");
									   while($rowcou=mysqli_fetch_array($cou))
									   {
									   ?>
                                       <option value="<?php echo $rowcou['id'] ?>" <?php if($rowcou['countrynm']==$_POST['country']) echo 'selected="selected"' ; ?>><?php echo $rowcou['countrynm'] ?></option>
                                       <?php }  ?>
                                    </select>
                                </div>
								<div class="form-group" id="rtypea" style='display:none;'>
                                    <label><?php echo $result12['title14']; ?>: <span>*</span></label>
                                    <select name="citya" id="citya" class="form-control">
									<option value="">-----<?php echo $result12['title15']; ?>-----</option>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label id="rtypeb" style='display:block;'><?php echo $result12['title16']; ?>: <span class="required">*</span></label>
                                    <label id="rtypec" style='display:none;'><?php echo $result12['title17']; ?>: <span class="required">*</span></label>
                                    <select id="country" name="country" class="form-control country">
                                       <option value="">-----<?php echo $result12['title18']; ?>-----</option>
									   <?php
									  /* $cou=mysqli_query($con,"SELECT * FROM `country` ORDER BY countrynm ASC");
									   while($rowcou=mysqli_fetch_array($cou))
									   {
									   ?>
                                       <option value="<?php echo $rowcou['id'] ?>" <?php if($rowcou['countrynm']==$_POST['country']) echo 'selected="selected"' ; ?>><?php echo $rowcou['countrynm'] ?></option>
                                       <?php } */ ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label id="rtyped" style='display:block;'><?php echo $result12['title19']; ?>: <span class="required">*</span></label>
                                    <label id="rtypee" style='display:none;'><?php echo $result12['title19']; ?>: <span class="required">*</span></label>
                                    <select name="city" id="city" class="form-control" required>
									<option value="">-----<?php echo $result12['title20']; ?>-----</option>
                                    </select>
                                </div>
							
                                <div class="loginbox-forgot">
                                    <input type="checkbox"> <?php echo $result12['title21']; ?> <a href="terms_condition" style="color:#fff;" required> <?php echo $result12['title22']; ?></a>
                                </div>
                                <div class="loginbox-submit">
                                    <input type="submit" name="submit" class="btn btn-default" value="Register">
                                </div>
                                <div class="loginbox-signup"> <?php echo $result12['title23']; ?> <a href="login"style="color:#fff;"> <?php echo $result12['title24']; ?></a> </div>
							</form>
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
			<div class="client-logo"> <a href="<?php echo $row2['brand_link']; ?>" target="_blank"><img src="images/clients/<?php echo $row2['brand_img']; ?>" class="img-responsive" alt="Brand Image" /></a> </div>
			<?php } ?>
		</div>
	</div>
	
 </div>
 </div>
 </section>
 <?php
	include('footer1.php');
?>
 
<script type="text/javascript">
	function checkPasswordMatch() {
		var password = $("#txtNewPassword").val();
		var confirmPassword = $("#txtConfirmPassword").val();

		if (password != confirmPassword)
			$("#divCheckPasswordMatch").html("Passwords do not match!");
		else
			$("#divCheckPasswordMatch").html("Passwords matched");
	}
</script>
<script type="text/javascript">
	function checkname()
	{
		var name=document.getElementById( "UserName" ).value;

		if(name)
		{
			$.ajax({
				type: 'post',
				url: 'checkdata.php',
				data: {
					user_name:name,
				},
				success: function (response) {
					$( '#name_status' ).html(response);
					if(response=="OK")
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			});
		}
		else
		{
			$( '#name_status' ).html("");
			return false;
		}
	}

	function checkemail()
	{
		var email=document.getElementById( "UserEmail" ).value;

		if(email)
		{
			$.ajax({
				type: 'post',
				url: 'checkdata.php',
				data: {
					user_email:email,
				},
				success: function (response) {
					$( '#email_status' ).html(response);
					if(response=="OK")
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			});
		}
		else
		{
			$( '#email_status' ).html("");
			return false;
		}
	}

	function checkall()
	{
		var namehtml=document.getElementById("name_status").innerHTML;
		var emailhtml=document.getElementById("email_status").innerHTML;

		if((namehtml && emailhtml)=="OK")
		{
			return true;
		}
		else
		{
			return false;
		}
	}

</script>
<script src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">-----Choose Country First-----</option>');
        }
    });
    
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#countrya').on('change',function(){
        var countryIDa = $(this).val();
        if(countryIDa){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_ida='+countryIDa,
                success:function(html){
                    $('#citya').html(html);
                }
            }); 
        }else{
            $('#citya').html('<option value="">-----Choose Country First-----</option>');
        }
    });
    
});
</script>
<script type="text/javascript">
   $(document).ready(function(){
			$('.emp').on('change',function(){
				var countryid = $(this).val();
				if(countryid){
					$.ajax({
						type:'POST',
						url:'fetchcountry.php',
						data:'empId='+countryid,
						success:function(html){
							$('.country').html(html);
						}
					});
				}else{
					$('.country').html('<option value="">Select State first</option>');
				}
			});
		});
	</script>
<script type="text/javascript">
function CheckColors(val){
 var element=document.getElementById('rtype');
 if(val=='Employee')
   element.style.display='block';
 else  
   element.style.display='none';

	var elementa=document.getElementById('rtypea');
 if(val=='Employee')
   elementa.style.display='block';
 else  
   elementa.style.display='none';

var elementb=document.getElementById('rtypeb');
 if(val=='Employee')
   elementb.style.display='none';
 else  
   elementb.style.display='block';

var elementc=document.getElementById('rtypec');
 if(val=='Employee')
   elementc.style.display='block';
 else  
   elementc.style.display='none';

var elementd=document.getElementById('rtyped');
 if(val=='Employee')
   elementd.style.display='none';
 else  
   elementd.style.display='block';

var elemente=document.getElementById('rtypee');
 if(val=='Employee')
   elemente.style.display='block';
 else  
   elemente.style.display='none';
}
</script>
