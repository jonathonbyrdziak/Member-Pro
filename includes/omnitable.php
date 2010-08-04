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

require_once dirname(__file__).'/framework.php';


// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();


class omniTable extends bObject {
	
	/**
	 * Key to the db table
	 * 
	 */
	var $ID = null;
	
	/**
	 * displays the form
	 * 
	 */
	var $table = null;
	
	/**
	 * task to do
	 */
	var $task = null;
	
	/**
	 * manages the requests
	 * @return none
	 */
	function __construct(){
		$this->setProperties( $_GET );
		
		$func = (string)$this->task;
		$this->$func();
	}
	
	/**
	 * displays the form
	 * @return none
	 */
	function add(){
		$table =& bTable::getInstance($this->table, 'Table');
		$properties = $table->getProperties();
		
		echo '<form action="#" method="get" name="formadd" id="formadd">';
		
		//create the form
		foreach ($properties as $property => $value){
			if ($table->getKeyName() == $property) continue;
			$label = ucwords(strtolower( str_replace('_', ' ', $property) ));
			
			echo '<label>'.$label.'<br>';
			echo '<input type="text" name="'.$property.'" id="'.$property.'"></label><br>';
			
		}
		echo '</form>';
		
	}
	
	/**
	 * displays the form
	 * @return none
	 */
	function edit(){
		$table =& bTable::getInstance($this->table, 'Table');
		$table->load( $this->ID );
		$properties = $table->getProperties();
		
		echo '<form action="#" method="get" name="formedit" id="formedit">';
		
		//create the form
		foreach ($properties as $property => $value){
			
			$label = ucwords(strtolower( str_replace('_', ' ', $property) ));
			
			if ($table->getKeyName() != $property){
				echo '<label>'.$label.'<br>';
				echo '<input type="text" name="'.$property.'" id="'.$property.'" value="'.$value.'"></label><br>';
			
			} else {
				echo '<input type="hidden" name="'.$property.'" id="'.$property.'" value="'.$value.'">';
				
			}
		}
		echo '</form>';
		
	}
	
	/**
	 * stores the data
	 * @return none
	 */
	function save(){
		$table =& bTable::getInstance($this->table, 'Table');
			
		if (!$table->bind( bRequest::get('get') )) {
	        return trigger_error( $table->getError() );
		}
		
		$table->store();
		echo 'Item Saved!';
		
	}
	
	/**
	 * deletes the record
	 * @return none
	 */
	function delete(){
		$table =& bTable::getInstance($this->table, 'Table');
		
		//loop through the keys
		$keys = split(',', bRequest::getVar('keys'));
		foreach ( $keys as $key => $id ){
			if ($id != ''){
				//$table->load( $id );
				$table->delete( $id );
			}
		}
		
		echo 'Items Deleted.';
		
	}
	
	/**
	 * gets the list of data
	 * @return none
	 */
	function view(){
		// getting the table reference
		$table =& bTable::getInstance($this->table, 'Table');
		
		//get the table
		$table->getPageList();
		
	}
	
	
	
	
	
	/**
	 * stores the data
	 * @return none
	 */
	function saveCapabilities(){
		$table =& bTable::getInstance($this->table, 'Table');
		$table->load( bRequest::getVar('role') );
		$table->setCapabilities( bRequest::get('get') );
		print_r( $table->getProperties() );
		$table->store();
		echo 'Item Saved!';
		
	}
	
	/**
	 * displays the form
	 * @return none
	 */
	function addRole(){
		$table =& bTable::getInstance($this->table, 'Table');
		$properties = $table->getProperties();
		
		echo '<form action="#" method="get" name="formadd" id="formadd">';
		
		//create the form
		foreach ($properties as $property => $value){
			if ($table->getKeyName() == $property) continue;
			if ('capabilities' == $property) continue;
			
			$label = ucwords(strtolower( str_replace('_', ' ', $property) ));
			
			echo '<label>'.$label.'<br>';
			echo '<input type="text" name="'.$property.'" id="'.$property.'"></label><br>';
			
		}
		echo '</form>';
		
	}
	
	
}

$display = new omniTable();