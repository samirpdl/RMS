<div class="row">
          <div class="col-lg-12">
		  <?php
		  if(isset($post['edit']))
		  {
		  	echo '<h1>Edit Menu <small>'.$post['item_name'].'</small></h1>';
		  }else{
		  	echo '<h1>Add New Menu <small>Items On Your Resturant</small></h1>';
		  }?>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li><a href="<?= base_url();?>members/menus"><i class="fa fa-desktop"></i> Menus</a></li>
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
			 
			 	<form action="<?= base_url();?>members/menus/post" method="POST">
				<?php
				if(isset($post['edit']))
				{
					echo '<input type="hidden" name="edit" value="1" />';
					echo '<input type="hidden" name="menu_id" value="'.$post['menu_id'].'" />';
				}
				?>
			 	<table class="table table-boardered table-condensed table-striped">
					
					<tbody>
						
						<tr>
							<td style="width:20%">Item Name</td>
							<td><input type="text" required="required" class="form-control" value="<?= (isset($post['item_name'])) ? $post['item_name'] : '';?>" name="item_name"></td>
						</tr>
						
						<tr>
							<td style="width:20%">Item Price</td>
							<td><input type="text" required="required" class="form-control" value="<?= (isset($post['item_price'])) ? $post['item_price'] : '';?>" name="item_price"></td>
						</tr>
						
						
						<tr>
							<td>Item Category</td>
							<td><input type="text" required="required" class="form-control" value="<?= (isset($post['item_category'])) ? $post['item_category'] : '';?>" name="item_category"></td>
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