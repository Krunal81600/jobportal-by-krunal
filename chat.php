<?php
include('header.php');

if($_REQUEST['clear'])
{
	$chatid=$_GET['chatid'];
	$ida=$_GET['id'];
	$id=$_SESSION['member_id'];
	
	mysqli_query($con,"UPDATE `chatf` SET `chat_show`='1' WHERE (user_by='$ida' AND user_to='$id') OR (user_by='$id' AND user_to='$ida')");
	
	echo "<script type='text/javascript'>";
	echo "window.location='chat?id=$ida'";
	echo "</script>";
}
?>
<style>
#shouts li:hover {
    background: #848eb8;
    color: #fff;
}
</style>
<link rel="stylesheet" href="style.css" type="text/css" />
        <section class="breadcrumb-search parallex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-8 col-sm-12 col-md-offset-2 col-xs-12 nopadding">
                            <div class="search-form-contaner">
                                <h2 style="color: #fff;text-align: center;">Chat With<strong>Us</strong></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="categories-list-page light-grey">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-8 col-sm-12 col-xs-12">
							<div id="shouts">
								<ul id="fetchdata">
						              
								</ul>
							</div>
							<div id="input">
								<?php if(isset($_GET['error'])) { ?>
									<div class="error"><?php echo $_GET['error']; ?></div>
								<?php } 
								$id=$_SESSION['member_id'];
								$ida=$_GET['id'];
								?>
                                       
								<form method="post" action="process.php">
									<input type="hidden" name="user_by" value="<?php echo $id; ?>" placeholder="Enter Your Name" />
									<input type="hidden" name="type_us" value="user" placeholder="Enter Your Name" />
									<input type="hidden" id="chatdatab" name="user_to" value="<?php echo $ida; ?>" placeholder="Enter Your Name" />
									<textarea name="message" placeholder="Enter A Message" rows="5" style="width:100%;"/></textarea>
									<br />
									<div class="text-center">
									<input class="btn btn-embossed btn-primary" type="submit" name="submit" value="Send" />
									</div>
								</form>
							</div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <aside>
                                <div class="widget">
                                    <div class="widget-heading"><span class="title">Chat With Us</span></div>
                                    <div id="shouts" style="background: #fff;margin: 0px auto;;">
										<ul>
											<?php 
											$queryus = mysqli_query($con,"SELECT * FROM admin_user ORDER BY id ASC");
											while($rowus = mysqli_fetch_array($queryus))
											{
											?>
												<a href="chat?id=<?php echo $rowus['id']; ?>">
												<li class="shout"><span><img src="main_admin/images/<?php echo $rowus['img']; ?>" height="40" width="40" style="border-radius: 50%;"></span><strong style="margin-left: 21px;"><?php echo $rowus['user']; ?></strong>
												<?php
												if($rowus['online']==1)
												{
												?>
												<span style="background: rgb(66, 183, 42); border-radius: 50%; display: inline-block; height: 6px; margin-left: 4px; width: 6px;float: right;"></span>
												<?php } else { ?>
												<span class="right-chat" style="background: rgb(243, 20, 40); border-radius: 50%; display: inline-block; height: 6px; margin-left: 4px; width: 6px;float: right;"></span>
												<?php } ?>
												</li></a>
											<?php } ?>              
										</ul>
									</div>
                                </div>
                            </aside>
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
<script src="../jquery.min.js"></script>
<script type="text/javascript">
function loadlink(){
   var countryID = $('#chatdatab').val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'chatdata.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#fetchdata').html(html);
                }
            }); 
        }else{
            $('#fetchdata').html('Select Any Admin to Chat with us');
        }
}
 
 $(document).ready(function() {
	 loadlink();
	  });
	  
	  setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 5000);
</script>		
<?php
include('footer.php');
?>