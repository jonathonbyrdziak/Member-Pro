<?php 
/**
 * @subpackage	: Wordpress
 * @author		: Jonathon Byrd
 * @copyright	: All Rights Reserved, Byrd Inc. 2009
 * @link		: http://www.jonathonbyrd.com
 * 
 * Jonathon Byrd is a freelance developer for hire. Jonathon has owned many companies and
 * understands the importance of website credibility. Contact Jonathon Today.
 * 
 */ 

//loading resources
require_once dirname(__file__).'/includes/framework.php';

// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();
	
/**
 * 
 * @author Jonathon Byrd
 *
 */
class ByrdIpn extends bObject {
	
	/**
	 * Subscription started
	 * 
	 * @return bool
	 */
	function subscr_signup(){
		
		//creating new users
		$results = byrd_new_user( $this->first_name.' '.$this->last_name, $this->payer_email, $this->item_number );
		$this->setProperties( $results );
		
		//saving the user meta data
		$this->storeUserData();
		
		//sends confirmation email
		byrd_send_mail( 
			$this->receiver_email, 
			$this->payer_email, 
			'Subscription Account Created', 
			ROL.DS.'mail_signup.php', false ,true,
			$this->getProperties()
		); 
				
		return true;
	}

	/**
	 * Subscription payment received
	 * 
	 * @return bool
	 */
	function subscr_payment(){
		
		//creating new users if they dont exist
		if (!byrd_userexists( $this->payer_email )){
			$results = byrd_new_user( $this->first_name.' '.$this->last_name, $this->payer_email, $this->item_number );
			$this->setProperties( $results );
			
			//saving the user meta data
			$this->storeUserData();
		
			//sends confirmation email
			byrd_send_mail( 
				$this->receiver_email, 
				$this->payer_email, 
				'Subscription Account Created', 
				ROL.DS.'mail_signup.php', false ,true,
				$this->getProperties()
			); 
			
		} else {
			//sends confirmation email
			byrd_send_mail( 
				$this->receiver_email, 
				$this->payer_email, 
				'Subscription Account Renewed', 
				ROL.DS.'mail_renewed.php', false ,true,
				$this->getProperties()
			); 
		}
		return true;
	}

	/**
	 * Subscription expired
	 * 
	 * @return bool
	 */
	function subscr_eot(){
		
		$this->manageExpiration();
		
		//sends confirmation email
		byrd_send_mail( 
			$this->receiver_email, 
			$this->payer_email, 
			'Subscription Account Expired', 
			ROL.DS.'mail_expired.php', false ,true,
			$this->getProperties()
		); 
		
		return true;
	}

	/**
	 * Subscription canceled
	 * 
	 * @return bool
	 */
	function subscr_cancel(){
		
		$this->manageExpiration();
		
		//sends confirmation email
		byrd_send_mail( 
			$this->receiver_email, 
			$this->payer_email, 
			'Subscription Account Canceled', 
			ROL.DS.'mail_canceled.php', false ,true,
			$this->getProperties()
		); 
		
		return true;
	}
	
	/**
	 * here we figure out what to do with expired accounts
	 * @return bool
	 */
	function manageExpiration(){
		$sub =& bTable::getInstance('subscriptions', 'Table');
		$sub->load( $this->item_number );
		
		switch($sub->expiredcontroll){
			//deleting user
			case 0: byrd_delete_user( $this->payer_email ); break;
			case 1: byrd_change_usersrole( byrd_userexists( $this->payer_email ), $sub->downgradeuser); break;
			//case 2:  break;
		}
		
	}

	/**
	 * Did the sandbox send this?
	 *
	 * @var varchar(100)
	 */
	var $test_ipn = null;
	
	/**
	 * echeck, instant
	 *
	 * @var varchar(8)
	 */
	var $payment_type = null;
	
    /**
	 * 22:24:40 Dec. 20, 2009 PST
	 *
	 * @var timestamp
	 */
	var $payment_date = null;
	
    /**
	 * Canceled_Reversal, Completed, Denied, Expired, Failed, In-Progress
	 * Partially_Refunded, Pending, Processed, Refunded, Reversed, Voided
	 *
	 * @var varchar(20)
	 */
	var $payment_status = null;
	
	/**
	 * confirmed
	 *
	 * @var varchar(10)
	 */
	var $payer_status = null;
	
	/**
	 * the users name
	 *
	 * @var varchar(100)
	 */
	var $first_name = null;
	
	/**
	 * the users last name
	 *
	 * @var varchar(100)
	 */
	var $last_name = null;
	
	/**
	 * buyer@paypalsandbox.com
	 *
	 * @var varchar(100)
	 */
	var $payer_email = null;
	
	/**
	 * TESTBUYERID01
	 *
	 * @var varchar(50)
	 */
	var $payer_id = null;
	
	/**
	 * John Smith
	 *
	 * @var varchar(100)
	 */
	var $address_name = null;
	
	/**
	 * United States
	 *
	 * @var varchar(100)
	 */
	var $address_country = null;
	
	/**
	 * US
	 *
	 * @var varchar(25)
	 */
	var $address_country_code = null;
	
	/**
	 * 95131
	 *
	 * @var varchar(10)
	 */
	var $address_zip = null;
	
	/**
	 * WA
	 *
	 * @var varchar(10)
	 */
	var $address_state = null;
	
	/**
	 * San Jose
	 *
	 * @var varchar(100)
	 */
	var $address_city = null;
	
	/**
	 * 123, any street
	 *
	 * @var varchar(100)
	 */
	var $address_street = null;
	
	/**
	 * seller@paypalsandbox.com
	 *
	 * @var varchar(100)
	 */
	var $business = null;
	
	/**
	 * seller@paypalsandbox.com
	 *
	 * @var varchar(100)
	 */
	var $receiver_email = null;
	
	/**
	 * TESTSELLERID1
	 *
	 * @var varchar(50)
	 */
	var $receiver_id = null;
	
	/**
	 * US
	 *
	 * @var varchar(25)
	 */
	var $residence_country = null;
	
	/**
	 * something
	 *
	 * @var varchar(100)
	 */
	var $item_name = null;
	
	/**
	 * AK-1234
	 *
	 * @var varchar(100)
	 */
	var $item_number = null;
	
	/**
	 * 1
	 *
	 * @var int(5)
	 */
	var $quantity = null;
	
	/**
	 * 3.04
	 *
	 * @var decimal(10,2)
	 */
	var $shipping = null;
	
	/**
	 * 2.02
	 *
	 * @var decimal(10,2)
	 */
	var $tax = null;
	
	/**
	 * USD
	 *
	 * @var varchar(10)
	 */
	var $mc_currency = null;
	
	/**
	 * 0.44
	 *
	 * @var decimal(10,2)
	 */
	var $mc_fee = null;
	
	/**
	 * 12.34
	 *
	 * @var decimal(10,2)
	 */
	var $mc_gross = null;
	
	/**
	 * 9.34
	 *
	 * @var decimal(10,2)
	 */
	var $mc_gross_1 = null;
	
	/**
	 * adjustment, cart, express_checkout, masspay, merch_pmt, new_case, recurring_payment
	 * recurring_payment_profile_created, send_money, subscr_cancel, subscr_eot, subscr_failed, subscr_modify
	 * subscr_payment, subscr_signup, virtual_terminal, web_accept
	 * 
	 * @var varchar(10)
	 */
	var $txn_type = null;
	
	/**
	 * 401221624
	 *
	 * @var varchar(100)
	 */
	var $txn_id = null;
	
	/**
	 * 2.1
	 *
	 * @var varchar(5)
	 */
	var $notify_version = null;
	
	/**
	 * in case this was a refund or something
	 *
	 * @var varchar(100)
	 */
	var $parent_txn_id = null;
	
	/**
	 * xyz123
	 *
	 * @var varchar(10)
	 */
	var $custom = null;
	
	/**
	 * windows-1252
	 *
	 * @var varchar(25)
	 */
	var $charset = null;
	
	/**
	 * A688nRBjy0haRXvEWbs5m6I-IQdpARIHDtKbXU4EbLuZVaE.Yptjpszw
	 *
	 * @var varchar(100)
	 */
	var $verify_sign = null;
	
	
	/**
	 * xyz1234
	 *
	 * @var varchar(20)
	 */
	var $invoice = null;
	
	/**
	 * 
	 *
	 * @var varchar(100)
	 */
	var $transaction_subject = null;
	
    /**
	 * S-33X38145DW8737944
	 *
	 * @var varchar(100)
	 */
	var $subscr_id = null;
	
    /**
	 * test message to seller, I guess?
	 *
	 * @var varchar(255)
	 */
	var $memo = null;
	
    /**
	 * Eligible
	 *
	 * @var varchar(10)
	 */
	var $protection_eligibility = null;
	
    /**
	 * echeck
	 *
	 * @var varchar(10)
	 */
	var $pending_reason = null;
	
    /**
	 * confirmed
	 *
	 * @var varchar(10)
	 */
	var $address_status = null;
	
	/**
	 * 
	 *
	 * @var bool
	 */
	var $resend = null;
	
	/**
	 * holds the users new password
	 * @var string
	 */
	var $password = null;
	
	/**
	 * holds the users new username
	 * @var string
	 */
	var $user_name = null;
	
	/**
	 * holds the table object
	 * @var object
	 */
	private $_tbl = null;
	
	/**
	 * holds the table paypal url
	 * @var string
	 */
	private $_paypal = null;
	
	/**
	 * sandbox true is for testing
	 * @var bool
	 */
	private $_verified = false;
	
	/**
	 * saves all data to txt logs
	 * @var bool
	 */
	private $_debug = false;
	
	/**
	 * Class constructor, overridden in descendant classes.
	 *
	 * @access	protected
	 */
	function __construct() {
		//bind the paypal post
		$this->setProperties( $_POST );
		$this->setProperties( $_GET );
		
		//used for debugging
		if ($this->_debug) file_put_contents('ipn_post.txt', json_encode($_POST) );
		if ($this->_debug) file_put_contents('ipn_classproperties.txt', json_encode($this->getProperties()).'', FILE_APPEND );
		
		//set the sandbox
		if ($this->test_ipn) $this->_paypal = "www.sandbox.paypal.com"; 
		else $this->_paypal = "www.paypal.com";
		
		//store the ipn to the db, i want to track everything
		$this->storeIpn();
		
		//Validate the ipn post
		if (!$this->postback()) return false;
		if ($this->payment_status != 'Completed') return false;
		if ($this->test_ipn) return false;
		
		
		//do custom
		switch ($this->txn_type){
			case 'subscr_signup':
				$this->subscr_signup();
				break;
			case 'subscr_payment':
				$this->subscr_payment();
				break;
			case 'subscr_eot':
				$this->subscr_eot();
				break;
			case 'subscr_cancel':
				$this->subscr_cancel();
				break;
				
		}
		
		
	}
	
	/**
	 * stores the submission to the database regardless
	 * @return 
	 */
	function storeIpn(){
		$_tbl =& bTable::getInstance('ipn', 'Table');
		$_tbl->bind( $this->getProperties() );
		$_tbl->store();
	}
	
	/**
	 * stores the submission to the database regardless
	 * @return 
	 */
	function storeUserData(){
		if (!isset($this->userid)) return false;
		
		update_usermeta( $this->userid, 'subscription_expiration', $this->custom );
		update_usermeta( $this->userid, 'subscription_startdate', $this->payment_date );
		update_usermeta( $this->userid, 'subscription_name', $this->item_name );
		
		update_usermeta( $this->userid, 'subscription_streetaddress', $this->address_street );
		update_usermeta( $this->userid, 'subscription_city', $this->address_city );
		update_usermeta( $this->userid, 'subscription_state', $this->address_state );
		update_usermeta( $this->userid, 'subscription_zip', $this->address_zip );
		update_usermeta( $this->userid, 'subscription_country', $this->address_country );
		
		update_usermeta( $this->userid, 'first_name', $this->first_name );
		update_usermeta( $this->userid, 'last_name', $this->last_name );
		
		
		$data['display_name'] = $this->first_name.' '.$this->last_name;
		
		$_tbl =& bTable::getInstance('users', 'Table');
		$_tbl->load( $this->userid );
		$_tbl->bind( $data );
		$_tbl->store();
	}
	
	/**
	 * validates the paypal ipn post
	 * 
	 * @return bool
	 */
	function postback(){
		$req = 'cmd=_notify-validate'.$this->getQuerystring();
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ($this->_paypal, 80, $errno, $errstr, 30);
		
		if (!$fp) {
		// HTTP ERROR
		} else {
			fputs ($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);
				if ($this->_debug) file_put_contents('ipn_postback.txt', $res );
		
				if (strcmp ($res, "VERIFIED") == 0) {
					$this->_verified = true;
				} else if (strcmp ($res, "INVALID") == 0) {
					$this->_verified = false;
				}
			}
			fclose ($fp);
		}
		return $this->_verified;
	}
	
	/**
	 * turns the properties into a querystring
	 * 
	 * @return string
	 */
	function getQuerystring(){
		$query = '';
		foreach($_POST as $property => $value){
			$query .= '&'.$property.'='.urlencode($value);
		}
		
		//checking the postback string
		if ($this->_debug) file_put_contents('ipn_query.txt', $query );
		return $query;
	}
	
	
}

//extended classes must be called after the class
$ipn = new ByrdIpn;
