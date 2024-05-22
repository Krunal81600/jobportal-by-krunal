<?php include('header.php'); 
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
                <li class="active">Add Box</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 portlets">
				<div class="col-lg-8">
				<div id="shouts">
					<ul>
						<?php 
						$id=$_SESSION['id'];
						$ida=$_GET['id'];
						$query = mysqli_query($con,"SELECT * FROM chat WHERE (user_by='$ida' AND user_to='$id') OR (user_by='$id' AND user_to='$ida') ORDER BY id DESC");
						while($row = mysqli_fetch_array($query))
						{
						$user_by=$row['user_by'];
						$querya = mysqli_query($con,"SELECT * FROM admin_user WHERE id='$user_by'");
						$rowa = mysqli_fetch_array($querya);
						?>
							<li class="shout"><span><?php echo $row['time']; ?> - </span><strong><?php echo $rowa['user']; ?>:</strong> <?php echo $row['message']; ?> </li>
						<?php } ?>              
					</ul>
				</div>
				<div id="input">
					<?php if(isset($_GET['error'])) { ?>
						<div class="error"><?php echo $_GET['error']; ?></div>
					<?php } ?>
					<form method="post" action="process.php">
						<input type="hidden" name="user_by" value="<?php echo $id; ?>" placeholder="Enter Your Name" />
						<input type="hidden" name="user_to" value="<?php echo $ida; ?>" placeholder="Enter Your Name" />
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
							$queryus = mysqli_query($con,"SELECT * FROM admin_user WHERE id!='$id' ORDER BY id ASC");
							while($rowus = mysqli_fetch_array($queryus))
							{
							?>
								<a href="chat?id=<?php echo $rowus['id']; ?>">
								<li class="shout"><span><img src="images/<?php echo $rowus['img']; ?>" height="40" width="40" style="border-radius: 50%;"></span><strong style="margin-left: 21px;"><?php echo $rowus['user']; ?></strong></li></a>
							<?php } ?>              
						</ul>
					</div>
				</div>
				</div>
            </div>
          </div>
     
		   <?php include('footer.php'); ?>