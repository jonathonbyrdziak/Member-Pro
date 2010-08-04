<?php 
/**
 * Plugin Name: User Role Subscriptions
 * Plugin URI: http://www.jonathonbyrd.com
 * Description: This simple wordpress plugin is designed to manage user role subscriptions. You may charge differently for all roles and manage their subscription periods.
 * Version: 2.0.2
 * Date: December 24th, 2009
 * Author: Jonathon Byrd
 * Author URI: http://www.jonathonbyrd.com
 * 
 * @subpackage	: Wordpress
 * @author		: Jonathon Byrd
 * @copyright	: All Rights Reserved, Byrd Inc. 2009
 * @link		: http://www.jonathonbyrd.com
 * 
 * Jonathon Byrd is a freelance developer for hire. Jonathon has owned many companies and
 * understands the importance of website credibility. Contact Jonathon Today.
 * 
 */ 

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'framework.php';

// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();


if ( class_exists('byrdSiteRoles') ){
	global $byrdRoles;
	$byrdRoles = new byrdSiteRoles();

	//adding admin menu options
	if ( function_exists('add_action') ) add_action('admin_menu', 'plugin_config_Roles');
	function plugin_config_Roles(){
		if ( function_exists('add_submenu_page') ){ 
			add_submenu_page('users.php',__('Membership Role Subscriptions'),__('Role Subscriptions'),'manage_options','byrd_rolessubscriptions'.DS.'config_index_subscriptions.php','');
			add_submenu_page('users.php',__('Membership Role Subscriptions'),__('Role Management'),'manage_options','byrd_rolessubscriptions'.DS.'config_index_roles.php','');
			add_submenu_page('users.php',__('Membership Role Subscriptions'),__('Role Reports'),'manage_options','byrd_rolessubscriptions'.DS.'config_index_reports.php','');
			add_submenu_page('users.php',__('Membership Role Subscriptions'),__('Role Configurations'),'manage_options','byrd_rolessubscriptions'.DS.'config_index_configurations.php','');
		}
		
	}
	
	// This will create the database tables
	require_once dirname(__FILE__).DS.'activation_install_script.php';
	register_activation_hook(__FILE__, 'install_byrd_roles');

 	function install_byrd_roles(){
		$install = new RolesInstallation();
		$install->install();
	}

	//php method of loading the contact form
	if (!function_exists('getSubscription')){ function getSubscription( $id = false ){
		global $byrdRoles;
		if (!$id)
		{
			$byrdRoles->getSubscriptions();
			return false;
		}
		$byrdRoles->getSubscription($id);
	}}
	
	//php method of loading the contact form
	if (!function_exists('getSubscriptions')){ function getSubscriptions(){
		global $byrdRoles;
		$byrdRoles->getSubscriptions();
	}}
	
	//filter replace the user input in the posts with the subscriptions
	add_filter('the_content', array(&$byrdRoles, 'contentFilters'));
	add_filter('manage_users_custom_column', array(&$byrdRoles, 'user_columns'),10,3);
	
	//adding a column header to the users table
	$columns = get_column_headers( 'users' );
	
	//display the users expiration data
	if ($byrdRoles->displayexpirationdata){
		$columns['subscription_expiration'] = 'Sub. Expiration';
		$columns['subscription_startdate'] = 'Started Sub.';
		$columns['subscription_name'] = 'Item Name';
		
	}
	
	//display the users address information
	if ($byrdRoles->displayusersaddress){
		$columns['subscription_streetaddress'] = 'Street Address';
		$columns['subscription_city'] = 'City';
		$columns['subscription_state'] = 'State';
		$columns['subscription_zip'] = 'Zip';
		$columns['subscription_country'] = 'Country';
		
	}
	register_column_headers('users',$columns);
	
	
}




