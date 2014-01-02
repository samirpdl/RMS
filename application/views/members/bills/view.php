<div class="row">
          <div class="col-lg-12">
		  <h1>Viewing Bill #<?= $billdetails->id;?></h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li><a href="<?= base_url();?>members/bills"><i class="fa fa-file"></i> Bills</a></li>
			  <li class="active"><i class="fa fa-eye"></i> View</li>
			  

			  
            </ol>
          </div>
        </div><!-- /.row -->
<div class="row">
             <div class="col-lg-12">
			 
			 
			 <div class="table-responsive">
			 
				<table class="table table-bordered table-hover table-striped">
					<tbody>
						<tr>
							<td style="width:20%">Bill Number</td>
							<td><?= $billdetails->id;?></td>
						</tr>
						<tr>
							<td>Table Name</td>
							<td><?= $billdetails->table_name;?></td>
						</tr>

						<tr>
							<td>Bill Created Date</td>
							<td><?= $billdetails->datetime;?></td>
						</tr>

						<tr>
							<td>Created By </td>
							<td><?= $billdetails->first_name.' '.$billdetails->last_name;?></td>
						</tr>

						<tr>
							<td>Bill Status</td>
							<td><?php
						
						$status=$billdetails->status;
						
						switch($status):
							case STATUS_INACTIVE:
								echo "Un Paid";
								break;
							case STATUS_PAID:
								echo "Paid";
								break;
							default:
								echo "";
								break;
						endswitch;
						
						?>
							</td>
						</tr>

						<tr>
							<td>Bill Amount</td>
							<td><?= MONEY_SYMBOL.' '.$billdetails->total_amt;?></td>
						</tr>

				</table>


				<table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
					  	<th>S.N <i class="fa fa-sort"></i></th>
						<th>Order ID <i class="fa fa-sort"></i></th>
                        <th>Menu Item <i class="fa fa-sort"></i></th>
                        <th>Price <i class="fa fa-sort"></i></th>
                        <th>Quantity <i class="fa fa-sort"></i></th>
						<th>Amount <i class="fa fa-sort"></i></th>
						<?php
						if($status!=STATUS_PAID)
						{
						?>	
                        <th>Action </th>
                      	<?php
						}
						?>
					  </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	$sn=1;
                    	foreach($orders as $row):
                    		?>
                    	<tr>
                    		<td><?= $sn;?></td>
                    		<td><?= $row->id;?></td>
                    		<td><?= $row->name;?></td>
                    		<td><?= $row->price;?></td>
                    		<td><?= $row->quantity;?></td>
                    		<td><?= (($row->price)*($row->quantity))?></td>
							<?php
							if($status!=STATUS_PAID)
							{
							?>	
                    		<td><a href="<?= base_url();?>members/bills/dorder/<?= $row->id;?>">Delete</a></td>
							<?php
							}
							?>
                    	</tr>
                    	<?php
                    	$sn++;
                    	endforeach;
                    	?>
			 </div>
			 
			 
			 
			 </div>
</div>
