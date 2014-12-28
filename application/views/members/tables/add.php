<div class="row">
          <div class="col-lg-12">
		  <?php
		  if(isset($post['edit']))
		  {
		  	echo '<h1>Edit Table <small>'.$post['table_name'].'</small></h1>';
		  }else{
		  	echo '<h1>Add New Table <small>Tables On Your Resturant</small></h1>';
		  }?>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li><a href="<?= base_url();?>members/tables"><i class="fa fa-desktop"></i> Tables</a></li>
			  <?php
			if(isset($post['edit']))
			{
		  		echo '<li class="active"><i class="fa fa-edit"></i> Edit</li>';
			}else{
				echo '<li class="active"><i class="fa fa-edit"></i> Add</li>';
			}
			?>
			  
            </ol>
          </div>
        </div><!-- /.row -->
<div class="row">
             <div class="col-lg-12">
			 
			 
			 <div class="table-responsive">
			 
			 <?php
			 if(validation_errors())
			 {
			 	echo '<div class="alert alert-danger">'.validation_errors().'</div>';
			 }
			 ?>
			 
			 	<form action="<?= base_url();?>members/tables/post" method="POST">
				<?php
				if(isset($post['edit']))
				{
					echo '<input type="hidden" name="edit" value="1" />';
					echo '<input type="hidden" name="id" value="'.$post['table_id'].'" />';
				}
				?>
			 	<table class="table table-boardered table-condensed table-striped">
					
					<tbody>
						
						<tr>
							<td style="width:20%">Table Name</td>
							<td><input type="text" required="required" class="form-control" value="<?= (isset($post['table_name'])) ? $post['table_name'] : '';?>" name="table_name"></td>
						</tr>
						
						<tr>
							<td>Table Capacity</td>
							<td><input type="text" required="required" class="form-control" value="<?= (isset($post['table_capacity'])) ? $post['table_capacity'] : '';?>" name="table_capacity"></td>
						</tr>
						
						<tr>
							<td>Table Status</td>
							<td>
								<select name="table_status" required="required" class="form-control">
								
									<option value="<?= TABLE_STATUS_FREE ?>" <?= (isset($post['table_status']) && ($post['table_status']==TABLE_STATUS_FREE)) ? 'selected="Selected"' : '';?>>Free</option>
									
									<option value="<?= TABLE_STATUS_UNAVAILABLE ?>" <?= (isset($post['table_status']) && ($post['table_status']==TABLE_STATUS_UNAVAILABLE)) ? 'selected="Selected"' : '';?>>Unavailable</option>
									
									<option value="<?= TABLE_STATUS_OCCUPIED ?>" <?= (isset($post['table_status']) && ($post['table_status']==TABLE_STATUS_OCCUPIED)) ? 'selected="Selected"' : '';?>>Occupied</option>
									
									<option value="<?= TABLE_STATUS_RESERVED ?>" <?= (isset($post['table_status']) && ($post['table_status']==TABLE_STATUS_RESERVED)) ? 'selected="Selected"' : '';?>>Reserved</option>
									
								</select>
								
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td><input type="submit" class="btn btn-success" value="Save"/></td>
							
						</tr>
						
					</tbody>
					
				</table>
				</form>
			 </div>
			 
			 
			 
			 </div>
</div>