<?php include('header.php'); 

if($_REQUEST['clear'])
{
	$chatid=$_GET['chatid'];
	$ida=$_GET['id'];
	$id=$_SESSION['id'];
	
	mysqli_query($con,"UPDATE `chatf` SET `chat_show`='1' WHERE (user_by='$ida' AND user_to='$id') OR (user_by='$id' AND user_to='$ida')");
	
	echo "<script type='text/javascript'>";
	echo "window.location='chat_cc?id=$ida'";
	echo "</script>";
}
?>

<link rel="stylesheet" href="style.css" type="text/css" />
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Chat <strong>Box</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">chat Box</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="col-lg-8">
				<div id="shouts">
					<ul id="fetchdata">
						              
					</ul>
				</div>
				<div id="input">
					<?php if(isset($_GET['error'])) { ?>
						<div class="error"><?php echo $_GET['error']; ?></div>
					<?php } 
					$id=$_SESSION['id'];
					$ida=$_GET['id'];
					?>
					<form method="POST" action="process_cc.php">
						<input type="hidden" name="user_by" value="<?php echo $id; ?>" placeholder="Enter Your Name" />
						<input type="hidden" name="type_us" value="admin" placeholder="Enter Your Name" />
						<input type="hidden" name="user_to" id="chatdatab" value="<?php echo $ida; ?>" placeholder="Enter Your Name" />
						<textarea name="message" placeholder="Enter A Message" rows="5" style="width:100%;"/></textarea>
						<br />
						<div class="text-center">
						<input class="btn btn-embossed btn-primary" type="submit" name="submit" value="Send" />
						</div>
					</form>
				</div>
				</div>
				<div class="col-lg-4">
					<div id="shouts">
						<ul>
							<?php 
							$queryus = mysqli_query($con,"SELECT * FROM user ORDER BY id ASC");
							while($rowus = mysqli_fetch_array($queryus))
							{
							?>
								<a href="chat_cc?id=<?php echo $rowus['id']; ?>">
								<li class="shout"><span><img src="../upload/<?php echo $rowus['profile']; ?>" height="40" width="40" style="border-radius: 50%;"></span><strong style="margin-left: 21px;"><?php echo $rowus['user']; ?></strong>
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
				</div>
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
		   <?php include('footer.php'); ?>