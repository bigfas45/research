 <?php
	class Homepage_offers extends MX_Controller 
	{
		function __construct()
		{
			parent::__construct();
		}
		

		function _draw_offers($data)
		{
			// $query = $this->get_where_custom('block_id', $block_id);
			$block_id = $data['block_id'];
			$theme = $data['theme'];
			$item_segments = $data['item_segments'];


			$mysql_query = " 

			SELECT store_items.*
			 FROM homepage_offers INNER JOIN homepage_blocks ON homepage_offers.block_id = homepage_blocks.id INNER JOIN store_items ON homepage_offers.item_id = store_items.id
			 WHERE homepage_offers.block_id=$block_id

			";
			$query = $this->_custom_query($mysql_query);


			$num_rows = $query->num_rows();
			if ($num_rows > 0) {
				$data['query'] = $query;
				$data['theme'] = $theme;
				$data['item_segments'] = $item_segments;
				$this->load->view('offers', $data);
			}
		}

		function _delete_for_item($item_id){
			$mysql_query = "delete from store_items_colors where item_id = $item_id";
			$query = $this->_custom_query($mysql_query);
		}

		function delete($update_id){
            	if (!is_numeric($update_id)) {
					redirect('site_security/not_allowed');
				}
			$this->load->library('session');
			$this->load->module('site_security');
			$this->site_security->_make_sure_is_admin();

			// fetch the item_id
			$query = $this->get_where($update_id);
			foreach ($query->result() as $row) {
				# code...
				$item_id = $row->item_id;
			}
			$this->_delete($update_id);

			$flash_msg = "The optios was successfully deleted";
			$value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
			$this->session->set_flashdata('item', $value); 
			redirect('Store_items_color/update/'.$item_id);

		}


function _is_valid_item($homepage)
{
	// is this valid item id
	if (!is_numeric($homepage)) {
		return FALSE;
	}
	$this->load->module('store_items');
	$query = $this->store_items->get_where($homepage);
	$num_rows = $query->num_rows();
	if ($num_rows>0) {
		return TRUE;
	}else {
		return FALSE;
	}
}


function submit($update_id)
{
 
				if (!is_numeric($update_id)) {
					redirect('site_security/not_allowed');
				}
			$this->load->library('session');
			$this->load->module('site_security');
			$this->site_security->_make_sure_is_admin();

			$submit = $this->input->post('submit', TRUE);
			$homepage  = trim($this->input->post('homepage', TRUE));
			// echo $homepage;die();

			if ($submit == "Finished") {
			redirect('homepage_offers/create/'.$update_id);
			}elseif ($submit == "Submit") {
				$is_valid_item = $this->_is_valid_item($homepage);
				if ($is_valid_item == FALSE) {
				$flash_msg = "The item Id that you submitted was not valid. ";
					$value = '<div class="alert alert-danger" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value); 
						redirect('homepage_offers/update/'.$update_id);
				}
				// attempt an insert
				if ($homepage !="") {
					# code...
					$data['block_id'] = $update_id;
					$data['item_id']  = $homepage;
					$this->_insert($data);
					$flash_msg = "The new homepage options was successfully added";
					$value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
					$this->session->set_flashdata('item', $value); 
				}
			}
			redirect('homepage_offers/update/'.$update_id);
}


function update($update_id) 
			{ 
				if (!is_numeric($update_id)) {
					redirect('site_security/not_allowed');
				}
			$this->load->library('session');
			$this->load->module('site_security');
			$this->site_security->_make_sure_is_admin();

				$update_id = $this->uri->segment(3);

				// fetch existing color options for this 
				$data['query'] = $this->get_where_custom('block_id', $update_id);
				$data['num_rows'] = $data['query']->num_rows();



			  $data['headline'] = "Update homepage Offers";
				$data['update_id'] = $update_id;
				$data['flash'] = $this->session->flashdata('item');
       //$data['view_module'] = "store_items";
				$data['view_file'] = "update";
				$this->load->module('templates');
				$this->templates->admin($data);

		}


function get($order_by)
{
    $this->load->model('mdl_homepage_offers');
    $query = $this->mdl_homepage_offers->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_offers');
    $query = $this->mdl_homepage_offers->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_offers');
    $query = $this->mdl_homepage_offers->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_homepage_offers');
    $query = $this->mdl_homepage_offers->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_homepage_offers');
    $this->mdl_homepage_offers->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_offers');
    $this->mdl_homepage_offers->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_offers');
    $this->mdl_homepage_offers->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_homepage_offers');
    $count = $this->mdl_homepage_offers->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_homepage_offers');
    $max_id = $this->mdl_homepage_offers->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_homepage_offers');
    $query = $this->mdl_homepage_offers->_custom_query($mysql_query);
    return $query;
}


 
  }

	
