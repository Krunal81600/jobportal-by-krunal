<?php
    include('../config.php');
	error_reporting(0);
	if($_REQUEST['user'])
	{
    $news_id = $_REQUEST['id']; 
    $user_result =mysqli_query($con,"DELETE FROM `user` WHERE id='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `education` WHERE edu_uid='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `experience` WHERE exp_uid='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `skill` WHERE skill_uid='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `social` WHERE social_uid='$news_id'");
	?>
		<script>
			alert("Successfully Deleted");
		</script>
   <?php
    echo "<script type='text/javascript'>";
	echo "window.location='user'";
	echo "</script>";
	}
	
	if($_REQUEST['company'])
	{
    $news_id = $_REQUEST['id']; 
    $user_result =mysqli_query($con,"DELETE FROM `user` WHERE id='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `company` WHERE comp_uid='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `social` WHERE social_uid='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `post_job` WHERE job_uid='$news_id'");
	?>
		<script>
			alert("Successfully Deleted");
		</script>
   <?php
    echo "<script type='text/javascript'>";
	echo "window.location='company'";
	echo "</script>";
	}
	
	if($_REQUEST['post'])
	{
    $news_id = $_REQUEST['id']; 
    $user_result =mysqli_query($con,"DELETE FROM `post_job` WHERE id='$news_id'");
	?>
		<script>
			alert("Successfully Deleted");
		</script>
   <?php
    echo "<script type='text/javascript'>";
	echo "window.location='post_job'";
	echo "</script>";
	}
	
	if($_REQUEST['ad'])
	{
    $news_id = $_REQUEST['id']; 
    $user_result =mysqli_query($con,"DELETE FROM `comp_ad` WHERE id='$news_id'");
	?>
		<script>
			alert("Successfully Deleted");
		</script>
   <?php
    echo "<script type='text/javascript'>";
	echo "window.location='ad'";
	echo "</script>";
	}
	
	if($_REQUEST['admin_user'])
	{
    $news_id = $_REQUEST['id']; 
    $user_result =mysqli_query($con,"DELETE FROM `admin_user` WHERE id='$news_id'");
    $user_result =mysqli_query($con,"DELETE FROM `access` WHERE subadmin_id='$news_id'");
	
	?>
		<script>
			alert("Successfully Deleted");
		</script>
   <?php
    echo "<script type='text/javascript'>";
	echo "window.location='subadmin_list'";
	echo "</script>";
	}
	
	if(($_POST['bulk_delete_submitabc'])){
        $idArr = $_POST['checked_id'];
        foreach($idArr as $id){
    		mysqli_query($con,"DELETE FROM `notification` WHERE  id=".$id);
        }
       
        echo "<script type='text/javascript'>";
		echo "window.location='notification'";
		echo "</script>";
    }
	
	if($_REQUEST['noti'])
	{
    $news_id = $_REQUEST['id']; 
    $user_result =mysqli_query($con,"DELETE FROM `notification` WHERE id='$news_id'");
	?>
		<script>
			alert("Successfully Deleted");
		</script>
   <?php
    echo "<script type='text/javascript'>";
	echo "window.location='notification'";
	echo "</script>";
	}
	?>