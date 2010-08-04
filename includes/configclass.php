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


class byrdConfigRoles extends byrdPropertiesRoles {

	/**
	 * routing the config page
	 * 
	 */
	function __construct(){
		//Check user rights
		
		if ( !current_user_can('manage_options') ) die(__('Sorry, but you don\'t have the rights.'));
		
		if (isset($_POST['itemid']) && bRequest::getVar('item_name',false)){
			$this->saveSubscription();
		}
		
		if (bRequest::getVar('business',false) || bRequest::getVar('displayexpirationdata',false)){
			//update the posted options
			$this->setProperties( bRequest::get('post') );
			$this->setOptions();
		}
		
		//get all of the options
		$this->getOptions();
	}
	
	/**
	 * If this is a subscription, then we save it
	 * 
	 */
	function saveSubscription(){
		$sub =& bTable::getInstance('subscriptions', 'Table');
		$sub->bind( bRequest::get('post') );
		$sub->store();
		
	}
	
	/**
	 * If this is a subscription, then we save it
	 * 
	 */
	function getRoles(){
		$roles =& bTable::getInstance('roles', 'Table');
		return $roles->getList();
	}
	
	/**
	 * loops through and stores theres properties
	 * 
	 */
	function setOptions(){
		//looping through and updating all the properties
		foreach ($this->getProperties() as $property => $value) update_option($property, $value);
		
		file_put_contents(ROL.DS.'mail_canceled.php', stripslashes($this->_mail_canceled) );
		file_put_contents(ROL.DS.'mail_expired.php', stripslashes($this->_mail_expired) );
		file_put_contents(ROL.DS.'mail_renewed.php', stripslashes($this->_mail_renewed) );
		file_put_contents(ROL.DS.'mail_signup.php', stripslashes($this->_mail_signup) );
	}

	/**
	 * loops through the properties and binds them to this class
	 * 
	 */
	function getOptions(){
		//looping through and updating all the properties
		foreach ($this->getProperties() as $property => $value){
			if (get_option($property)) $this->$property = get_option($property);
		}
		
		//special defaults
		if (is_null($this->notify_url)) $this->notify_url = get_bloginfo( 'wpurl' ).'/wp-content/plugins/byrd_rolessubscriptions/ipn.php';  
		if (is_null($this->return)) $this->return = get_bloginfo( 'wpurl' ).'/wp-content/plugins/byrd_rolessubscriptions/confirmation.php';  
		if (is_null($this->cancel_return)) $this->cancel_return = get_bloginfo( 'wpurl' ).'/wp-content/plugins/byrd_rolessubscriptions/cancel_return.php';  
		
	}
	
	/* 
	 * catch all function
	 */
	function __call($method,$arguments) {
		switch (substr($method,0,3)){
			case 'get': echo $this->loadConfig($method,$arguments); break;
			case 'scr': echo $this->javaScript($method,$arguments); break;
			case 'css': echo $this->cssLink($method,$arguments); break;
			
		}
		
	}
	
}
