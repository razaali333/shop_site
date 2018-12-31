<h1><?php echo $headline; ?></h1>
	<?= validation_errors("<p style='color:red;'>","</p>")?>
	<?php if(isset($flash))
	{
			echo $flash;
	} 
	 ?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>New color Options</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<p>Submit New options are required. When you are finished adding new options Press 'Finished'</p>
						<?php $form_location= base_url()."store_item_color/submit/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">New Options </label>
							  <div class="controls">
								<input type="text" class="span5" id="typeahead" name="color">
							  </div>
							</div>
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
							  <button type="submit" class="btn" name="submit" value="Finished">Finished</button>
							  <a href="<?php echo base_url() ?>store_items/manage" class="btn btn-warning pull-right">Back</a>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div> <!-- row end here -->
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white tag"></i><span class="break"></span>Existing color Option</h2>
						<div class="box-icon">
							 
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Items Title</th>
								  <th>Price</th>
								  <th>Was Price</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php foreach($query->result() as $row){ 
									$edit_item_url=base_url()."store_items/create/".$row->id;
									$status=$row->status;
									if($status==1)
									{
										$status_label="success";
										$status_disc="Active";
									}
									else{
										$status_label="default";
										$status_disc="Inactive";
									}
								?>
							<tr> 
								<td><?php echo $row->item_title ?></td>
								<td class="center"><?php echo $row->item_price ?></td>
								<td class="center"><?php echo $row->was_price ?></td>
								<td class="center">
									<span class="label label-<?= $status_label?>"><?= $status_disc?></span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?php echo $edit_item_url; ?>">
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

		
