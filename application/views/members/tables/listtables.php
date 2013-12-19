<div class="row">
          <div class="col-lg-12">
            <h1>Tables <small>Tables On Your Resturant</small></h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li class="active"><i class="fa fa-desktop"></i> Tables</li>
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
                <h3 class="panel-title pull-left"><i class="fa fa-desktop"></i> Your Tables</h3>
				<a href="<?= base_url();?>members/tables/add" class="btn btn-info pull-right">Add Table</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
					  	<th>S.N <i class="fa fa-sort"></i></th>
						<th>Table Name <i class="fa fa-sort"></i></th>
                        <th>Table Capacity <i class="fa fa-sort"></i></th>
                        <th>Table Status <i class="fa fa-sort"></i></th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if(count($tables)<1)
					{
						echo '
						<tr>
							<th colspan="4">Sorry ! You donot have any tables yet ! Please create one !</th>
						</tr>';
					}else{
						$count=1;
						foreach($tables as $row):
						?>
                      <tr>
					  	<td><?= $count;?></td>
						<td><?= $row->table_name;?></td>
                        <td><?= $row->capacity;?></td>
                        <td><?php
						
						$status=$row->status;
						
						switch($status):
							case TABLE_STATUS_UNAVAILABLE:
								echo "Unavailable";
								break;
							case TABLE_STATUS_FREE:
								echo "Free";
								break;
							case TABLE_STATUS_OCCUPIED:
								echo "Occupied";
								break;
							case TABLE_STATUS_RESERVED:
								echo "Reserved";
								break;
							default:
								echo "";
								break;
						endswitch;
						
						?></td>
                        <td>
						<a href="<?= base_url();?>members/tables/edit/<?= $row->id;?>" class="fa fa-edit"></a></td>
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