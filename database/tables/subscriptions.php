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
if (!class_exists('TableSubscriptions')){ class TableSubscriptions extends bTable {

	/**
	 * Key
	 *
	 * @var tinyint(11)
	 */
	var $itemid = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $status = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $item_name = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $item_description = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $a1 = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $p1 = null;
	
     /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $t1 = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $a2 = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $p2 = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $t2 = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $a3 = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $p3 = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $t3 = null;
	
    /**
	 * Recurring payments
	 *
	 * @var int(3)
	 */
	var $src = null;
	
    /**
	 * Recurring times
	 *
	 * @var int(3)
	 */
	var $srt = null;
	
    /**
	 * currency code
	 *
	 * @var varchar(3)
	 */
	var $currency_code = null;
	
    /**
	 * expiration control level
	 *
	 * @var varchar(55)
	 */
	var $downgradeuser = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $custom = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $invoice = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $modify = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $item_image = null;
	
    /**
	 * 
	 *
	 * @var varchar(255)
	 */
	var $role = null;
	
    /**
	 * 
	 *
	 * @var varchar(255)
	 */
	var $buy_button = null;
	
    /**
	 * 
	 *
	 * @var varchar(255)
	 */
	var $expiredcontroll = null;
	
    
	
	
    /**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__subscriptions', 'itemid', $db);
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
