<?php include('header.php'); ?>
<?php
	$id=$_GET['id'];
	
	if(isset($_REQUEST['pending']))
	{
		$id=$_GET['id'];
		$status="1";
		
		mysqli_query($con,"UPDATE `ticket` SET `status`='$status' WHERE id='$id'");
		
		$last_id = "0";
	    $notify="Your Tcket Has Been Solved";
	    $type="admin";
		$byuser_id=$_GET['mid'];

	   $query=mysqli_query($con,"insert into notification(user_id,byuser_id,notify,type) values('$last_id','$byuser_id','$notify','$type')");
		
		?>
		<script>
			alert("Successfully Updated");
	</script>
   <?php
		echo "<script type='text/javascript'>";
		echo "window.location='reply?id=$id'";
		echo "</script>";
	}
?> 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>User Ticket<strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
				<li><a href="view?id=<?php echo $id; ?>">View</a></li>
                <li class="active">User Ticket</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>User Ticket</strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
						   <th>No</th>
							<th>Ticket Title</th>
							<th>Message</th>
							<th>Screen Shot</th>
							<th>Reply</th>
							<th>Date</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					 <?php
				$no=0;
				$id=$_GET['id'];
				$a=mysqli_query($con,"SELECT * FROM `ticket` where tuid='$id' ORDER BY  `id` DESC");
				
				while($row=mysqli_fetch_array($a))
				{
					$no=$no+1;
					
			?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['ticket_title']; ?></td>
					<td><?php echo $row['message']; ?></td>
					<td><img src="../member/images/<?php echo $row['screen_file']; ?>" height="50" width="50"></td>
					<td><?php echo $row['reply']; ?></td>
					<td><?php echo $row['tdate']; ?></td>
					<td>
					<?php if($row['status']==0) { ?>
						<a href="ticket_list?id=<?php echo $row['id']; ?>&mid=<?php echo $id; ?>&pending=pending" class="fcbtn btn btn-danger btn-outline btn-1e" style="width:100%;">Pending</a>
				   <?php } else { ?>
						<span class="fcbtn btn btn-success btn-outline btn-1e" style="width:100%;">Solve</span>
				   <?php } ?>
					</td>
				 </tr>
						<?php } ?>
					</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>