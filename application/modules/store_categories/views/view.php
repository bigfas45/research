<!-- <h1><?= $cat_tittle?></h1>
 --><p><?= $showing_statement;?></p>
<?= $pagination ?>



<div class="row">
<?php
foreach ($query->result() as $row) {
	$item_title = $row->item_title;
	$small_pic = $row->small_pic;
	$item_price = $row->item_price;
	$was_price = $row->was_price;
	$small_pic_path = base_url()."small_pic/".$small_pic;
    $item_page = base_url().$item_segments.$row->item_url;
	?>

	<div class="col-md-2 img-thumbnail" style="margin-bottom: 12px; height: 300px;">
		<a href="<?= $item_page ?>"><img style="width: 200px; height: 200px;" class="img-responsive" src="<?=$small_pic_path;?>" title="<?=$item_title?>" ></a>
		<br>
		<h6><a href="<?= $item_page ?>"><?= $item_title?></a></h6>
		<div style="clear: both; color: red; font-weight: bold;">&pound;<?= number_format($item_price);?>

			<?php if ($was_price >0) { ?>
				
		
			<span style="font-weight: normal; color: #999; text-decoration: line-through;"><?=number_format($was_price)?></span>
			<?php
			}
			?>
			
		</div>
		
	</div>

	<?php
}
?>
</div>
<?= $pagination ?>
