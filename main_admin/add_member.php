<?php include('header.php'); 

if(isset($_POST['submit']))
{
    $user=$_POST['user'];
    $email=$_POST['email'];
    $mdpassword=md5($_POST['password']);
    $password2=$_POST['password2'];
    $password=$_POST['password'];
    $city=$_POST['city'];
    $country=$_POST['country'];
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
                alert("Username Already Registered");
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
                    alert("EmailId Already Registered");
                </script>
                <?php
            }
            else
            {
				if($rtype=="Employee")
				{
                $r=mysqli_query($con,"INSERT INTO `user`(`user`,`email`,`password`,`phone`,`rtype`,`country`,`city`,`jct`) VALUES ('$user','$email','$mdpassword','$phone','$rtype','$country','$city','$jct')");
				
				$last_id = mysqli_insert_id($con);
				
				$query=mysqli_query($con,"insert into education(`edu_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into experience(`exp_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into skill(`skill_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into social(`social_uid`) values('$last_id')");
				}
				else
				{
				mysqli_query($con,"INSERT INTO `user`(`user`,`email`,`password`,`phone`,`rtype`,`country`,`city`,`jct`) VALUES ('$user','$email','$mdpassword','$phone','$rtype','$country','$city','$jct')");	
				
				$last_id = mysqli_insert_id($con);
				
				$query=mysqli_query($con,"insert into company(`comp_uid`) values('$last_id')");
				
				$query=mysqli_query($con,"insert into social(`social_uid`) values('$last_id')");
				}
				
                $notify="Registered";
                $type="user";
                $link="view?id=$last_id";

                $query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$last_id','$notify','$type','$link')");
                

                $_SESSION['member_id']=$last_id;
                $_SESSION['member_email'] = $email;
                $_SESSION['member_user'] = $user;
				
				if($r){ echo'<script type="text/javascript">alert("Successfully Inserted..")</script>'; }
               
            }
        }
	}
	else
	{
		?>
		<script>
			alert("Password Not Match");
		</script>
		<?php
	}
}
?>
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Add Post <strong>Info</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Add Post</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Add Post</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <form method="POST" enctype="multipart/form-data">
							<div class="loginbox-title">Exceed your potential... come join us!</div>
							<p style="color:#fff;">Get started - it's free.</p>
							<?php
							if(isset($_POST['submit']) && $msg!="")
							{
							?>
							<div role="alert" class="alert alert-success alert-dismissible">
								<strong><?php echo $msg; ?></strong> 
							</div>
							<?php } else {} ?>
							<div class="form-group">
								<label>Select Role: <span class="required">*</span></label>
								<select name="rtype" class="form-control emp" required>
								   <option value="">-----Choose Role-----</option>
								   <option value="Employee" <?php if($_POST['rtype']=="Employee") echo 'selected="selected"' ; ?>>Employee</option>
								   <option value="Employer" <?php if($_POST['rtype']=="Employer") echo 'selected="selected"' ; ?>>Employer</option>
								</select>
							</div>
							<div class="form-group">
								<label>Username: <span class="required">*</span></label>
								<input placeholder="User Name" name="user" pattern=".{4,}" title="Mininum 4 letter and number alow" value="<?php echo $_POST['user']; ?>" onkeyup="checkname();" class="form-control" id="UserName" type="text" required>
								<p id="name_status" style="text-align:left;color:red;"></p>
							</div>
							<div class="form-group">
								<label>Email: <span class="required">*</span></label>
								<input placeholder="Email Id" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="UserEmail" value="<?php echo $_POST['email']; ?>" onkeyup="checkemail();" class="form-control" type="email" required>
								<p id="email_status" style="text-align:left;color:red;"></p>
							</div>
							<div class="form-group">
								<label>Password: <span class="required">*</span></label>
								<input placeholder="Password" pattern=".{6,}" title="Six or more characters" id="txtNewPassword" name="password" class="form-control" type="password" required>
							</div>
							<div class="form-group">
								<label>Confirm Password: <span class="required">*</span></label>
								<input placeholder="Confirm Password" id="txtConfirmPassword" onkeyup="checkPasswordMatch();" name="password2" class="form-control" type="password" required>
								<p id="divCheckPasswordMatch" style="text-align:left;color:red;"></p>
							</div>
							<div class="form-group">
								<label>Phone Number: <span class="required">*</span></label>
								<input placeholder="Phone Number" name="phone" value="<?php echo $_POST['phone']; ?>" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label>Select Country: <span class="required">*</span></label>
								<select id="country" name="country" class="form-control country">
								   <option value="">-----Choose Country-----</option>
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
								<label>Select City: <span class="required">*</span></label>
								<select name="city" id="city" class="form-control" required>
								<option value="">-----Choose Country First-----</option>
								</select>
							</div>
							<div class="loginbox-submit">
								<input type="submit" name="submit" class="btn btn-primary" value="Register">
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
   <script type="text/javascript">
	function checkPasswordMatch() {
		var password = $("#txtNewPassword").val();
		var confirmPassword = $("#txtConfirmPassword").val();

		if (password != confirmPassword)
			$("#divCheckPasswordMatch").html("Passwords do not match!");
		else
			$("#divCheckPasswordMatch").html("Passwords match.");
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
		   <?php include('footer.php'); ?>