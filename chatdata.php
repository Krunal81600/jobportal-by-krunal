<?php 
include('config.php');
session_start();
if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
	$id=$_SESSION['member_id'];
	$ida=$_POST["country_id"];
	$query = mysqli_query($con,"SELECT * FROM chatf WHERE (user_by='$ida' AND user_to='$id') OR (user_by='$id' AND user_to='$ida') ORDER BY id DESC");
	while($row = mysqli_fetch_array($query))
	{
	$user_by=$row['user_by'];
	$type_us=$row['type_us'];
	
	$querya = mysqli_query($con,"SELECT * FROM user WHERE id='$user_by'");
	$rowa = mysqli_fetch_array($querya);
	
	$queryaa = mysqli_query($con,"SELECT * FROM admin_user WHERE id='$user_by'");
	$rowaa = mysqli_fetch_array($queryaa);
	?>
		<li class="shout"><span><?php echo $row['time']; ?> - </span><strong><?php if($type_us=='admin')
		{
		echo $rowaa['user'];
		}
		else
		{
		echo $rowa['user'];
		}; ?>:</strong> <?php echo $row['message']; ?> </li>
<?php } } ?> 