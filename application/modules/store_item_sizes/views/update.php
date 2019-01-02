<h1><?php echo $headline; ?></h1>
	<?= validation_errors("<p style='sizes:red;'>","</p>")?>
	<?php if(isset($flash))
	{
			echo $flash;
	} 
	 ?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>New sizes Options</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<p>Submit New options are required. When you are finished adding new options Press 'Finished'</p>
						<?php $form_location= base_url()."store_item_sizes/submit/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">New Options </label>
							  <div class="controls">
								<input type="text" class="span5" id="typeahead" name="sizes">
							  </div>
							</div>
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
							  <button type="submit" class="btn" name="submit" value="Finished">Finished</button>
							  <a href="<?php echo base_url() ?>store_items/create//<?=$update_id;?>" class="btn btn-warning pull-right">Back</a>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div> <!-- row end here -->

		<?php if($num_rows>0){ ?>
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
								  <th>Count</th>
								  <th>Color</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php 
								$count=0;
							foreach($query->result() as $row){ 
									$count++;
									$delete_url=base_url()."store_item_sizes/delete/".$row->id;
								?>
							<tr> 
								<td><?php echo $count ?></td>
								<td class="center"><?php echo $row->size ?></td>
								<td class="center">
									<a href="<?php echo $delete_url; ?>" class="btn btn-danger">
										<i class="halflings-icon white trash"></i>
									</a>
								</td>
								
							</tr>
							<?php } ?>
							
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php } ?>
		

