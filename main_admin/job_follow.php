<?php include('header.php'); 
error_reporting(0);
?> 
 
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Followed By Candidate <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Followed By Candidate</li>
              </ol>
            </div>
          </div>

          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Followed By Candidate </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Sr. #</th>
						<th>Follow By</th>
						<th>Company Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					$no=0;
					$id=$_GET['id'];
					if($id)
					{
					$resapp=mysqli_query($con,"SELECT * FROM `follow` WHERE user_id='$id' ORDER BY  `id` DESC");
					}
					else
					{
					$resapp=mysqli_query($con,"SELECT * FROM `follow` ORDER BY  `id` DESC");
					}
					while($rowapp=mysqli_fetch_array($resapp))
					{
						$no=$no+1;
						$user_id=$rowapp['user_id'];
						$comp_id=$rowapp['comp_id'];
						
						$selab=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$comp_id'");
						$rowab=mysqli_fetch_array($selab);
						
						$selabc=mysqli_query($con,"SELECT * FROM `user` WHERE id='$user_id'");
						$rowabc=mysqli_fetch_array($selabc);
					?>
						<tr>
							<th scope="row"><?php echo $no; ?></th>
								<td><a href="../user_resume?id=<?php echo $rowabc['id']; ?>" target="_blank"><?php echo $rowabc['user']; ?></a></td>
								<td><a href="../company_details?id=<?php echo $rowab['comp_uid']; ?>" target="_blank"><?php echo $rowab['industry']; ?></a></td>
						</tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
		   <?php include('footer.php'); ?>