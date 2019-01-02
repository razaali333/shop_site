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
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Update Account Password</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php $form_location= base_url()."store_accounts/update_pword/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Account Password </label>
							  <div class="controls">
								<input type="password" class="span5" id="typeahead" name="pword" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Confirm Password </label>
							  <div class="controls">
								<input type="password" class="span5" id="typeahead" name="repeat_pword" ">
							  </div>
							</div>
							<div class="control-group">
							 
							<div class="form-actions">
							  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
							  <button type="submit" name="submit" value="Cancel" class="btn">Cancel</button>
							  <a href="<?php echo base_url() ?>store_accounts/manage" class="btn btn-warning pull-right">Back</a>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div> <!-- row end here -->
			
	