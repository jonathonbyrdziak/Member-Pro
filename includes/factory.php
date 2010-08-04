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
 * Every Booking Framework Factory class
 *
 * @static
 */
class ROLESFactory
{
	/**
	 * Get a database object
	 *
	 * Returns a reference to the global {@link rDatabase} object, only creating it
	 * if it doesn't already exist.
	 *
	 * @return object rDatabase
	 */
	public static function &getDBO()
	{
		static $instance;

		if (!is_object($instance))
		{
			$instance = ROLESFactory::_createDBO();
		}

		return $instance;
	}
	
	/**
	 * Create an database object
	 *
	 * @access private
	 * @return object rDatabase
	 * @since 1.5
	 */
	public static function &_createDBO()
	{
		
		global $wpdb;
		
		$host 			= DB_HOST;
		$user 			= DB_USER;
		$password 		= DB_PASSWORD;
		$database		= DB_NAME;
		$prefix 		= $wpdb->prefix;
		$driver 		= 'mysql';
		
		$options	= array ( 
			'driver' => $driver, 
			'host' => $host, 
			'user' => $user, 
			'password' => $password, 
			'database' => $database, 
			'prefix' => $prefix 
		);

		$db =& bDatabase::getInstance( $options );

		return $db;
	}

	
}