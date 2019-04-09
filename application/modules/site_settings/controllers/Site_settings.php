 <?php
	class Site_settings extends MX_Controller 
	{
		function __construct()
		{
			parent::__construct();
		}

function _get_map_code()
{
	$code = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.6787225111907!2d3.3231336141614385!3d6.686660323101612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b968df311bc81%3A0xe2d871a71338c5ac!2sGiwa+Junction+Bus+Stop!5e0!3m2!1sen!2sng!4v1526330326762" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
	return $code;
}

function _get_our_name()
{
	$name = 'ADM Inc';
    return$name;
}

function _get_currency_code()
{
	$code = "NGN";
	return $code;
}


function _get_our_address()
{
	$address = '795 Folsom Ave, Suite 600<br>';
    $address .= 'San Francisco, CA 1234';
    return$address;
}


function _get_our_telnum()
{
	$telnum = ' (123) 456-1234';
    return$telnum;
}

function _get_paypal_email()

{
	$email = 'deji.fash-facilitator@yahoo.com';
	return $email;
}



function _get_support_team_name()
{
	$name = "Customer Support";
	return $name;
}

function _get_welcome_msg($customer_id)
{
	$this->load->module('store_accounts');
	$customer_name = $this->store_accounts->_get_customer_name($customer_id);

	$msg = "Hello ".$customer_name.", <br><br>";
	$msg.= "Thank you for creating an account with CI shop. If you have any questions";
	$msg.= "about any of our product and services please do get in touch. We are here ";
	$msg.= "seven days a week and we are happy to help you. <br><br>";
	$msg.="Regards, <br><br>";
	$msg.="Ayodimeji Fasina(founder)";
	return $msg;
}
		
function _get_cookie_name()
{
	$cookie_name = 'htelgbgfbbhz';
	return $cookie_name;
}		

function _get_item_segments()
{
// return the segment for the store_item page (produce page)
$segments = "musical/instrument/";
return $segments;

}

function _get_items_segments()
{
// return the segment for the cat pages
$segments = "music/instruments/";
return $segments;

}

function _get_page_not_found_msg()
{
$msg = "<h1>Page not found</h1> ";
$msg.= "<p>Please check your address and try again</p>";
return $msg;
}

}