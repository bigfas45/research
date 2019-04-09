<h1>Manage Items</h1>
<?php
if (isset($flash)) {
	echo $flash;
}
?>
	<?php
	$create_item_url = base_url()."store_items/create";
	?><p style="margin-top: 30px;">
	 <a href="<?= $create_item_url;?>"><button type="submit" class="btn btn-primary">Add New Item</button></a> 
</p>
<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Items Inventory</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
	<div class="box-content">
						<table class="table table-striped table-bordered">
						  <thead>
							  <tr>
								  <th>Picture</th>
								  <th>Date Published</th>
								  <th>Author</th>
								  <th>Blog URL</th>
								  <th>Blog Title</th>
								  <th>Staus</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  	<?php
						  	foreach($query->result() as $row){
								$this->load->module('timedate');
						  	   $edit_item_url = base_url()."store_items/create/".$row->id;
						  	   $status = $row->status;

						  	   if ($status == 1) {
						  	   	# code...
						  	   	$status_label = "success";
						  	   	$status_desc = "Active";
						  	   }else{
						  	   	$status_label = "default";
						  	   	$status_desc  ="Inactive";
								 }
								 $view_page_url = base_url().$row->itme_url;
								 $date_published = $this->timedate->get_nice_date($row->date_published, 'mini');
								 $picture = $row->small_pic;
								 $thumbnail_name = str_replace('.', '_thumb.', $picture);
								 $thumbnail_path = base_url().'small_pic/'.$picture;
						  	   ?>
							<tr>
							<td><img height="20%"; width="100px"; src="<?=$thumbnail_path;?>"></td>
							<td><?= $date_published;?> </td>
							<td><?= $row->author;?></td>
							<td><?=$view_page_url?></td>
							<td><?=$row->item_title?></td>
								<td class="center">
									<span class="label label-<?=$status_label;?>"><?=$status_desc;?></span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a class="btn btn-info" href="<?= $edit_item_url;?>">
										<i class="halflings-icon white edit"></i>  
									</a>
									
								</td>
							</tr>
							<?php
						}
						?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->