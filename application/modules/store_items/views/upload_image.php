<h1><?= $headline?></h1>
<div class="row-fluid sortable">
				<div class="box span12">
				<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Form Elements</h2>
					<div class="box-icon">
						
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php 
						if(isset($error))
						{

							foreach ($error as $value) {
								echo $value;
								}	
						}
						 ?>

					 <?php 
					 	$attributes=array('class'=>'form-horizontal');
					     echo form_open_multipart('store_items/do_upload/'.$update_id,$attributes); ?>
						<p>Please choose a file from your computer and then press 'Upload'.</p>
						  <fieldset>
							
							<div class="control-group" style="height: 240px;">
							  <label class="control-label" for="fileInput">File input</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" name="userfile" size="20" type="file">
							  </div>
							</div>          
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Upload</button>
							  <button type="submit" class="btn btn-default" name="submit" value="Cancel">Cancel</button>
							</div>
						  </fieldset>
						</form>   








						<!--  <?php //echo form_open_multipart('store_items/do_upload/'.$update_id); ?>
						 <input type="file" name="userfile" size="20">
						 <br> <br>
						 <input type="submit" value="Upload">
						 <?php //echo form_close(); ?>
					</div>  -->
				</div><!--/span-->
	
</div>