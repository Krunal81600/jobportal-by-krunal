<?php include('header.php'); ?>

<?php
if($_REQUEST['delete'])
{
    $id=$_GET['id'];
    
    mysqli_query($con,"DELETE FROM `blog` WHERE id='$id'");
	
    ?>
    <script>
        alert("Successfully Deleted");
    </script>
    <?php
    echo "<script type='text/javascript'>";
    echo "window.location='list_blog'";
    echo "</script>";

}
if($_REQUEST['pid'])
{
	$id = $_REQUEST['pid'];
	if($_REQUEST['popular'] == 0)
	{
			$popular= 1;
	}
	else
	{
			$popular= 0;
	}
	$pop = mysqli_query($con,"UPDATE `blog` SET blog_status='$popular' WHERE id='$id'");
	
		echo"<script type='text/javascript'>";
		echo"window.location='list_blog'";
		echo"</script>";
		echo"<script type='text/javascript'>alert('Successfully Changed');</script>";
	
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
            <h2>All Blog <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">All Blog List</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>All Blog </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
						<tr>
							<th>No</th>
							<th>Blog Title</th>
							<th>Blog Content</th>
							<th>Blog Image</th>
							<th>Blog Date</th>
							<th>Popular</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$no=0;
						$a=mysqli_query($con,"SELECT * FROM `blog` ORDER BY  `id` DESC");

						while($row=mysqli_fetch_array($a))
						{
							$no=$no+1;
							?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $row['blog_title']; ?></td>
								<td style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo $row['blog_content']; ?></td>
								<td><img src="../images/<?php echo $row['blog_img']; ?>" height="80" width="80"></td>
								<td><?php echo $row['blog_date']; ?></td>
								<td><a href="list_blog?pid=<?php echo $row['id']; ?>&popular=<?php echo $row['blog_status']; ?>" class="btn <?php if($row['blog_status'] == 0){ ?>btn-info<?php }else{ ?>btn-warning<?php } ?>"><?php if($row['blog_status'] == 0){ ?><i class="fa fa-star-o"></i> <?php }else{ ?><i class="fa fa-star"></i> <?php } ?></a></td>
								<td>
								<a class="btn btn-space btn-success active" href="edit_blog?id=<?php echo $row['id']; ?>"><i class="fa fa-heart"></i> Edit</a>
								<a class="btn btn-space btn-danger active" href="list_blog?id=<?php echo $row['id']; ?>&delete=delete"><i class="fa fa-heart"></i> Delete</a>
								</td>
								</tr>
						<?php  } ?>
						</tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>