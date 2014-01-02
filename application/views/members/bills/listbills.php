<div class="row">
          <div class="col-lg-12">
		  <?php
		  if(isset($reports))
		  {
		  	?>
			<h1>Reports <small>Reports On Your Resturant</small></h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li class="active"><i class="fa fa-desktop"></i> Reports</li>
            </ol>
			
		<?php
			}else{
				
				?>
				<h1>Bills <small>Bills On Your Resturant</small></h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li class="active"><i class="fa fa-desktop"></i> Bills</li>
            </ol>
			<?php
			}
			?>
		  
          </div>
        </div><!-- /.row -->
	<div class="row">
             <div class="col-lg-12">
			 
			 <?php
			 if(isset($_GET['msg']) && (!empty($_GET['msg'])))
			 {
			 	echo '<div class="alert alert-success">'.urldecode($_GET['msg']).'</div>';
			 }
			 
			 
			 if(isset($_GET['err']) && (!empty($_GET['err'])))
			 {
			 	echo '<div class="alert alert-danger">'.urldecode($_GET['err']).'</div>';
			 }
			 
			 ?>
			 <?php
						if(isset($reports))
						{
							?>
			 <div class="panel panel-info">
			 <div class="panel-heading" style="height:40px">
                <h3 class="panel-title pull-left"><i class="fa fa-desktop"></i> Date Range</h3>
				</div>
			 <form class="form-inline" role="form" style="margin:10px;" action="" method="POST">
			 <input type="hidden" name="search" value="1">
				  <div class="form-group">
				    <label for="dpd1">Starting Date</label>
				    <input type="text" class="form-control" name="date_start" placeholder="Starting Date" value="<?= date('Y-m-d');?>">
				  </div>
				  <div class="form-group">
				    <label  for="dpd2">Ending Date</label>
				    <input type="text" class="form-control" name="date_end" placeholder="Ending Date" value="<?= date('Y-m-d');?>">
				  </div>
				  
				  <div class="form-group">
				  
				  	<input type="submit" value="Search" class="btn btn-success">
				  </div>
			 </form> 
			 </div>
			 
			 <?php
			 }
			 ?>
            <div class="panel panel-primary">
              <div class="panel-heading" style="height:50px">
                <h3 class="panel-title pull-left"><i class="fa fa-desktop"></i> Your Bills</h3>
				<?php
				if(!isset($reports))
				{
					?>
				<a href="<?= base_url();?>members/bills/add" class="btn btn-info pull-right">Add Bill</a>
				<?php
				}
				?>
              </div>
			 
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
					  	<th>S.N <i class="fa fa-sort"></i></th>
						<th>Bill ID <i class="fa fa-sort"></i></th>
                        <th>Table Name <i class="fa fa-sort"></i></th>
						<?php
						if(isset($reports))
						{
							?>
						<th>Date <i class="fa fa-sort"></i></th>
						<?php
						}
						?>
                        <th>Status <i class="fa fa-sort"></i></th>
						<th>Total Amount <i class="fa fa-sort"></i></th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if(count($bills)<1)
					{
						echo '
						<tr>
							<th colspan="6">Sorry ! You donot have any bills yet ! Please create one !</th>
						</tr>';
					}else{
						$count=1;
						foreach($bills as $row):
						?>
                      <tr>
					  	<td><?= $count;?></td>
						<td><?= $row->id;?></td>
                        <td><?= $row->table_name;?></td>
						<?php
						if(isset($reports))
						{
							?>
						<td><?= $row->datetime;?></td>
						<?php
						}
						?>
                        <td><?php
						
						$status=$row->status;
						
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
						
						?></td>
						<td><?= $row->total_amt;?>
							</td>
                        <td>
						<a href="<?= base_url();?>members/bills/view/<?= $row->id;?>" class="fa fa-eye" title="View"></a>
						<?php
						if($status!=STATUS_PAID)
						{
							?>
						<a href="<?= base_url();?>members/bills/changestatus/<?= $row->id;?>" class="">Paid</a>
						<?php
						}
						?>
					</td>
                      </tr>
                      <?php
					  	$count++;
					  	endforeach;
					}
					?>
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>
		  
		  
		  </div>
		  
	<link href="<?= base_url();?>static/css/datepicker.css" rel="stylesheet"  type="text/css"/>
	<script src="<?= base_url();?>static/js/bootstrap-datepicker.js"></script>
		 <script>
		 	var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 
var checkin = $('#dpd1').datepicker({
	format: 'yyyy-mm-dd',
  onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
 
  if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
  }
  checkin.hide();
  $('#dpd2')[0].focus();
}).data('datepicker');
var checkout = $('#dpd2').datepicker({
	format: 'yyyy-mm-dd',
  onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkout.hide();
}).data('datepicker');
		 </script>