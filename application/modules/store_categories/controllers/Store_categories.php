 <?php
	class Store_categories extends MX_Controller 
	{
		function __construct()
		{
			parent::__construct();
		}

// function fix()
// {
// $query = $this->get('id');
// foreach ($query->result() as $row) {
// 	$data['cat_url'] = url_title($row->cat_tittle);
// 	$this->_update($row->id, $data);
// }
// echo "all finished";

// }


function delete_image($update_id)
{
	if (!is_numeric($update_id)) {
			redirect('site_security/not_allowed');
		}

		$this->load->library('session');
	$this->load->module('site_security');
	$this->site_security->_make_sure_is_admin();

	$data = $this->fetch_data_from_db($update_id);
	$big_pic = $data['big_pic'];
	$small_pic = $data['small_pic'];

	$big_pic_path =  './big_pics/'.$big_pic;
	$small_pic_path =  './small_pic/'.$small_pic;
	// remove the images
	if (file_exists($big_pic_path)) {
	unlink($big_pic_path);
	}
		if (file_exists($small_pic_path)) {
	unlink($small_pic_path);
	}
	// update the database
	unset($data);
	$data['big_pic'] ="";
	$data['small_pic'] ="";
	$this->_update($update_id,$data);

		$flash_msg = "The item image was successful deleted";
		$value  = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
			$this->session->set_flashdata('item', $value); 
					redirect('store_categories/create/'.$update_id);


}



function _generate_thumnail($file_name){
$config['image_library'] = 'gd2';
$config['source_image'] = './big_pics/'.$file_name;
$config['new_image'] = './small_pic/'.$file_name;

$config['maintain_ratio'] = TRUE;
$config['width']         = 200;
$config['height']       = 200;

$this->load->library('image_lib', $config);

$this->image_lib->resize();
}


function do_upload($update_id)
{
	if (!is_numeric($update_id)) {
			redirect('site_security/not_allowed');
		}

		$this->load->library('session');
	$this->load->module('site_security');
	$this->site_security->_make_sure_is_admin();

	$submit = $this->input->post('submit',TRUE);
	if($submit=="Cancel"){
		redirect('store_categories/create/'.$update_id);
	}

	$config['upload_path']          = './big_pics/';
  $config['allowed_types']        = 'gif|jpg|png|jpeg';
  $config['max_size']             = 10000;
  $config['max_width']            = 10240;
  $config['max_height']           = 7680;

  $this->load->library('upload', $config);

  if (!$this->upload->do_upload('userfile'))
  {
$data['error'] = array('error' => $this->upload->display_errors("<p style='color: red;'>", "</p>"));
$data['headline'] = "Upload Error";
$data['update_id'] = $update_id;
$data['flash'] = $this->session->flashdata('item');
$data['view_file'] = "upload_image";
$this->load->module('templates');
$this->templates->admin($data);
}


else
{ 
// upload was successful
$data = array('upload_data' => $this->upload->data());
$upload_data = $data['upload_data'];
$file_name = $upload_data['file_name'];
$this->_generate_thumnail($file_name);
// update db
$update_data['big_pic'] = $file_name;
$update_data['small_pic'] = $file_name;
$this->_update($update_id, $update_data);

$data['headline'] = "Upload Success";
$data['update_id'] = $update_id;
$data['flash'] = $this->session->flashdata('item');
$data['view_file'] = "upload_success";
$this->load->module('templates');
$this->templates->admin($data);
  }
}


	function upload_image($update_id) 
	{ 
		if (!is_numeric($update_id)) {
			redirect('site_security/not_allowed');
		}
	$this->load->library('session');
	$this->load->module('site_security');
	$this->site_security->_make_sure_is_admin();

		$update_id = $this->uri->segment(3);

	  $data['headline'] = "Upload Image";
		$data['update_id'] = $update_id;
		$data['flash'] = $this->session->flashdata('item');
//$data['view_module'] = "store_items";
		$data['view_file'] = "upload_image";
		$this->load->module('templates');
		$this->templates->admin($data);

}









		function _get_full_cat_url($update_id)
		{
			$this->load->module('site_settings');
			$items_segments = $this->site_settings->_get_items_segments();
			$data = $this->fetch_data_from_db($update_id);
			
			if (!isset($cat_url)) {
				$cat_url = '';
			} else{
				$cat_url = $data['cat_url'];
			}
			
 
			$full_cat_url = base_url().$items_segments.$cat_url;
			return $full_cat_url;
		}
    




		function get_oldest_user($target_array)
		{
           foreach ($target_array as $key => $value) {
           	if (!isset($key_with_highest_value)) {
           		$key_with_highest_value = $key;
           	}elseif ($value > $target_array[$key_with_highest_value]) {
           		$key_with_highest_value = $key;
           	}
           }
           return $key_with_highest_value; 
		}


		function test()
		{
			$users['han'] = 42;
			$users['luke'] = 42;
			$user['yoda'] = 900;
			$user['chewie'] = 200;
			$users['zebadee'] =12;

			echo "<h1> Who is the oldest ";
			$oldest_user = $this->get_oldest_user($user);
			echo $oldest_user;
		}
		
 function view($update_id){
       if (!is_numeric($update_id)) {
					redirect('site_security/not_allowed');
				}
				$this->load->module('site_settings');
				$this->load->module('custom_pagination');

				// fetch the item from db
				$data = $this->fetch_data_from_db($update_id);
                 
				// count the item that belongs to the categories
				$use_limit = FALSE;
				$mysql_query = $this->_generate_mysql_query($update_id, $use_limit);
				$query = $this->_custom_query($mysql_query);
				$total_items = $query->num_rows();
				

				// fetch the items for this page
				$use_limit = TRUE;
				$mysql_query = $this->_generate_mysql_query($update_id, $use_limit);

				$pagination_data['template'] = "public_bootstrap";
				$pagination_data['target_base_url'] = $this->get_target_pagination_base_url();
				$pagination_data['total_rows'] = $total_items;
				$pagination_data['offset_segment'] = 4;
				$pagination_data['limit'] = $this->get_limit();
				
				$data['pagination'] = $this->custom_pagination->_generate_pagination(
					$pagination_data);
				$pagination_data['offset'] = $this->get_offset();
				$data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);
				 $data['item_segments'] = $this->site_settings->_get_item_segments();
				$data['query'] = $this->_custom_query($mysql_query);
				$data['update_id'] = $update_id;
				$data['flash'] = $this->session->flashdata('item');
				$data['view_module'] = "store_categories";
				$data['view_file'] = "view";
				$this->load->module('templates');
				$this->templates->public_bootstrap($data);

       }

       function get_target_pagination_base_url()
       {
       	$first_bit = $this->uri->segment(1);
       	$second_bit = $this->uri->segment(2);
       	$third_bit = $this->uri->segment(3);
       	$target_base_url = base_url().$first_bit."/".$second_bit."/".$third_bit;
       	return $target_base_url;
       }

       function _generate_mysql_query($update_id, $use_limit)
       {
       	//NOTE: use limit can be TRUE OR FALSE
       	$mysql_query = "

				SELECT store_items.item_title,
				       store_items.item_url,
				       store_items.item_price,
				       store_items.small_pic,
				       store_items.was_price
				FROM store_cat_assign INNER JOIN store_items ON store_cat_assign.item_id = store_items.id WHERE store_cat_assign.cat_id=$update_id and store_items.status=1


				";

				if ($use_limit == TRUE) {
					$limit = $this->get_limit();
					$offset = $this->get_offset();
					$mysql_query .= " limit ".$offset.", ".$limit;
				}
				return $mysql_query;
       }

function get_limit()
{
	$limit = 5;
	return $limit;
}

function get_offset()
{
	$offset = $this->uri->segment(4);
	if (!is_numeric($offset)) {
		$offset = 0;
	}
	return $offset;
}

   function _get_cat_id_from_cat_url($cat_url)
   {
   	$query = $this->get_where_custom('cat_url', $cat_url);
   	foreach ($query->result() as $row) {
   		# code...
   		$cat_id = $row->id;
   	}
   	if (!isset($cat_id)) {
   		$cat_id =0;
   	}
   	return $cat_id;
   }


function _draw_top_nav()
{
		$mysql_query = "select * from store_categories where parent_cart_id =0 order by priority";
		$query = $this->_custom_query($mysql_query);
		foreach ($query->result() as $row) {
			# code...
			$parent_categories[$row->id] = $row->cat_tittle;
		}
		$this->load->module('site_settings');
		$items_segments = $this->site_settings->_get_items_segments();
		$data['target_url_start'] = base_url().$items_segments;
		$data['parent_categories'] = $parent_categories;
		$this->load->view('top_nav', $data);

}

function _get_parent_cat_title($update_id)
{
	$data = $this->fetch_data_from_db($update_id);
	$parent_cart_id = $data['parent_cart_id'];
	$parent_cat_title = $this->_get_cat_title($parent_cart_id);
	return $parent_cat_title;
}

function _get_all_sub_cats_for_dropdown()
{
	// Note: This get used on store_cat_assign
	$mysql_query = "select * from store_categories where parent_cart_id!=0 order by parent_cart_id, cat_tittle";
	$query = $this->_custom_query($mysql_query);
	foreach ($query->result() as $row) {
		# code...
		$parent_cat_title = $this->_get_cat_title($row->parent_cart_id);
		$sub_categories[$row->id] = $parent_cat_title." > ". $row->cat_tittle;
	}
	if (!isset($sub_categories)) {
		# code...
		$sub_categories = "";
	}
	return $sub_categories;

}


function sort(){
		$this->load->module('site_security');
	    $this->site_security->_make_sure_is_admin();

	    $number = $this->input->post('number', TRUE);
	    for ($i=1; $i <= $number; $i++) { 
	    	$update_id = $_POST['order'.$i];
	    	$data['priority'] =$i;
	    	$this->_update($update_id, $data);
	    }
}

function _draw_sortable_list($parent_cart_id)
{
	$mysql_query = "select * from store_categories where parent_cart_id = $parent_cart_id order by priority";
	$data['query'] = $this->_custom_query($mysql_query);
      $this->load->view('sortable_list', $data);
 
}


function _count_sub_cats($update_id)
{
	// return thye number of sub categories belonging to this categories
	$query = $this->get_where_custom('parent_cart_id', $update_id);
	$num_rows = $query->num_rows();
	return $num_rows;
}



function _get_cat_title($update_id)
{
   $data = $this->fetch_data_from_db($update_id);
   $cat_tittle = $data['cat_tittle'];
   return $cat_tittle;
}


function _get_dropdown_options($update_id)
{
	if (!is_numeric($update_id)) {
		$update_id =0;
	}
	$options['']=  "Please Select.....";

	// build an arrya of all the parent categories
	$mysql_query = "select * from store_categories where parent_cart_id=0 and id != $update_id";
	$query = $this->_custom_query($mysql_query);

	foreach ($query->result() as $row) {
		# code...
		$options[$row->id] = $row->cat_tittle;
	}
	return $options;
}



function fetch_data_from_post()
{
	$data['cat_tittle'] = $this->input->post('cat_tittle', TRUE);
	$data['parent_cart_id'] = $this->input->post('parent_cart_id', TRUE);	
	return $data;

}

function fetch_data_from_db($update_id)
{
	if (!is_numeric($update_id)) {
		redirect('site_security/not_allowed');
	}
    $query = $this->get_where($update_id);
    foreach($query->result() as $row){
    	$data['cat_tittle'] = $row->cat_tittle;
    	    	$data['cat_url'] = $row->cat_url;

		$data['parent_cart_id'] = $row->parent_cart_id;
		$data['big_pic'] = $row->big_pic;
    	$data['small_pic'] = $row->small_pic;
    }
    if(!isset($data)) {
    	$data = "";
    }
    return $data;
}




			function create() 
			{ 
			$this->load->library('session');
			$this->load->module('site_security');
			$this->site_security->_make_sure_is_admin();

				$update_id = $this->uri->segment(3);
				$submit = $this->input->post('submit',TRUE );
       

       if ($submit == "Cancel") {
       	 redirect('store_categories/manage');
       }


       if ($submit == "Submit")
        {
					# process the form
					$this->load->library('form_validation');
					$this->form_validation->set_rules('cat_tittle', 'Categories Title', 'required|max_length[240]');
				
					if ($this->form_validation->run() == TRUE) {
						// get the variables
						$data = $this->fetch_data_from_post();
		                $data['cat_url'] = url_title($data['cat_tittle']);


						if (is_numeric($update_id)) {
							# update the categories details
							$this->_update($update_id, $data);
							$flash_msg = "The categories details was successfully updated";
							$value  = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
								$this->session->set_flashdata('categories', $value); 
							redirect('store_categories/create/'.$update_id);

						}else{
							// insert a new categories
							$this->_insert($data);
							$update_id = $this->get_max(); //get id of new categories
							$flash_msg = "The categories  was successfully added";
							$value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
							$this->session->set_flashdata('categories', $value); 
							redirect('store_categories/create/'.$update_id);
						}
						
					} 
				}

				if ((is_numeric($update_id)) && ($submit != "Submit"))
				{
					# code...
					$data = $this->fetch_data_from_db($update_id);
				} else{
					$data = $this->fetch_data_from_post();
				}
				if (!is_numeric($update_id))  {
					$data['headline'] = "Add New categories";
				}else{
					$data['headline'] = "update categories Details";
				}
				$data['options'] = $this->_get_dropdown_options($update_id);
                $data['num_dropdown_options'] = count($data['options']);
                

				$data['update_id'] = $update_id;
				$data['flash'] = $this->session->flashdata('cat');
				$data['view_file'] = "create";
				$this->load->module('templates'); 
				$this->templates->admin($data);

		}



		function manage()
		{
			$this->load->module('site_security');
			$this->site_security->_make_sure_is_admin();

			$parent_cart_id = $this->uri->segment(3);
			if (!is_numeric($parent_cart_id)) {
				$parent_cart_id =0;
			}
            $data['sort_this'] = TRUE;
            $data['parent_cart_id'] = $parent_cart_id;
		    $data['flash'] = $this->session->flashdata('item'); 
            $data['query'] = $this->get_where_custom('parent_cart_id', $parent_cart_id);
			$data['view_file'] = "manage";
			$this->load->module('templates');
			$this->templates->admin($data);

            
}


function get($order_by)
{
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_categories');
    $count = $this->mdl_store_categories->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_categories');
    $max_id = $this->mdl_store_categories->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->_custom_query($mysql_query);
    return $query;
}
	
	}