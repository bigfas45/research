<style type="text/css">
	.sort{
		list-style: none;
		border: 1px #aaa solid;
		color: #333;
		padding: 10px;
		margin-bottom: 4px;
	}
</style>
<ul>
	<div id="sortlist">
	<?php
     $this->load->module('store_categories');
   	 foreach($query->result() as $row){
  		$num_sub_cats = $this->store_categories->_count_sub_cats($row->id);
  	   $edit_item_url = base_url()."store_categories/create/".$row->id;
  	   $view_item_url = base_url()."store_categories/view/".$row->id;

  	   if ($row->parent_cart_id==0) {
  	   	# code...
  	   	$parent_cart_title = " ";
  	   }else{
  	   $parent_cart_title = $this->store_categories->_get_cat_title($row->parent_cart_id);
          }
  	   ?>
	<li class="sort" id="<?=$row->id?>"><i class="icon-sort"></i><?=$row->cat_tittle;?>
      <?= $parent_cart_title ?>



<?php
	if ($num_sub_cats < 1) {
		echo " ";
	}else{

		if ($num_sub_cats == 1) {
			$entity = "Category";
		}else{
			$entity = "Categories";
		}
		$sub_cat_url = base_url()."store_categories/manage/".$row->id;
      ?>

      <a class="btn btn-default" href="<?= $sub_cat_url;?>">
			<i class="halflings-icon white zoom-in"></i><?php
			echo $num_sub_cats." sub ".$entity;
			?>
		</a>

		<td class="center">
		
		<a class="btn btn-info" href="<?= $edit_item_url;?>">
			<i class="halflings-icon white edit"></i>  
		</a>
		
	</td>
		<?php
	}
	?>



	</li>
	<?php
}
?>
</ul>