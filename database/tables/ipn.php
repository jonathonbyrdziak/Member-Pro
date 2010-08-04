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


// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();


/**
* Table class
*
*/
if (!class_exists('TableIpn')){ class TableIpn extends bTable {

	/**
	 * Key
	 *
	 * @var tinyint(11)
	 */
	var $ipnid = null;
	
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
	 * "12.34
	 *
	 * @var decimal(10,2)
	 */
	var $mc_gross = null;
	
	/**
	 * web_accept
	 *
	 * @var varchar(10)
	 */
	var $txn_type = null;
	
	/**
	 * 401221624
	 *
	 * @var int(11)
	 */
	var $txn_id = null;
	
	/**
	 * 2.1
	 *
	 * @var varchar(5)
	 */
	var $notify_version = null;
	
	/**
	 * xyz123
	 *
	 * @var varchar(255)
	 */
	var $custom = null;
	
	/**
	 * xyz1234
	 *
	 * @var varchar(20)
	 */
	var $invoice = null;
	
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
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__ipn', 'ipnid', $db);
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 */
	function check() {
		return true;
	}
	
	/**
	 * making sure all variables ar mysql safe
	 */
	function store(){
		
		$this->payment_date = date('Y-m-d H:i:s', strtotime($this->payment_date));
		
		parent::store();
	}
	
	/**
	 * returns a list of all the items
	 * 
	 * @access public
	 * @return array
	 */
	function getList() {
		//set the query
		$query 	= "SELECT * FROM ".$this->_tbl;
		
		//set and run the query
		$this->_db->setQuery($query);
		
		return $this->_db->loadAssocList(); 
	}
	
	/**
	 * this is for the omnigrid table management
	 *
	 * @access public
	 * @return boolean True on success
	 */
	function getPageList() {
		if ( $page = bRequest::getVar("page", 0) )
		{
			$page = true;
			
			$page = intval(bRequest::getVar("page"));
			$perpage = intval(bRequest::getVar("perpage"));
			$n = ( $page -1 ) * $perpage;
		}
		
		//setting pagination query
		$limit = "";
		if ( $page )$limit = " LIMIT $n, $perpage";
		
		// this variables Omnigrid will send only if serverSort option is true
		$sorton = bRequest::getVar("sorton", false);
		$sortby = bRequest::getVar("sortby");
		
		//setting pagination query
		$where = "";
		if ( $sorton )$where = " ORDER BY $sorton $sortby ";
		
		
		//set the query
		$query 	= "SELECT * FROM ".$this->_tbl.$where.$limit;
		
		//set and run the query
		$this->_db->setQuery($query);
		$this->_db->query();
		
		$results = $this->_db->loadAssocList();
		
		//set the query
		$query 	= "SELECT * FROM ".$this->_tbl;
		
		//set and run the query
		$this->_db->setQuery($query);
		$this->_db->query();
		
		$total = $this->_db->getNumRows();
		
		// return the json results
		$return = array("page"=>$page, "total"=>$total, "data"=>$results);
		echo json_encode($return);
		return;
		
	}
	
	
}}
