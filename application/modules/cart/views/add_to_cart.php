<div style="background-color:#ddd; border-radius: 7px; margin-top: 24px; padding: 7px">
	<?php
	echo form_open('store_basket/add_to_basket');
	?>
	<table class="table">
		<tr>
			
			<td colspan="2">Item ID: <?=$item_id?></td>
		</tr>
		<tr>
			
			<td colspan="2">Item Price: <?=$item_price?></td>
		</tr>
		<?php
		if ($num_colors >0) {?>
			
		
		<tr>
			<td>Color: </td>
			<td>
	<?php
			 $additional_dd_code = 'class="form-control"';
			 echo form_dropdown('item_color', $color_options, $submitted_color, $additional_dd_code);
		?>
			</td>
		</tr>
		<?php
	}
	?>



	<?php
		if ($num_sizes >0) {?>
			
		
		<tr>
			<td>Sizes: </td>
			<td>
	<?php
			 $additional_dd_code = 'class="form-control"';
			 echo form_dropdown('item_size', $sizes_options, $submitted_sizes, $additional_dd_code);

			  	?>
			</td>
		</tr>
		<?php
	}
	?>


		<tr>
			<td>Qty: </td>
			<td>
				<div class="col-sm-4" style="padding-left: 0px;">
					<input type="tetx" name="item_qty" class="form-control" id="" name=""">
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<button class="btn btn-primary" name="submit" value="Submit" type="submit"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> Add To Basket</span></button>
			</td>
		</tr>
	</table>
	<?php
	echo form_hidden('item_id', $item_id);
	echo form_close();
	?>
</div>