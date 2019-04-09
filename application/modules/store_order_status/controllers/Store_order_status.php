 <?php
    class Store_order_status extends MX_Controller 
    { 
        function __construct()
        {
            parent::__construct();

        }

function _get_dropdown_options()
{
    $option['0'] = 'Order Submitted' ;
     $query = $this->get('status_title');
    foreach ($query->result() as $row) {
        $option[$row->id] = $row->status_title;
    }
   
 return $option; 
}

function _get_status_title($update_id)
{
    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $status_title = $row->status_title;
    }
    if (!isset($status_title)) {
       $status_title = 'Unknown';
    }
    return $status_title;
}


function _draw_left_nav_links()
{
    $data['query_lnl'] = $this->get('status_title');
    $this->load->view('left_nav_links',$data);
}


function _make_sure_delete_allowed($update_id)
{
    // returns true of false
    
    // do not allow delete if na order has this status
    $mysql_query = "select * from store_orders where order_status = $update_id";
    $query = $this->_custom_query($mysql_query);
    $num_rows = $query->num_rows();
   
    if ($num_rows > 0) {
         return FALSE; //delete not allwoed since has items in basket

    } else {
       return TRUE;// okay to delete
    } 
    }
 

function fetch_data_from_post()
{
$data['status_title'] = $this->input->post('status_title', TRUE);

    return $data;

}


function fetch_data_from_db($update_id)
{
    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }
    $query = $this->get_where($update_id);
    foreach($query->result() as $row){
$data['status_title'] = $row->status_title;
    }
    if(!isset($data)) {
        $data = "";
    }
    return $data;
}




function _process_delete($update_id)
{

// attemp to delete the page
    $this->_delete($update_id);
}



function delete($update_id){
    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
        // }elseif ($update_id < 3) {prevent them from deleting home and contactus
        redirect('site_security/not_allowed');
        }

        $this->load->library('session');
        $this->load->module('site_security');
        $this->site_security->_make_sure_is_admin();

        $submit = $this->input->post('submit', TRUE);
        if ($submit == "Cancel" ) {
        # code...
        redirect('store_order_status/create/'.$update_id);
        } elseif ($submit == "Yes") {
        $allwoed = $this->_make_sure_delete_allowed($update_id);
        if ($allwoed == FALSE) {
                     $flash_msg = "You are not allwoed to delete this status option since there is at lease on order with this status";
                    $value  = '<div class="alert alert-danger" role="alert">'.$flash_msg.'</div>';
                    $this->session->set_flashdata('account', $value); 
                    redirect('store_accounts/manage');
        }
        $this->_process_delete($update_id);

        $flash_msg = "The Account  was successful deleted";
        $value  = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('account', $value); 
        redirect('store_accounts/manage');

        $flash_msg = "The Account  was successful deleted";
        $value  = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('account', $value); 
        redirect('store_order_status/manage');
    }
}

function deleteconf($update_id){
    if (!is_numeric($update_id)) {
    redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = "Delete Store Order Status";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('account');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);

    // $flash_msg = "The item  was successful deleted";
    // $value  = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    // $this->session->set_flashdata('item', $value); 
    // redirect('store_items/manage');
}


    function create() 
            { 
            $this->load->library('session');
            $this->load->module('site_security');
            $this->site_security->_make_sure_is_admin();

                $update_id = $this->uri->segment(3);
                $submit = $this->input->post('submit',TRUE );
       

       if ($submit == "Cancel") {
         redirect('store_order_status/manage');
       }


       if ($submit == "Submit")
        {
                    # process the form
                    $this->load->library('form_validation');
                   $this->form_validation->set_rules('status_title', 'Status Title', 'required'); 
                    
                    if ($this->form_validation->run() == TRUE) {
                        // get the variables
                        $data = $this->fetch_data_from_post();

                        if (is_numeric($update_id)) {
                            # update the account details
                            
                            $this->_update($update_id, $data);
                            $flash_msg = "The status title was successfully updated";
                            $value  = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                                $this->session->set_flashdata('account', $value); 
                            redirect('store_order_status/create/'.$update_id);

                        }else{
                            // insert a new account
                          
                            $this->_insert($data);
                            $update_id = $this->get_max(); //get id of new account
                            $flash_msg = "The order status  was successfully added";
                            $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                            $this->session->set_flashdata('account', $value); 
                            redirect('store_order_status/create/'.$update_id);
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
                    $data['headline'] = "Add New order status option";
                }else{
                    $data['headline'] = "update order status option";
                }
                $data['update_id'] = $update_id;
                $data['flash'] = $this->session->flashdata('account');
       //$data['view_module'] = "store_order_status";
            $data['view_file'] = "create";
            $this->load->module('templates'); 
            $this->templates->admin($data);

        }
     
    function manage()
        {
            $this->load->module('site_security');
            $this->site_security->_make_sure_is_admin();

        $data['flash'] = $this->session->flashdata('account'); 

      $data['query'] = $this->get('status_title');

      //$data['view_module'] = "store_Account";
            $data['view_file'] = "manage";
            $this->load->module('templates');
            $this->templates->admin($data);

            
}







function get($order_by)
{
    $this->load->model('mdl_store_order_status');
    $query = $this->mdl_store_order_status->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_order_status');
    $query = $this->mdl_store_order_status->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_order_status');
    $query = $this->mdl_store_order_status->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_order_status');
    $query = $this->mdl_store_order_status->get_where_custom($col, $value);
    return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) 
{
    $this->load->model('mdl_store_order_status');
    $query = $this->mdl_store_order_status->get_with_double_condition($col1, $value1, $col2, $value2);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_order_status');
    $this->mdl_store_order_status->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_order_status');
    $this->mdl_store_order_status->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_order_status');
    $this->mdl_store_order_status->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_order_status');
    $count = $this->mdl_store_order_status->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_order_status');
    $max_id = $this->mdl_store_order_status->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_order_status');
    $query = $this->mdl_store_order_status->_custom_query($mysql_query);
    return $query;
}



function autogen()
{
    
    $mysql_query = "show COLUMNS from store_order_status";
    $query = $this->_custom_query($mysql_query);
    /*
    foreach($query->result() as $row){
        $column_name = $row->Field;
        
        if ($column_name != "id") {
   echo '$data[\''.$column_name.'\'] = $this->input->post(\''.$column_name.'\', TRUE);<br>';
        }

    }


echo "<hr>";

      foreach($query->result() as $row){
        $column_name = $row->Field;
        
        if ($column_name != "id") {
   echo '$data[\''.$column_name.'\'] = $row->'.$column_name.';<br>';
        }

    }



echo "<hr>";
*/
      foreach($query->result() as $row){
        $column_name = $row->Field;
        
        if ($column_name != "id") {
    

$var = '<div class="control-group">
<label class="control-label" for="typeahead">'.ucfirst($column_name).' </label>
<div class="controls">
<input type="text" class="span6" name="'.$column_name.'" value="<?= $'.$column_name.';?>">
</div>
</div>';
echo htmlentities($var);
echo "<br>";


        }

    }


     
}




    }