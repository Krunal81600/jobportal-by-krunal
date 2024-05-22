<?php
	include('config.php');
	if(!empty($_POST['empId']))
	{	
		$emp = $_POST['empId'];
		if($emp == "Employee")
		{
			$q = mysqli_query($con,"SELECT * FROM `country` WHERE africa='1'");
			if(mysqli_num_rows($q)>0)
			{
				echo"<option value=''> Choose Country</option>";
				while($row = mysqli_fetch_array($q))
				{ ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['countrynm']; ?></option>
		<?php	}
			}
		}
		if($emp == "Employer")
		{
			$q = mysqli_query($con,"SELECT * FROM `country`");
			if(mysqli_num_rows($q)>0)
			{
				echo"<option value=''> Choose Country</option>";
				while($row = mysqli_fetch_array($q))
				{ ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['countrynm']; ?></option>
		  <?php	}
			}
		}
	}
	else
	{
		echo"<script type='text/javascript'>alert('Hello');</script>";
	}
?>