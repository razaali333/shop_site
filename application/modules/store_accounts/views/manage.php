<h1>Manage Accounts</h1>

  <?php 
      $create_account_url = base_url().'store_accounts/create';
  ?>
  <?php if(isset($flash))
	{
			echo $flash;
	} 
	?>
   <p><a href="<?= $create_account_url; ?>"><button type="button" class="btn btn-primary">Add New Account</button></a></p>

<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white briefcase"></i><span class="break"></span>Customer Account</h2>
						<div class="box-icon">
							 
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Company</th>
								  <th>Date Created</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$this->load->module('timedate');
							 foreach($query->result() as $row){ 
									$edit_Account_url=base_url()."store_accounts/create/".$row->id;
									$date_created=$this->timedate->get_nice_date($row->date_made,'cool');
									
								?>
							<tr> 
								<td><?php echo $row->firstname ?></td>
								<td class="center"><?php echo $row->lastname ?></td>
								<td class="center"><?php echo $row->company ?></td>
								<td class="center">
									<?= $date_created?>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="<?php echo $edit_Account_url; ?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									<!-- <a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
 -->									</a>
								</td>
							</tr>
							<?php } ?>
							
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->