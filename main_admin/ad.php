<?php include('header.php'); ?>

<?php

if($_REQUEST['approve'])
{
    $id=$_GET['id'];
    
    mysqli_query($con,"UPDATE `comp_ad` SET `ad_app`='1' WHERE id='$id'");
	
    ?>
    <script>
        alert("Successfully Approved");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='ad'";
    echo "</script>";

}
?>
<style>
.btn 
{
	padding:8px 5px 8px 10px !important;}
</style>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>All Candidate <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Candidate</li>
              </ol>
            </div>
          </div>
		  <?php
		  if($_REQUEST['edit'])
		  {
			  $idb=$_GET['id'];
			  $qry_rowb=mysqli_query($con,"SELECT * FROM `comp_ad` WHERE id='$idb'"); 
			  $rowc=mysqli_fetch_array($qry_rowb);
			  if(isset($_POST['submit']))
				{
					$sdate=$_POST['sdate'];
					$edate=$_POST['edate'];
					$banner_size=$_POST['banner_size'];
					$payoption=$_POST['payoption'];
					$pay_by=$_POST['pay_by'];
					$comp_website=$_POST['comp_website'];
					$ad_title=$_POST['ad_title'];
					$ad_desc=$_POST['ad_desc'];
					
					if($_FILES['ad_img']['name'])
					{
					$img = $_FILES['ad_img']['name'];
					$tmp = $_FILES['ad_img']['tmp_name'];
					$size = $_FILES['ad_img']['size'];
					$type = $_FILES['ad_img']['type'];
					
					$rnd = mt_rand(1,99999);
					$fnm = "img". $rnd . $img;
					$ad_img = str_replace(' ','_',$fnm);
					move_uploaded_file($tmp,'upload/'.$ad_img);
					$idb=$_GET['id'];
					
					mysqli_query($con,"UPDATE `comp_ad` SET `sdate`='$sdate',`edate`='$edate',`banner_size`='$banner_size',`payoption`='$payoption',`pay_by`='$pay_by',`comp_website`='$comp_website',`ad_title`='$ad_title',`ad_desc`='$ad_desc',`ad_img`='$ad_img' WHERE id='$idb'");
					}
					else
					{
						$ad_img=$rowc['ad_img'];
						
						mysqli_query($con,"UPDATE `comp_ad` SET `sdate`='$sdate',`edate`='$edate',`banner_size`='$banner_size',`payoption`='$payoption',`pay_by`='$pay_by',`comp_website`='$comp_website',`ad_title`='$ad_title',`ad_desc`='$ad_desc',`ad_img`='$ad_img' WHERE id='$idb'");
					}
					?>
					<script>
						alert("Successfully Updated");
					</script>
					<?php
					
					echo "<script type='text/javascript'>";
					echo "window.location='ad'";
					echo "</script>";
				}
		  ?>
		  <div class="row">
            <div class="col-lg-12 portlets">
				<div class="panel panel-default no-bd">
                <div class="panel-header bg-dark">
                  <h2 class="panel-title"><strong>Company Unapproved Post Job</strong> Info</h2>
                </div>
                <div class="panel-body bg-white">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
						<form class="row" method="POST" enctype="multipart/form-data">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>From Date <span class="required">*</span></label>
									<input placeholder="Select From Date" class="form-control" name="sdate" type="date" value="<?php echo $rowc['sdate']; ?>">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>To Date <span class="required">*</span></label>
									<input placeholder="To From Date" class="form-control" name="edate" type="date" value="<?php echo $rowc['edate']; ?>">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Banner Size <span class="required">*</span></label>
									<select name="banner_size" class="form-control">
										<option value="">Select Banner Size </option>
										<option value="Large" <?php if($rowc['banner_size']=="Large") echo "selected='selected'"; ?>> Large </option>
										<option value="Medium" <?php if($rowc['banner_size']=="Medium") echo "selected='selected'"; ?>> Medium </option>
										<option value="Small" <?php if($rowc['banner_size']=="Small") echo "selected='selected'"; ?>> Small </option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Select Payment Mode <span class="required">*</span></label>
									<select name="payoption" class="form-control">
										<option value="">Select Payment Mode </option>
										<option value="Daily payment costs USD 6.99" <?php if($rowc['payoption']=="Daily payment costs USD 6.99") echo "selected='selected'"; ?>>Daily payment costs USD 6.99 </option>
										<option value="Monthly payment deal USD 199.70" <?php if($rowc['payoption']=="Monthly payment deal USD 199.70") echo "selected='selected'"; ?>>Monthly payment deal USD 199.70</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Select Payment By <span class="required">*</span></label>
									<select name="pay_by" class="form-control">
										<option value="">Select Payment By </option>
										<option value="Pay by Cash" <?php if($rowc['pay_by']=="Pay by Cash") echo "selected='selected'"; ?>>Pay by Cash </option>
										<option value="Pay by Card" <?php if($rowc['pay_by']=="Pay by Card") echo "selected='selected'"; ?>>Pay by Card</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Ad Title</label>
									<input type="text" placeholder="Ad Title" name="ad_title" class="form-control" required value="<?php echo $rowc['ad_title']; ?>">
								</div>
							</div>
						   <div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Website URL</label>
									<input type="text" placeholder="Website URL" name="comp_website" class="form-control" required value="<?php echo $rowc['comp_website']; ?>">
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Select Image</label>
									<input type="file" name="ad_img" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Image</label>
									<img src="../upload/<?php echo $rowc['ad_img']; ?>" alt="create ad" height="80" width="80">
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Ad Detials</label>
									<textarea placeholder="Ad Detials" class="summernote" name="ad_desc" required><?php echo $rowc['ad_desc']; ?></textarea>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button class="btn btn-default pull-right" type="submit" name="submit">Create <i class="fa fa-angle-right"></i></button>
							</div>
						</form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  <?php } else { ?>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Candidate </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Post By</th>
							<th>From Date</th>
							<th>To Date</th>
							<th>Banner Size</th>
							<th>Payment Mode</th>
							<th>Payment By</th>
							<th>Ad Title</th>
							<th>Website URL</th>
							<th>Ad Detials</th>
							<th>Ad Image</th>
							<th>Post Ad Date</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$a=mysqli_query($con,"SELECT * FROM `comp_ad` ORDER BY  `id` DESC");

						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							$cid=$row['ad_by'];
							$aa=mysqli_query($con,"SELECT * FROM `company` WHERE comp_uid='$cid'");
						    $rowa=mysqli_fetch_array($aa);
							
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><a href="../company_details?id=<?php echo $rowa['comp_uid']; ?>" target="_blank"><?php echo $rowa['industry']; ?></a></td>
								<td><?php echo $row['sdate']; ?> </td>
								<td><?php echo $row['edate']; ?></td>
								<td><?php echo $row['banner_size']; ?></td>
								<td><?php echo $row['payoption']; ?></td>
								<td><?php echo $row['pay_by']; ?></td>
								<td><?php echo $row['ad_title']; ?></td>
								<td><?php echo $row['comp_website']; ?></td>
								<td><?php echo $row['ad_desc']; ?></td>
								<td><img src="../upload/<?php echo $row['ad_img']; ?>" height="80" width="50"></td>
								<td><?php echo $row['ps_date']; ?></td>
								<td><?php
									if($row['ad_app']=="0")
									{
									?>
									<a href="ad?id=<?php echo $row['id']; ?>&approve=approve" class="btn btn-space btn-danger active" title="Approve">Approve</a>
									<?php } else { ?>
									<span class="btn btn-space btn-success active" title="Approved">Approved</span>
								<?php } ?>

								</td>
								<td><a class="btn btn-info" href="ad?id=<?php echo $row['id']; ?>&edit=edit"> Edit </a>
								<a class="btn btn-danger" href="delete?id=<?php echo $row['id']; ?>&ad=ad"> Delete </a></td>
								</tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
		  <?php } ?>
		   <?php include('footer.php'); ?>