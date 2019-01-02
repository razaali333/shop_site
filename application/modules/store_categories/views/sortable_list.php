<style>
	.sort{
		list-style: none;
		border: 1px #aaa solid;
		color: #333;
		padding: 10px;
		margin-bottom: 4px;
	}
</style>
<ul id="sortlist">
	<?php
								$this->load->module('store_categories');
							 foreach($query->result() as $row){ 
							 	$num_sub_cats=$this->store_categories->_count_sub_cats($row->id);
									$edit_item_url=base_url()."store_items/create/".$row->id;
									if($row->parent_cat_id==0)
									{
										$parent_cat_title="&nbsp";
									}
									else
									{
									$parent_cat_title=$this->store_categories->_get_cat_title($row->parent_cat_id);

									}
									?>
			<li class="sort" id="<?php echo $row->id ?>"><i class="fa icon-sort"></i><?php echo $row->cat_title; ?>
				<?php echo $parent_cat_title;


									
										if($num_sub_cats<1)
									{
										echo "&nbsp";	
									
									} else{
										if($num_sub_cats==1)
										{
											$entity="Category";
										}
										else{
											$entity="Categories";
										}
										$sub_cat_url=base_url()."store_categories/manage/".$row->id;
									?>
								<a class="btn btn-default" href="<?php echo $sub_cat_url; ?>">
										<i class="halflings-icon white zoom-in"></i> 
										<?php echo $num_sub_cats." Sub ".$entity; ?> 
									</a>
									<a class="btn btn-info" href="<?php echo $edit_item_url; ?>">
										<i class="halflings-icon white edit"></i>  
									</a>			
										<?php 
										 
										
									}?>
				 
			</li>
<?php } ?>
</ul>