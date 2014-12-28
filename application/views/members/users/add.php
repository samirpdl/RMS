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
			  <li><a href="<?= base_url();?>members/bills"><i class="fa fa-file"></i> Bills</a></li>
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
			 
			 	<form action="<?= base_url();?>members/bills/post" method="POST">
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
							<td style="width:20%">Bill Type</td>
							<td><label for="bill_type_new"><input required="required" type="radio" name="bill_type" id="bill_type_new" value="1">New</label>
								<label for="bill_type_existing"><input type="radio" required="required" name="bill_type" id="bill_type_existing" value="2">Existing</label>
							</td>
						</tr>

						<tr style="display:none" id="bill_existing">
							<td>Bill ID</td>
							<td>
								<?php
								if(count($bills)<1)
								{
									echo "Sorry! You don't have any existing bills !";
								}else{
									?>
								<select name="bill_id" class="form-control">
								
								<?php
								foreach($bills as $row):
								?>
								<option value="<?= $row->id;?>">Bill #<?= $row->id;?></option>
								<?php
								endforeach;
								?>
							
							
							</select>
							<?php
								}
								?>
							</td>
						</tr>


						<tr style="display:none" id="bill_new">
							<td>Table Name</td>
							<td>

								<?php
								if(count($tables)<1)
								{
									echo "Sorry! You don't have any free tables !";
								}else{
									?>
							<select name="table_name" class="form-control">
								
								<?php
								foreach($tables as $row):
								?>
								<option value="<?= $row->id;?>"><?= $row->table_name;?></option>
								<?php
								endforeach;
								?>
							
							
							</select>
							<?php
							}
							?>
							</td>
						</tr>
						
						<tr>
							<td style="width: 20%">Menu</td>
							<td>
								<select name="menu" class="form-control">
								
								<?php
								foreach($menus as $row):
								?>
								<option value="<?= $row->id;?>"><?= $row->name;?></option>
								<?php
								endforeach;
								?>
							
							
							</select>
							</td>
						</tr>
						
						<tr>
							<td>Quantity</td>
							<td>
								<input type="text" name="quantity" required="required" class="form-control" value="<?= (isset($post['quantity'])) ? $post['quantity'] : '';?>" />
								
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

<script type="text/javascript">
$("#bill_type_existing").click(function()
{
	$("#bill_new").hide();
	$("#bill_existing").show();
});


$("#bill_type_new").click(function()
{
	$("#bill_existing").hide();
	$("#bill_new").show();
});

</script>