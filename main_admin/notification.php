<?php include('header.php'); ?>
<script src="jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function deleteConfirm(){
    var result = confirm("Are you sure to delete?");
    if(result){
        return true;
    }else{
        return false;
    }
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>  
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2>Notification <strong>List</strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="index">Dashboard</a>
                </li>
                <li class="active">Notification</li>
              </ol>
            </div>
          </div>
          <div class="row" style="min-height:590px">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>Notification </strong> List</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
				<form name="form" action="delete.php" method="POST" onsubmit="return deleteConfirm();"/>
                  <table class="table table-hover table-dynamic">
                    <thead>
					<tr>
					<td colspan="4" align="center"> 
					<button type="submit" class="btn btn-space btn-danger active" name="bulk_delete_submitabc" value="multiple Delete"/><i class="fa fa-trash-o"></i>  multiple Delete</button>
					</td>
					</tr>
					<tr>
						<th><strong>Select All <input type="checkbox" name="select_all" id="select_all" value=""/> </strong> </th>
						<th>No</th>
						<th>Notification</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				  <?php
		   $no=0;
			$selectaa=mysqli_query($con,"SELECT * FROM `notification` where type='user' ORDER BY  `id` DESC");
			while($rowaa=mysqli_fetch_array($selectaa))
			{
				$no=$no+1;
				$user_id=$rowaa['user_id'];
				$selectaaa=mysqli_query($con,"SELECT * FROM `user` where id='$user_id'");
			  $rowaaa=mysqli_fetch_array($selectaaa);
			
			?>
			<tr>
				<td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $rowaa['id']; ?>"/></td>
				<td><?php echo $no; ?></td>
				<td><a href="<?php echo $rowaa['link']; ?>?&noti=noti&notiid=<?php echo $rowaa['id']; ?>"><?php echo $rowaaa['user'];?> <?php echo $rowaa['notify'];?></a></td>
				<td>
				<a href="delete?id=<?php echo $rowaa['id']; ?>&noti=noti" class="btn btn-space btn-danger active"><i class="fa fa-trash-o"></i> Delete</a>
				</td>
			 </tr>
			  
					<?php } ?>
				</tbody>
                  </table>
				  </form>
                </div>
              </div>
            </div>
          </div>
          
		   <?php include('footer.php'); ?>