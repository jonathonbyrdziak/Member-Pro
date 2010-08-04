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
if (!class_exists('TableUsers')){ class TableUsers extends bTable {

	/**
	 * Key
	 *
	 * @var tinyint(11)
	 */
	var $ID = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_login = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_pass = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_nicename = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_email = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_url = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_registered = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_activation_key = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_status = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $display_name = null;
	
    
	
	
    /**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__users', 'ID', $db);
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
	 * 
	 */
	function delete( $email ){
		//set the query
		$query 	= "SELECT ID FROM ".$this->_tbl
				. " WHERE user_email = '".$email."'"
				. " LIMIT 1;";
		
		//set and run the query
		$this->_db->setQuery($query);
		
		$id = $this->_db->loadObject()->ID;
		
		parent::delete( $id );
	}
	
	/**
	 * 
	 */
	function username_exists($name){
		//set the query
		$query 	= "SELECT * FROM ".$this->_tbl
				. " WHERE user_login = '".$name."'";
		
		//set and run the query
		$this->_db->setQuery($query);
		
		return $this->_db->loadAssoc(); 
	}
	
	/**
	 * 
	 */
	function useremail_exists($email){
		//set the query
		$query 	= "SELECT * FROM ".$this->_tbl
				. " WHERE user_email = '".$email."'";
		
		//set and run the query
		$this->_db->setQuery($query);
		$user = $this->_db->loadAssoc();
		
		if (!empty($user))
			return $user['ID']; 
		return false;
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
