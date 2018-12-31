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
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
					<div class="box-icon">
						
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php if($big_pic==""){ ?>
						<a href="<?=base_url()?>store_items/upload_image/<?= $update_id?>"><button type="button" class="btn btn-primary">Upload Item Image</button></a> 
						<?php }
						else{ ?>
						  <a href="<?=base_url()?>store_items/delete_image/<?= $update_id?>"><button type="button" class="btn btn-warning">Delete Item Image</button></a> 
						<?php } ?>
						<a href="<?=base_url()?>store_item_color/update/<?= $update_id?>"><button type="button" class="btn btn-primary">Update Item Color</button></a>   
						<a href="<?=base_url()?>store_item_sizes/update/<?=$update_id ?>"><button type="button" class="btn btn-primary">Update Item Sizes</button></a>   
						<a href="<?=base_url()?>store_items/"><button type="button" class="btn btn-primary">Update Item categories</button></a>   
						<a href="<?=base_url()?>store_items/"><button type="button" class="btn btn-danger">Delete Item</button></a>   

					</div>
				</div><!--/span-->
</div>
<?php } ?>


<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Add Item</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php $form_location= base_url()."store_items/create/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Item Title </label>
							  <div class="controls">
								<input type="text" class="span5" id="typeahead" name="item_title" value="<?= $item_title;?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Item Price </label>
							  <div class="controls">
								<input type="text" class="span1" id="typeahead" name="item_price" value="<?= $item_price;?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Was Price <span style="color: green;font-weight: bold;">(optional)</span> </label>
							  <div class="controls">
								<input type="text" class="span1" id="typeahead" name="was_price" value="<?= $was_price;?>">
							  </div>
							</div>

							<div class="control-group">
								<label class="control-label" for="selectError">Status</label>
								<div class="controls">
									<?php 
									
								$dropdown_id=
								array(

											'id'       => 'selectError',
        									'data-rel' => 'chosen'
										);
									
								$options = array(
									''			=>'Please Select...',
							        '1'         => 'Active',
							        '0'         => 'Inactive',
							);

							$shirts_on_sale = array('small', 'large');
							echo form_dropdown('status', $options, $status,$dropdown_id);

								 ?>
								
								</div>
							  </div>

							         
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Item Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="item_description">
									<?php echo $item_description; ?>
								</textarea>
							  </div>
							</div>
							<div class="form-actions">
							  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
							  <button type="reset" class="btn">Reset</button>
							  <a href="<?php echo base_url() ?>store_items/manage" class="btn btn-warning pull-right">Back</a>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div> <!-- row end here -->
			
		<?php if(isset($big_pic)!=""){ ?>
		<div class="row-fluid sortable">
				<div class="box span12">
				<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Image</h2>
					<div class="box-icon">
						
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<img src="<?= base_url()?>big_pics/<?=$big_pic?>" alt="">

					</div>
				</div><!--/span-->
</div>
<?php } ?>