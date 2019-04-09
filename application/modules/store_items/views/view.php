<?php
echo Modules::run('templates/_draw_breadcrumbs', $breadcrumbs_data);
if (isset($flash)) {
	echo $flash;
}
?>

<div class="row">
	<div class="col-md-3" style="margin-top: 24px;">
		<a href="#" data-featherlight="<?= base_url();?>big_pics/<?= $big_pic;?>">
		<img src="<?= base_url();?>big_pics/<?= $big_pic;?>" class="img-responsive" style="margin-top: 24px;">
		</a>
	</div>
	<div class="col-md-5">
		<h1><?= $item_title;?></h1>
		<h2>Our Price<?= number_format($item_price,2) ?></h2>
		<div style="clear: both;">
			<?= nl2br($item_description);?>
		</div>
	</div>
	<div class="col-md-3">
		<?= Modules::run('cart/_draw_add_to_cart', $update_id);?>
	</div>
</div>