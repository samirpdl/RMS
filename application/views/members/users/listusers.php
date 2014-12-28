<div class="row">
          <div class="col-lg-12">
		 
				<h1>Users <small>Employees of your resturant</small></h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li class="active"><i class="fa fa-user"></i> Users</li>
            </ol>
			
		  
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
			
            <div class="panel panel-primary">
              <div class="panel-heading" style="height:50px">
                <h3 class="panel-title pull-left"><i class="fa fa-users"></i> Your Employees</h3>
				
				<a href="<?= site_url('members/users/add')?>" class="btn btn-info pull-right">Add User</a>
				
              </div>
			 
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
					  	<th>S.N <i class="fa fa-sort"></i></th>
						<th>Bill ID <i class="fa fa-sort"></i></th>
                        <th>Table Name <i class="fa fa-sort"></i></th>
						<th>Status <i class="fa fa-sort"></i></th>
						<th>Total Amount <i class="fa fa-sort"></i></th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if(count($bills)<1 || (!isset($bills)))
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