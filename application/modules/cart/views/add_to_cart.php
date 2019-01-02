<div style="background: #ddd; border-radius: 7px;padding: 3px;">
	<table class="table">
		<div class="row">
			<div class="col-md-4">
				<tr>
			<td colspan="2">Item ID: <span style="color: green;font-weight: bold"><?= $item_id?></span></td>
		</tr>
			</div>
			<div class="col-md-3">
				<?php if($num_colors>0){?>
				<tr>
			
			<td>Color:</td>
			<td><div class="col-sm-9" style="padding-left: 0px;">
				<?php 
									
				$dropdown_id=
				array(

							'id'       => 'selectError',
							'class' => 'form-control input-sm'
						);
				
			echo form_dropdown('status', $color_options, $submitted_color,$dropdown_id);

				 ?>
				</div>
			</td>
		</tr>

			</div>
		<?php } ?>
		<?php if($num_sizes>0){?>
			<div class="col-md-3">
				<tr>
			<td>Sizes:</td>
			<td>
				<div class="col-sm-9" style="padding-left: 0px;">
				<?php 
									
				$dropdown_id=
				array(

							'id'       => 'selectError',
							'class' => 'form-control input-sm'
						);
				
			echo form_dropdown('status', $size_options, $submitted_size,$dropdown_id);

				 ?>
				</div>
			</td>
		</tr>
			</div>
		<?php } ?>
			<div class="col-md-2">
				<tr>
			<td>Qty:</td>
			<td><div class="col-sm-6" style="padding-left: 0px;"><input type="search" class="form-control input-sm" ></div></td>
		</tr>
			</div>
			
		</div>
		<tr>
			<td colspan="2" style="text-align: center;">
				<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span> ADD TO BASKET </button>
			</td>
				
		</tr>
	</table>
</div>