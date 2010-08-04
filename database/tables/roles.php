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

require_once ROL_INCLUDES.DS.'object.php';
require_once ROL_INCLUDES.DS.'capabilities.class.php';
		

/**
* Table class
*
*/
if (!class_exists('TableRoles')){ class TableRoles extends bTable {

	/**
	 * Key
	 *
	 * @var int(11)
	 */
	var $ID = null;
	
    /**
	 * Secondary Key
	 *
	 * @var varchar(55)
	 */
	var $role = null;
	
    /**
	 * 
	 *
	 * @var varchar(255)
	 */
	var $display_name = null;
	
    /**
	 * 
	 *
	 * @var tinyint(1)
	 */
	var $capabilities = null;
	
    
	
    /**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__subscription_roles', 'ID', $db);
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
	 * custom load
	 */
	function load( $role ){
		//set the query
		$query 	= "SELECT ID FROM ".$this->_tbl
				+ " WHERE role = '".$role."'";
		
		//set and run the query
		$this->_db->setQuery($query);
		$key = $this->_db->loadAssoc()->ID;
		
		if ($key) parent::load( $key );
		else parent::load( $role );
		
		$this->capabilities = base64_unserialize( $this->capabilities );
		$this->getCapabilities();
	}
	
	/**
	 * Sets the capabilities
	 * 
	 * @param $array
	 * @return bool
	 */
	function setCapabilities( $array = array() ){
		$caps = new byrdCapabilities;
		$caps->bind( $this->capabilities );
		$caps->bind( $array );
		$this->capabilities = $caps->getProperties();
	}
	
	/**
	 * Gets the caps
	 * 
	 * @return unknown_type
	 */
	function getCapabilities(){
		$caps = new byrdCapabilities;
		$caps->bind( $this->capabilities );
		$this->capabilities = $caps->getProperties();
		return $this->capabilities;
	}
	
	/**
	 * making sure all variables ar mysql safe
	 */
	function store(){
		$this->capabilities = base64_serialize( $this->capabilities );
		parent::store();
		$this->capabilities = base64_unserialize( $this->capabilities );
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
		
		$results = $this->_db->loadAssocList();
		if (is_array($results)){
			foreach($results as $key => $val)
			{
				$results[$key]['capabilities'] = base64_unserialize( $val['capabilities'] );
			}
		}
		return $results; 
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
		foreach($results as $key => $val)
		{
			$results[$key]['capabilities'] = base64_unserialize( $val['capabilities'] );
			
			$this->setCapabilities( $results[$key]['capabilities'] );
			$results[$key]['capabilities'] = $this->getCapabilities();
			
		}
		
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
