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
if (!class_exists('TableUsermeta')){ class TableUsermeta extends bTable {

	/**
	 * Key
	 *
	 * @var tinyint(11)
	 */
	var $umeta_id = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $user_id = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $meta_key = null;
	
    /**
	 * 
	 *
	 * @var tinyint(11)
	 */
	var $meta_value = null;
	
	
    /**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__usermeta', 'umeta_id', $db);
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
	 * get all meta
	 */
	function getMeta( ){
		//set the query
		$query 	= "SELECT * FROM ".$this->_tbl
				. " WHERE user_id = '".$this->user_id."'";
		
		//set and run the query
		$this->_db->setQuery($query);
		
		return $this->_db->loadAssocList(); 
	}
	
	/**
	 * gets this meta
	 */
	function find( $where ){
		if (!is_array($where)) return false;
		
		//set the query
		$query 	= "SELECT * FROM ".$this->_tbl
				. " WHERE ";
		
		$querystring = array();
		foreach ($where as $key => $value)	
		$querystring[] = " ".$key." = '".$value."'";
		
		$query .= implode(" AND ", $querystring);
		
		//set and run the query
		$this->_db->setQuery($query);
		if ($meta = $this->_db->loadAssoc())
			$this->load( $meta['umeta_id'] );
		
		return true; 
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
		if ( $page = eRequest::getVar("page", 0) )
		{
			$page = true;
			
			$page = intval(eRequest::getVar("page"));
			$perpage = intval(eRequest::getVar("perpage"));
			$n = ( $page -1 ) * $perpage;
		}
		
		//setting pagination query
		$limit = "";
		if ( $page )$limit = " LIMIT $n, $perpage";
		
		// this variables Omnigrid will send only if serverSort option is true
		$sorton = eRequest::getVar("sorton", false);
		$sortby = eRequest::getVar("sortby");
		
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
?>