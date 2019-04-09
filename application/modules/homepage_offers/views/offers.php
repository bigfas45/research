<?php
foreach ($query->result() as $row) {
	$item_title = $row->item_title;
	$small_pic = $row->small_pic;
	$item_price = number_format($row->item_price,2);
	$was_price = $row->was_price;
	$small_pic_path = base_url()."small_pic/".$small_pic;
    $item_page = base_url().$item_segments.$row->item_url;
    $item_price = str_replace('.00', '', $item_price);
	?>

      <div class="col-md-3">
        <div class="offer offer-<?=$theme;?>" style="min-height: 400px;">
          <div class="shape">
            <div class="shape-text">
            <span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 1.4em;"></span>       
            </div>
          </div>
          <div class="offer-content">
            <h3 class="lead">
            	Our Price<br>
           <?=$item_price;?>
            </h3>   
		<a href="<?= $item_page ?>"><img style="width: 200px; height: 200px;" class="img-responsive" src="<?=$small_pic_path;?>" title="<?=$item_title?>" ></a>

            <p>
            <a href="<?= $item_page ?>"><?=$item_title;?></a> 
              
            </p>
          </div>
        </div>
      </div>
      <?php
}
?> 