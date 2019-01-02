<h1><?php echo $headline; ?></h1>
	<?= validation_errors("<p style='color:red;'>","</p>")?>
	<?php if(isset($flash))
	{
			echo $flash;
	} 
	if(is_numeric($update_id)){?>
		<div class="row-fluid sortable">
				<div class="box span12">
				<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Options</h2>
					<div class="box-icon">
						
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
		
		<a href="<?=base_url()?>store_accounts/update_pword/<?= $update_id?>"><button type="button" class="btn btn-primary">Update Account Password</button></a>
		<a href="<?=base_url()?>store_accounts/deleteconf/<?= $update_id?>"><button type="button" class="btn btn-danger">Delete Account</button></a>   
					</div>
				</div><!--/span-->
</div>
<?php } ?>


<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Details</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php $form_location= base_url()."store_accounts/create/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
			<div class="control-group">
			 <label class="control-label" for="typeahead">First Name </label>
			  <div class="controls">
			   <input type="text" class="span5" id="typeahead" name="firstname" value="<?= $firstname;?>"> 
			  </div> 
			</div>

<div class="control-group"> 
	<label class="control-label" for="typeahead">Last Nname </label>
	 <div class="controls">

	  <input type="text" class="span5" id="typeahead" name="lastname" value="<?= $lastname;?>">
	   </div> </div>

		<div class="control-group">
		 <label class="control-label" for="typeahead">Company </label> 
		 <div class="controls">
		  <input type="text" class="span5" id="typeahead" name="company" value="<?= $company;?>"> 
		</div> </div>

	<div class="control-group">
	 <label class="control-label" for="typeahead">Address1 </label>
  <div class="controls">
   <input type="text" class="span5" id="typeahead" name="address1" value="<?= $address1;?>"> </div> </div>

	<div class="control-group"> 
	<label class="control-label" for="typeahead">Address2 </label>
	 <div class="controls">
	  <input type="text" class="span5" id="typeahead" name="address2" value="<?= $address2;?>"> </div> </div>

	<div class="control-group">
 	<label class="control-label" for="typeahead">Town </label>
  <div class="controls">
   <input type="text" class="span5" id="typeahead" name="town" value="<?= $town;?>"> </div> </div>

	<div class="control-group"> 
	<label class="control-label" for="typeahead">Country </label>
	 <div class="controls">
	  <input type="text" class="span5" id="typeahead" name="country" value="<?= $country;?>"> </div> </div>

	<div class="control-group">
 	<label class="control-label" for="typeahead">Postcode </label>
  <div class="controls">
   <input type="text" class="span5" id="typeahead" name="postcode" value="<?= $postcode;?>"> </div> </div>

	<div class="control-group">
 	<label class="control-label" for="typeahead">Telnum </label>
  <div class="controls">
   <input type="text" class="span5" id="typeahead" name="telnum" value="<?= $telnum;?>"> </div> </div>

	<div class="control-group"> 
	<label class="control-label" for="typeahead">Email </label>
	 <div class="controls">
	  <input type="text" class="span5" id="typeahead" name="email" value="<?= $email;?>"> </div> </div>

			<div class="form-actions">
			  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
			  <button type="reset" class="btn">Reset</button>
			  <a href="<?php echo base_url() ?>store_accounts/manage" class="btn btn-warning pull-right">Back</a>
			</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div> <!-- row end here -->
		