<div class="row">
          <div class="col-lg-12">
            <h1>Menus <small>Items On Your Resturant</small></h1>
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>members/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			  <li class="active"><i class="fa fa-desktop"></i> Menus</li>
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
                <h3 class="panel-title pull-left"><i class="fa fa-desktop"></i> Your Menus</h3>
				<a href="<?= base_url();?>members/menus/add" class="btn btn-info pull-right">Add Menu</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
					  	<th>S.N <i class="fa fa-sort"></i></th>
						<th>Item Name <i class="fa fa-sort"></i></th>
                        <th>Price <i class="fa fa-sort"></i></th>
                        <th>Category <i class="fa fa-sort"></i></th>
						<th>Status <i class="fa fa-sort"></i></th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if(count($menus)<1)
					{
						echo '
						<tr>
							<th colspan="6">Sorry ! You donot have any menus yet ! Please create one !</th>
						</tr>';
					}else{
						$count=1;
						foreach($menus as $row):
						?>
                      <tr>
					  	<td><?= $count;?></td>
						<td><?= $row->name;?></td>
                        <td><?= $row->price;?></td>
                        <td><?= $row->category;?></td>
                        <td><?php
						
						$status=$row->status;
						
						switch($status):
							case 1:
								echo "Active";
								break;
							case 0:
								echo "Inactive";
								break;
							default:
								echo "";
								break;
						endswitch;
						
						?></td>
                        <td>
						<a href="<?= base_url();?>members/menus/edit/<?= $row->id;?>" class="fa fa-edit"></a></td>
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