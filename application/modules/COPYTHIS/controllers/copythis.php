 <?php
	class Copythis extends MX_Controller 
	{ 
		function __construct()
		{
			parent::__construct();

		}



function test(){
  echo "string";
}





function get($order_by)
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_items');
    $count = $this->mdl_store_items->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_items');
    $max_id = $this->mdl_store_items->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->_custom_query($mysql_query);
    return $query;
}


  function item_check($str)
  {
  	$item_url = url_title($str);
  	$mysql_query ="select * from store_items where item_title='$str' and item_url = '$item_url' ";

  	$update_id = $this->uri->segment(3);
  	if (is_numeric(($update_id))) {
  		# this is an update...
          $mysql_query.=" and id!=$update_id";
  	}

  	$query = $this->_custom_query($mysql_query);
  	$num_rows = $query->num_rows()
;


          if ($num_rows>0)
          {
                  $this->form_validation->set_message('item_check', 'The item title that you sunmitted is not available');
                  return FALSE;
          }
          else
          {
                  return TRUE;
          }
  }

	}