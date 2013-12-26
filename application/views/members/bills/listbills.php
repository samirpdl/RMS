<div class="row">
          <div class="col-lg-12">
            <h1>Bills <small>Bills On Your Resturant</small></h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li class="active"><i class="fa fa-desktop"></i> Bills</li>
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
                <h3 class="panel-title pull-left"><i class="fa fa-desktop"></i> Your Bills</h3>
				<a href="<?= base_url();?>members/bills/add" class="btn btn-info pull-right">Add Bill</a>
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
					if(count($bills)<1)
					{
						echo '
						<tr>
							<th colspan="4">Sorry ! You donot have any tables yet ! Please create one !</th>
						</tr>';
					}else{
						$count=1;
						foreach($bills as $row):
						?>
                      <tr>
					  	<td><?= $count;?></td>
						<td><?= $row->id;?></td>
                        <td><?= $row->table_name;?></td>
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
						<a href="<?= base_url();?>members/bills/view/<?= $row->id;?>" class="fa fa-eye" title="View"></a></td>
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