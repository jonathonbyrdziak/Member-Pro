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


class byrdRoles extends bObject {
	
	/**
	 * 
	 * @var string
	 */
	var $username = false;
	
	/**
	 * 
	 * @var string
	 */
	var $user_id = '0';
	
	/**
	 * 
	 * @var string
	 */
	var $word_user_level = '0';
	
	/**
	 * 
	 * @var string
	 */
	var $user_role = 'Guest';
	
	/**
	 * These are our access capabilities
	 */
	var $acl_read = null;
	
	
	
	/**
	 * controller
	 * @return bool
	 */
	function __construct()
	{
		$this->loadUser();
		$this->loadACL();
		$this->setPermissions();
		
	}
	
	/**
	 * designed to set the permissions to access certain functions
	 * @return bool
	 */
	function setPermissions()
	{
		global $wp_roles, $wp_user_roles;
		$roleStructure = array();
		
		$role =& bTable::getInstance('roles', 'Table');
		
		foreach ($role->getList() as $num => $value)
		{
			$roleStructure[$value['role']]['name'] = $value['display_name'];
			$roleStructure[$value['role']]['capabilities'] = $value['capabilities'];
		}
		
		$wp_user_roles = $roleStructure;
	}
	
	/**
	 * loads the access control levels
	 * 
	 * @return bool
	 */
	function loadACL()
	{
		$role =& bTable::getInstance('roles', 'Table');
		$role->load( $this->word_user_level );
		$this->setCapabilities( $role->getProperties() );
		return true;
	}
	
	/**
	 * loads all user data from the cookie
	 * 
	 * @return bool
	 */
	function loadUser()
	{
		//getting the users name
		if (!($this->username = byrd_getusername())) return false;
		
		//getting the user data
		$user =& bTable::getInstance('users', 'Table');
		$userdata = $user->username_exists( $this->username );
		$this->user_id = $userdata['ID'];
		$user->load( $this->user_id );
		
		//getting the users meta data
		$usermeta =& bTable::getInstance('usermeta', 'Table');
		$usermeta->user_id = $this->user_id;
		$usermetadata = $usermeta->getMeta( );
		$userdata['meta'] = $usermetadata;
		
		//binding
		$this->loadMeta($usermetadata, 'word_user_level');
		$this->loadMeta($usermetadata, 'word_capabilities');
		
		//special binds
		$this->user_role = ucwords(key(unserialize( $this->word_capabilities )));
		
		return $userdata;
	}
	
	/**
	 * binds the meta value to this class
	 * 
	 * @param $data
	 * @param $meta
	 * @return unknown_type
	 */
	function loadMeta($data, $meta)
	{
		if (!is_array($data)) return false;
		foreach($data as $record){
			if ($record['meta_key'] != $meta) continue;
			return $this->$meta = $record['meta_value'];
		}
		return true;
	}
	
	/**
	 * Returns an associative array of object properties
	 *
	 * @access	public
	 * @return	array
 	 */
	function getCapabilities( )
	{
		$vars  = get_object_vars($this);

        foreach ($vars as $key => $value)
		{
			if ('acl_' != substr($key, 0, 4)) {
				unset($vars[$key]);
			}
		}

        return $vars;
	}

	/**
	 * Set the object properties based on a named array/hash
	 *
	 * @access	protected
	 * @param	$array  mixed Either and associative array or another object
	 * @return	boolean
	 */
	function setCapabilities( $properties )
	{
		$properties = (array) $properties; //cast to an array
		$vars  = $this->getCapabilities( );
		
		if (is_array($properties))
		{
			foreach ($properties as $k => $v) {
				$k = 'acl_'.$k;
				if (in_array($k, array_keys($vars))){
					$this->$k = $v;
				} 
			}

			return true;
		}

		return false;
	}
	
} 
