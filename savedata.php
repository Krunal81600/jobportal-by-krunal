<?php
include 'config.php';
session_start();

if(isset($_POST['payment']))
{
	$sdate=$_POST['sdate'];
	$edate=$_POST['edate'];
	$payoption=$_POST['amount'];
	$pay_by=$_POST['pay_by'];
	$postid=$_POST['postid'];
	$session_id=$_SESSION['member_id'];
	
	mysqli_query($con,"UPDATE `post_job` SET `job_paid`='1' WHERE id='$postid'");
	
	mysqli_query($con,"INSERT INTO `payment`(`sdate`, `edate`, `payoption`, `pay_by`, `postid`, `user_id`) VALUES ('$sdate','$edate','$payoption','$pay_by','$postid','$session_id')");
	
	$notify="Upload Payment For Post";
	$type="user";
	$link="payment";
	$jct=date('Y-m-d H:i:s');
	
	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
	
	?>
	<script>
		alert("You are now a paid user from <?php echo $sdate; ?> To <?php echo $edate; ?> , ”The job will be posted as soon as the payment is processed");
	</script>
	<?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='company-dashboard-active-jobs'";
	echo "</script>";
}
?>