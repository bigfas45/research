 <?php
	class Cart extends MX_Controller 
	{
		function __construct()
		{
			parent::__construct();
	  
}

function _calc_cart_total($cart_data)
{
	$shopper_id = $cart_data['shopper_id'];
	$customer_session_id = $cart_data['customer_session_id'];
	$table = $cart_data['table'];
	$add_shipping = $cart_data['add_shipping'];

	$query = $this->_fetch_cart_contents($customer_session_id, $shopper_id, $table);
	$grand_total =0;
	foreach ($query->result() as $row) { 
		 $sub_total = $row->price*$row->item_qty;
		 $sub_total_desc = number_format($sub_total,2);
		 $grand_total +=$sub_total;
		}

		if ($add_shipping == TRUE) {
			$this->Load->module('shipping');
			$shipping = $this->shipping->_get_shipping();
		}else {
			$shipping =0;
		}
		$grand_total = $grand_total + $shipping;
		return $grand_total;
}


	function _check_and_get_session_id($checkout_token)
	{
      $session_id = $this->_get_session_id_from_token($checkout_token);

     if ($session_id=='') {
     	redirect(base_url());
     }
     // check to see if this session id appears on store_basket table
     $this->load->module('store_basket');
     $query = $this->store_basket->get_where_custom('session_id', $session_id);
     $num_rows = $query->num_rows();

     if ($num_rows < 1) {
     	redirect(base_url());
     }

     return $session_id;

	}


function _create_checkout_token($session_id)
{
  $this->load->module('site_security');
  $encrypted_string = $this->site_security->_encrypt_string($session_id);
  // remove dddy characters
  $checkout_token = str_replace('+','-plus-', $encrypted_string);
  $checkout_token = str_replace('/','-fwrd-', $checkout_token);
  $checkout_token = str_replace('=','-eqls-', $checkout_token);
 return $checkout_token;
}

function _get_session_id_from_token($checkout_token)
{
  $this->load->module('site_security');
  // remove dddy characters
  $session_id = str_replace('-plus-','+', $checkout_token);
  $session_id = str_replace('-fwrd-','/', $session_id);
  $session_id = str_replace('-eqls-','=', $session_id);

  $session_id = $this->site_security->_decrypt_string($session_id);
 return $session_id;
}


function test()
{
	$string = "Hello blue sky";
	$this->load->module('site_security');
	$encrypted_string = $this->site_security->_encrypt_string($string);
    $decrypted_string = $this->site_security->_decrypt_string($encrypted_string);

    echo "string is $string<hr>";
    echo "encrypted string is $encrypted_string<hr>";
    echo "decrypted string is $decrypted_string<hr>";

}


function test2()
{
	$this->load->module('site_security');
	$string = "Hello blue sky";

	$third_bit = $this->uri->segment(3);
	if ($third_bit!='') {
		$encrypted_string = $third_bit;
	}else{
		$encrypted_string = $this->site_security->_encrypt_string($string);
	}

	
	$encrypted_string = $this->site_security->_encrypt_string($string);
    $decrypted_string = $this->site_security->_decrypt_string($encrypted_string);

    echo "string is $string<hr>";
    echo "encrypted string is $encrypted_string<hr>";
    echo "decrypted string is $decrypted_string<hr>";

    // create a new encrypted string
    $new_encrypted_string = $this->site_security->_encrypt_string($string);
    echo anchor('cart/test2'.$new_encrypted_string,'refresh');




}


function _generate_guest_account($checkout_token)
{
  // customer has selected no thanks
	$this->load->module('site_security');	
	$this->load->module('store_accounts');
	$customer_session_id = $this->_get_session_id_from_token($checkout_token);

	// create guest account
	$ref = $this->site_security->generate_random_string(4);
	$data['username'] = 'Guest'.$ref;
	$data['firstname'] = 'Guest';
	$data['lastname'] = 'Account';
	$data['date_made'] = time();
	$data['pword'] = $checkout_token; // lock the hackers out
	$this->store_accounts->_insert($data);
    
    // get the new account
	$new_account_id = $this->store_accounts->get_max();

	// update the existing store_basket table
	$mysql_query = "update store_basket set shopper_id = $new_account_id where session_id = '$customer_session_id'";
	$query = $this->store_accounts->_custom_query($mysql_query);


}

function submit_choice()
{
	$submit = $this->input->post('submit', TRUE);
	if ($submit== "No") {
			$checkout_token = $this->input->post('checkout_token', TRUE);
			$this->_generate_guest_account($checkout_token);
		redirect('cart/index/'.$checkout_token);
	}elseif ($submit == "Yes") {
		redirect('youraccount/start');
	}
}


function go_to_checkout()
{


$this->load->module('site_security');
$shopper_id = $this->site_security->_get_user_id();  

  if (is_numeric($shopper_id)) {
    	redirect('cart');
    }
$data['checkout_token'] = $this->uri->segment(3);
$data['flash'] = $this->session->flashdata('items');
$data['view_file'] = "go_to_checkout";
$this->load->module('templates');
$this->templates->public_bootstrap($data);



}

function _attempt_draw_checkout_btn($query)
{
	$data['query'] = $query;
	$this->load->module('site_security');
	$shopper_id = $this->site_security->_get_user_id();
	$third_bit =$this->uri->segment(3);






	if ((!is_numeric($shopper_id)) && ($third_bit=='')) {
		$this->_draw_ckeckout_btnfake($query);
	}else{
		$this->_draw_checkout_btn_real($query);
	}

}




function _draw_ckeckout_btnfake($query)
{
	foreach ($query->result() as $row) {
		$session_id = $row->session_id;
	}

	$data['checkout_token'] = $this->_create_checkout_token($session_id);

	$this->load->view('checkout_btn_fake', $data);
}

function _draw_checkout_btn_real($query)
{
	$this->load->module('paypal');
	$this->paypal->_draw_checkout_btn($query);
}


function _draw_cart_content($query, $user_type)
{
	//NOTE: user_type can be public or admin
	$this->load->module('site_settings'); 
	$this->load->module('shipping');


	if ($user_type == 'public') {
		$view_file = 'cart_contents_public';
	} else{
		$view_file = 'cart_content_admin';
	}
	$data['shipping'] = $this->shipping->_get_shipping();

	$data['query'] = $query;
	$this->load->view($view_file, $data);

}


function index()
{
$data['flash'] = $this->session->flashdata('item'); 
$data['view_file'] = "cart";

$third_bit = $this->uri->segment(3);
if ($third_bit !='') {
	// check that the token is cool then get session ID
	$session_id = $this->_check_and_get_session_id($third_bit);
}else{
	$session_id = $this->session->session_id;

}


$this->load->module('site_security');
$shopper_id = $this->site_security->_get_user_id();  

  if (!is_numeric($shopper_id)) {
    	$shopper_id =0;
    }

$table = 'store_basket';
$data['query'] = $this->_fetch_cart_contents($session_id, $shopper_id, $table);
// count the number of itmes in tthe cart
$data['num_rows']= $data['query']->num_rows();
$data['showing_statement'] = $this->_get_showing_statement($data['num_rows']);
$this->load->module('templates');
$this->templates->public_bootstrap($data);

}

function _get_showing_statement($num_items)
{
  if ($num_items == 1) {
  	$showing_statement = "Ypu have one items in your shoppin basket.";
  }else{
  	$showing_statement = "You have ".$num_items." items in your basket.";
  }
  return $showing_statement;
}


function _fetch_cart_contents($session_id, $shopper_id, $table)
{
	// fetch cart content of the shopping cart
	$this->load->module('store_basket');


	$mysql_query = "

		SELECT $table.*,
		       store_items.small_pic,
		       store_items.item_url
		FROM $table LEFT JOIN store_items ON $table.item_id = store_items.id
		";





	if ($shopper_id > 0) {
		$where_condition = " WHERE $table.shopper_id = '$shopper_id'";



	} else {
		$where_condition = " WHERE $table.session_id = '$session_id'";
	}
	$mysql_query.=$where_condition;
	$query = $this->store_basket->_custom_query($mysql_query);
	return $query;
	

  

}


function _draw_add_to_cart($item_id){
	// fetch color options for this item
	$submitted_color = $this->input->post('submitted_color',TRUE);
	if ($submitted_color=="") {
		$color_options[''] = "Select...";
	}
	$this->load->module('store_items_color');
	$query = $this->store_items_color->get_where_custom('item_id',$item_id);
	$data['num_colors'] = $query->num_rows();
	foreach ($query->result() as  $row) {
		# code...
		$color_options[$row->id] = $row->color;
	}

	// fetch sizes options
	$submitted_sizes = $this->input->post('submitted_sizes',TRUE);
	if ($submitted_sizes=="") {
		$sizes_options[''] = "Select...";
	}
	$this->load->module('store_items_sizes');
	$query = $this->store_items_sizes->get_where_custom('item_id',$item_id);
	$data['num_sizes'] = $query->num_rows();
	foreach ($query->result() as  $row) {
		# code...
		$sizes_options[$row->id] = $row->sizes;
	}
	$data['submitted_color'] = $submitted_color;
	$data['submitted_sizes'] = $submitted_sizes;
    $data['color_options'] = $color_options;
    $data['sizes_options'] = $sizes_options;
	$data['item_id'] = $item_id;
	$this->load->view('add_to_cart', $data);
}


}

		