<?php
$con = new mysqli("localhost", "jobportal", "jobportal", "jobportal");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$today=date('Y-m-d');
$exp=mysqli_query($con,"SELECT * FROM `payment` WHERE `edate` < '$today' AND `postid`!='0' AND `noti_status`='0' ");
while($rowexp=mysqli_fetch_array($exp))
{
	$expid=$rowexp['postid'];
	$uid=$rowexp['user_id'];
	$rowexpid=$rowexp['id'];
	
	mysqli_query($con,"UPDATE `post_job` SET `job_paid`='0',`app_status`='0' WHERE id='$expid'");
	
	mysqli_query($con,"UPDATE `payment` SET `noti_status`='1' WHERE id='$rowexpid'");
	
	$notify="Post was Expired";
	$type="user";
	$link="#";

	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$uid','$notify','$type','$link')");
	
	$notify="Post was Expired";
	$type="user";
	$link="#";

	$query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$uid','$notify','$type','$link')");
	
	$selps=mysqli_query($con,"SELECT * FROM `post_job` WHERE id='$expid'");
	$rowps=mysqli_fetch_array($selps);
	$postname=$rowps['job_title'];
	
	$selpsc=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$uid'");
	$rowpsc=mysqli_fetch_array($selpsc);
	$comp_email=$rowpsc['comp_email'];
	
	$to      = $comp_email;
	$subject = 'Post was Expired';
	$message = 'Your Post('.$postname.') for job was Expired' ;
	$header = "From: info@africaglobalnetwork.com\r\n"; 
	$headers= 'From: Website plc <info@africaglobalnetwork.com>' . "\r\n" .
			'Reply-To: info@africaglobalnetwork.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

	$mail=mail($to, $subject, $message, $header);
}

$expa=mysqli_query($con,"SELECT * FROM `payment` WHERE `edate` < '$today' AND `postid`='0' AND `noti_status`='0' ");
while($rowexpa=mysqli_fetch_array($expa))
{
	$expida=$rowexpa['user_id'];
	$rowexpid=$rowexpa['id'];
	
	 mysqli_query($con,"UPDATE `user` SET `paid_user`='0',`paid_user_ap`='0' WHERE id='$expida'");
	 
	 mysqli_query($con,"UPDATE `payment` SET `noti_status`='1' WHERE id='$rowexpid'");
	 
	 $notify="Resume was expired";
	 $type="user";
	 $link="#";

	 $query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$expida','$notify','$type','$link')");
	 
	$selpsc=mysqli_query($con,"SELECT * FROM `user` WHERE id='$uid'");
	$rowpsc=mysqli_fetch_array($selpsc);
	$email=$rowpsc['email'];
	
	$to      = $email;
	$subject = 'Resume was Expired';
	$message = 'Your resume for posted front side was expired' ;
	$header = "From: info@africaglobalnetwork.com\r\n"; 
	$headers= 'From: Website plc <info@africaglobalnetwork.com>' . "\r\n" .
			'Reply-To: info@africaglobalnetwork.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

	$mail=mail($to, $subject, $message, $header);
}

$expa=mysqli_query($con,"SELECT * FROM `comp_ad` WHERE `edate` < '$today' AND `ad_app`='1' AND `noti_status`='0' ");
while($rowexpa=mysqli_fetch_array($expa))
{
	$ad_by=$rowexpa['ad_by'];
	$rowexpid=$rowexpa['id'];
		 
	 mysqli_query($con,"UPDATE `comp_ad` SET `noti_status`='1' WHERE id='$rowexpid'");
	 
	 $notify="Ad was Expired";
	 $type="user";
	 $link="ad?id=$rowexpid&edit=edit";

	 $query=mysqli_query($con,"insert into notification(user_id,notify,type,link) values('$ad_by','$notify','$type','$link')");
	 
	$selpsc=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$ad_by'");
	$rowpsc=mysqli_fetch_array($selpsc);
	$comp_email=$rowpsc['comp_email'];
	
	$to      = $comp_email;
	$subject = 'Ad was Expired';
	$message = 'Your Ad for posted front side was expired' ;
	$header = "From: info@africaglobalnetwork.com\r\n"; 
	$headers= 'From: Website plc <info@africaglobalnetwork.com>' . "\r\n" .
			'Reply-To: info@africaglobalnetwork.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

	$mail=mail($to, $subject, $message, $header);
}
?>
