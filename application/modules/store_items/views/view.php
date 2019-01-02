<div class="row">
	<div class="col-md-4" style="margin-top: 25px;">
		<img src="<?= base_url()?>big_pics/<?= $big_pic?>" class="img-responsive" alt="<?= $item_title?>">
	</div>
	<div class="col-md-5" >
		<h1 style="font-weight: bold"><?= $item_title;?></h1>
		<div style="clear: both;"></div>
		<p><?= nl2br($item_description);?></p>
	</div>
	<div class="col-md-3" style="margin-top: 25px;">
		<?= Modules::run('cart/_draw_add_to_cart',$update_id);?>
	</div>
</div>