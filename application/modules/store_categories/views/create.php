<h1><?= $headline ;?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>
<?php
if (isset($flash)) {
	echo $flash;
}
?>
<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
<?php
if ($big_pic == "") { 
	 $small_pic_path = base_url()."big_pics/".$big_pic;
?> 	
						<a href="<?= base_url() ?>store_categories/upload_image/<?=$update_id;?>">	<button type="button" class="btn btn-primary">Upload Post Image</button></a>
						<?php 
					} else{
						 $small_pic_path = base_url()."big_pics/".$big_pic;
						?>
						<a href="<?= base_url() ?>store_categories/delete_image/<?=$update_id;?>">	<button type="button" class="btn btn-danger"><?= Delete ?></button></a>
			
						<?php
					}
					?>
					</div>
					</div>
					</div>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Items Details</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<?php
						$form_location = base_url()."store_categories/create/".$update_id;

						?>
						<form method="post" class="form-horizontal" action="<?= $form_location;?>" >
						  <fieldset>
						  	<?php
						  	if ($num_dropdown_options>1) {?>
						  		

						  		<div class="control-group">
							  <label class="control-label" for="typeahead">Parent Categories</label>
							  <div class="controls">
                            <?php
                             $additional_dd_code = 'id="selectError3"';
							 echo form_dropdown('parent_cart_id', $options, $parent_cart_id , $additional_dd_code);
							  	?>
								

							  </div>
							</div><?php 
						}    else {
							echo form_hidden('parent_cart_id', 0);

						} 
							?>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Categories Title </label>
							  <div class="controls">
								<input type="text" class="span6" name="cat_tittle" value="<?=$cat_tittle;?>">
							  </div>
							</div>							

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
							  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
							</div>
						  </fieldset>
						</form>   
					
					</div>
				
				<?php if($big_pic !=""){?>
														<div id="image-1" class="masonry-thumb">
								<a  title="Sample Image 1" href=""><img class="grayscale" src="<?=$small_pic_path?>" alt="Sample Image 1"></a>
							</div>
				<?php }?>
				</div><!--/span-->

				

			