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


class byrdCapabilities extends bObject {
	
	/**
	 * controller
	 * @return unknown_type
	 */
	function __construct(){
		
	}
	
	/**
	 * 
	 * @var string
	 */
	var $switch_themes = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_themes = false;
	
	/**
	 * 
	 * @var string
	 */
	var $activate_plugins = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_plugins = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_users = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_files = false;
	
	/**
	 * 
	 * @var string
	 */
	var $manage_options = false;
	
	/**
	 * 
	 * @var string
	 */
	var $moderate_comments = false;
	
	/**
	 * 
	 * @var string
	 */
	var $manage_categories = false;
	
	/**
	 * 
	 * @var string
	 */
	var $manage_links = false;
	
	/**
	 * 
	 * @var string
	 */
	var $upload_files = false;
	
	/**
	 * 
	 * @var string
	 */
	var $import = false;
	
	/**
	 * 
	 * @var string
	 */
	var $unfiltered_html = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_others_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_published_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $publish_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $read = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_10 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_9 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_8 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_7 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_6 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_5 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_4 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_3 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_2 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_1 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $level_0 = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_others_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_published_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $publish_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_others_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_published_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_others_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_published_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_private_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_private_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $read_private_posts = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_private_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_private_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $read_private_pages = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_users = false;
	
	/**
	 * 
	 * @var string
	 */
	var $create_users = false;
	
	/**
	 * 
	 * @var string
	 */
	var $unfiltered_upload = false;
	
	/**
	 * 
	 * @var string
	 */
	var $edit_dashboard = false;
	
	/**
	 * 
	 * @var string
	 */
	var $update_plugins = false;
	
	/**
	 * 
	 * @var string
	 */
	var $delete_plugins = false;
	
	/**
	 * 
	 * @var string
	 */
	var $install_plugins = false;
	
	/**
	 * 
	 * @var string
	 */
	var $update_themes = false;
	
	/**
	 * 
	 * @var string
	 */
	var $install_themes = false;
	
} 
