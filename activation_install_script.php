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

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

/**
 * 
 * @author Jonathon Byrd
 *
 */
class RolesInstallation extends bObject {
	
	/**
	 * runs each of the queries for us
	 * @return none
	 */
	function __construct(){
	
	}
	
	/**
	 * runs each of the queries for us
	 * @return none
	 */
	function install(){
		$this->rolesTable();
		$this->subscriptionsTable();
		$this->ipnTable();
		
	}
	
	/**
	 * Runs our special query on the database to create the roles table
	 * 
	 * @return unknown_type
	 */
	function rolesTable(){
		global $wpdb;
		global $ms_db_version;
		
		$wpdb->query("SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";");
		$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."subscription_roles` (
			  `ID` int(11) NOT NULL auto_increment,
			  `role` varchar(55) NOT NULL,
			  `display_name` varchar(55) NOT NULL,
			  `capabilities` text NOT NULL,
			  PRIMARY KEY  (`ID`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
		");
		
		
		$wpdb->query("INSERT INTO `".$wpdb->prefix."subscription_roles` (`ID`, `role`, `display_name`, `capabilities`) VALUES
			(1, 'administrator', 'Administrator', 'a:54:{s:13:\"switch_themes\";s:4:\"MQ==\";s:11:\"edit_themes\";s:4:\"MQ==\";s:16:\"activate_plugins\";s:4:\"MQ==\";s:12:\"edit_plugins\";s:4:\"MQ==\";s:10:\"edit_users\";s:4:\"MQ==\";s:10:\"edit_files\";s:4:\"MQ==\";s:14:\"manage_options\";s:4:\"MQ==\";s:17:\"moderate_comments\";s:4:\"MQ==\";s:17:\"manage_categories\";s:4:\"MQ==\";s:12:\"manage_links\";s:4:\"MQ==\";s:12:\"upload_files\";s:4:\"MQ==\";s:6:\"import\";s:4:\"MQ==\";s:15:\"unfiltered_html\";s:4:\"MQ==\";s:10:\"edit_posts\";s:4:\"MQ==\";s:17:\"edit_others_posts\";s:4:\"MQ==\";s:20:\"edit_published_posts\";s:4:\"MQ==\";s:13:\"publish_posts\";s:4:\"MQ==\";s:10:\"edit_pages\";s:4:\"MQ==\";s:4:\"read\";s:4:\"MQ==\";s:8:\"level_10\";s:4:\"MQ==\";s:7:\"level_9\";s:4:\"MQ==\";s:7:\"level_8\";s:4:\"MQ==\";s:7:\"level_7\";s:4:\"MQ==\";s:7:\"level_6\";s:4:\"MQ==\";s:7:\"level_5\";s:4:\"MQ==\";s:7:\"level_4\";s:4:\"MQ==\";s:7:\"level_3\";s:4:\"MQ==\";s:7:\"level_2\";s:4:\"MQ==\";s:7:\"level_1\";s:4:\"MQ==\";s:7:\"level_0\";s:4:\"MQ==\";s:17:\"edit_others_pages\";s:4:\"MQ==\";s:20:\"edit_published_pages\";s:4:\"MQ==\";s:13:\"publish_pages\";s:4:\"MQ==\";s:12:\"delete_pages\";s:4:\"MQ==\";s:19:\"delete_others_pages\";s:4:\"MQ==\";s:22:\"delete_published_pages\";s:4:\"MQ==\";s:12:\"delete_posts\";s:4:\"MQ==\";s:19:\"delete_others_posts\";s:4:\"MQ==\";s:22:\"delete_published_posts\";s:4:\"MQ==\";s:20:\"delete_private_posts\";s:4:\"MQ==\";s:18:\"edit_private_posts\";s:4:\"MQ==\";s:18:\"read_private_posts\";s:4:\"MQ==\";s:20:\"delete_private_pages\";s:4:\"MQ==\";s:18:\"edit_private_pages\";s:4:\"MQ==\";s:18:\"read_private_pages\";s:4:\"MQ==\";s:12:\"delete_users\";s:4:\"MQ==\";s:12:\"create_users\";s:4:\"MQ==\";s:17:\"unfiltered_upload\";s:4:\"MQ==\";s:14:\"edit_dashboard\";s:4:\"MQ==\";s:14:\"update_plugins\";s:4:\"MQ==\";s:14:\"delete_plugins\";s:4:\"MQ==\";s:15:\"install_plugins\";s:4:\"MQ==\";s:13:\"update_themes\";s:4:\"MQ==\";s:14:\"install_themes\";s:4:\"MQ==\";}'),
			(2, 'editor', 'Editor', 'a:34:{s:17:\"moderate_comments\";s:4:\"MQ==\";s:17:\"manage_categories\";s:4:\"MQ==\";s:12:\"manage_links\";s:4:\"MQ==\";s:12:\"upload_files\";s:4:\"MQ==\";s:15:\"unfiltered_html\";s:4:\"MQ==\";s:10:\"edit_posts\";s:4:\"MQ==\";s:17:\"edit_others_posts\";s:4:\"MQ==\";s:20:\"edit_published_posts\";s:4:\"MQ==\";s:13:\"publish_posts\";s:4:\"MQ==\";s:10:\"edit_pages\";s:4:\"MQ==\";s:4:\"read\";s:4:\"MQ==\";s:7:\"level_7\";s:4:\"MQ==\";s:7:\"level_6\";s:4:\"MQ==\";s:7:\"level_5\";s:4:\"MQ==\";s:7:\"level_4\";s:4:\"MQ==\";s:7:\"level_3\";s:4:\"MQ==\";s:7:\"level_2\";s:4:\"MQ==\";s:7:\"level_1\";s:4:\"MQ==\";s:7:\"level_0\";s:4:\"MQ==\";s:17:\"edit_others_pages\";s:4:\"MQ==\";s:20:\"edit_published_pages\";s:4:\"MQ==\";s:13:\"publish_pages\";s:4:\"MQ==\";s:12:\"delete_pages\";s:4:\"MQ==\";s:19:\"delete_others_pages\";s:4:\"MQ==\";s:22:\"delete_published_pages\";s:4:\"MQ==\";s:12:\"delete_posts\";s:4:\"MQ==\";s:19:\"delete_others_posts\";s:4:\"MQ==\";s:22:\"delete_published_posts\";s:4:\"MQ==\";s:20:\"delete_private_posts\";s:4:\"MQ==\";s:18:\"edit_private_posts\";s:4:\"MQ==\";s:18:\"read_private_posts\";s:4:\"MQ==\";s:20:\"delete_private_pages\";s:4:\"MQ==\";s:18:\"edit_private_pages\";s:4:\"MQ==\";s:18:\"read_private_pages\";s:4:\"MQ==\";}'),
			(3, 'author', 'Author', 'a:10:{s:12:\"upload_files\";s:4:\"MQ==\";s:10:\"edit_posts\";s:4:\"MQ==\";s:20:\"edit_published_posts\";s:4:\"MQ==\";s:13:\"publish_posts\";s:4:\"MQ==\";s:4:\"read\";s:4:\"MQ==\";s:7:\"level_2\";s:4:\"MQ==\";s:7:\"level_1\";s:4:\"MQ==\";s:7:\"level_0\";s:4:\"MQ==\";s:12:\"delete_posts\";s:4:\"MQ==\";s:22:\"delete_published_posts\";s:4:\"MQ==\";}'),
			(4, 'contributor', 'Contributor', 'a:5:{s:10:\"edit_posts\";s:4:\"MQ==\";s:4:\"read\";s:4:\"MQ==\";s:7:\"level_1\";s:4:\"MQ==\";s:7:\"level_0\";s:4:\"MQ==\";s:12:\"delete_posts\";s:4:\"MQ==\";}'),
			(5, 'subscriber', 'Subscriber', 'a:54:{s:13:\"switch_themes\";s:8:\"ZmFsc2U=\";s:11:\"edit_themes\";s:8:\"ZmFsc2U=\";s:16:\"activate_plugins\";s:0:\"\";s:12:\"edit_plugins\";s:8:\"ZmFsc2U=\";s:10:\"edit_users\";s:8:\"ZmFsc2U=\";s:10:\"edit_files\";s:0:\"\";s:14:\"manage_options\";s:0:\"\";s:17:\"moderate_comments\";s:0:\"\";s:17:\"manage_categories\";s:0:\"\";s:12:\"manage_links\";s:0:\"\";s:12:\"upload_files\";s:0:\"\";s:6:\"import\";s:0:\"\";s:15:\"unfiltered_html\";s:0:\"\";s:10:\"edit_posts\";s:0:\"\";s:17:\"edit_others_posts\";s:0:\"\";s:20:\"edit_published_posts\";s:0:\"\";s:13:\"publish_posts\";s:0:\"\";s:10:\"edit_pages\";s:0:\"\";s:4:\"read\";s:4:\"MQ==\";s:8:\"level_10\";s:0:\"\";s:7:\"level_9\";s:0:\"\";s:7:\"level_8\";s:0:\"\";s:7:\"level_7\";s:0:\"\";s:7:\"level_6\";s:0:\"\";s:7:\"level_5\";s:0:\"\";s:7:\"level_4\";s:0:\"\";s:7:\"level_3\";s:0:\"\";s:7:\"level_2\";s:0:\"\";s:7:\"level_1\";s:0:\"\";s:7:\"level_0\";s:4:\"MQ==\";s:17:\"edit_others_pages\";s:0:\"\";s:20:\"edit_published_pages\";s:0:\"\";s:13:\"publish_pages\";s:8:\"ZmFsc2U=\";s:12:\"delete_pages\";s:0:\"\";s:19:\"delete_others_pages\";s:0:\"\";s:22:\"delete_published_pages\";s:0:\"\";s:12:\"delete_posts\";s:0:\"\";s:19:\"delete_others_posts\";s:0:\"\";s:22:\"delete_published_posts\";s:0:\"\";s:20:\"delete_private_posts\";s:0:\"\";s:18:\"edit_private_posts\";s:0:\"\";s:18:\"read_private_posts\";s:0:\"\";s:20:\"delete_private_pages\";s:0:\"\";s:18:\"edit_private_pages\";s:0:\"\";s:18:\"read_private_pages\";s:0:\"\";s:12:\"delete_users\";s:0:\"\";s:12:\"create_users\";s:0:\"\";s:17:\"unfiltered_upload\";s:0:\"\";s:14:\"edit_dashboard\";s:0:\"\";s:14:\"update_plugins\";s:0:\"\";s:14:\"delete_plugins\";s:0:\"\";s:15:\"install_plugins\";s:0:\"\";s:13:\"update_themes\";s:0:\"\";s:14:\"install_themes\";s:0:\"\";}');
		");
		
	}
	
	/**
	 * Runs our special query on the database to create the subscriptions table
	 * 
	 * @return unknown_type
	 */
	function subscriptionsTable(){
		global $wpdb;
		global $ms_db_version;
		
		$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."subscriptions`;");
		$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."subscriptions` (
		  `itemid` int(11) NOT NULL auto_increment,
		  `updatedon` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
		  `status` varchar(25) NOT NULL,
		  `item_name` varchar(255) NOT NULL,
		  `item_description` varchar(2000) NOT NULL,
		  `a3` decimal(10,2) NOT NULL,
		  `p3` int(5) NOT NULL,
		  `t3` varchar(5) NOT NULL,
		  `a1` decimal(10,2) NOT NULL,
		  `p1` int(5) NOT NULL,
		  `t1` varchar(5) NOT NULL,
		  `a2` decimal(10,2) NOT NULL,
		  `p2` int(5) NOT NULL,
		  `t2` int(5) NOT NULL,
		  `src` int(5) NOT NULL,
		  `srt` int(5) NOT NULL,
		  `currency_code` varchar(5) NOT NULL,
		  `downgradeuser` varchar(55) NOT NULL,
		  `custom` varchar(100) NOT NULL,
		  `invoice` varchar(50) NOT NULL,
		  `modify` varchar(500) NOT NULL,
		  `item_image` varchar(200) NOT NULL,
		  `role` varchar(255) NOT NULL,
		  `buy_button` varchar(255) NOT NULL,
		  `expiredcontroll` int(1) NOT NULL,
		  PRIMARY KEY  (`itemid`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;");
		
		
	}
	
	/**
	 * Runs our special query on the database to create the ipn table
	 * 
	 * @return unknown_type
	 */
	function ipnTable(){
		global $wpdb;
		global $ms_db_version;
		
		$wpdb->query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";');
		$wpdb->query(
	 	  'CREATE TABLE IF NOT EXISTS `'.$wpdb->prefix.'ipn` (
		  `ipnid` tinyint(11) NOT NULL auto_increment,
		  `updatedon` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
		  `payment_type` varchar(8) NOT NULL,
		  `payment_date` timestamp NOT NULL default \'0000-00-00 00:00:00\',
		  `payment_status` varchar(20) NOT NULL,
		  `pending_reason` varchar(10) NOT NULL,
		  `address_status` varchar(10) NOT NULL,
		  `payer_status` varchar(10) NOT NULL,
		  `first_name` varchar(100) NOT NULL,
		  `last_name` varchar(100) NOT NULL,
		  `payer_email` varchar(100) NOT NULL,
		  `payer_id` varchar(50) NOT NULL,
		  `address_name` varchar(100) NOT NULL,
		  `address_country` varchar(100) NOT NULL,
		  `address_country_code` varchar(25) NOT NULL,
		  `address_zip` varchar(10) NOT NULL,
		  `address_state` varchar(10) NOT NULL,
		  `address_city` varchar(100) NOT NULL,
		  `address_street` varchar(100) NOT NULL,
		  `business` varchar(100) NOT NULL,
		  `receiver_email` varchar(100) NOT NULL,
		  `receiver_id` varchar(50) NOT NULL,
		  `residence_country` varchar(25) NOT NULL,
		  `item_name` varchar(100) NOT NULL,
		  `item_number` varchar(100) NOT NULL,
		  `quantity` varchar(5) NOT NULL,
		  `shipping` decimal(10,2) NOT NULL,
		  `tax` decimal(10,2) NOT NULL,
		  `mc_currency` varchar(10) NOT NULL,
		  `mc_fee` decimal(10,2) NOT NULL,
		  `mc_gross` decimal(10,2) NOT NULL,
		  `txn_type` varchar(25) NOT NULL,
		  `txn_id` varchar(50) NOT NULL,
		  `notify_version` varchar(5) NOT NULL,
		  `custom` varchar(255) NOT NULL,
		  `invoice` varchar(20) NOT NULL,
		  `charset` varchar(25) NOT NULL,
		  `verify_sign` varchar(100) NOT NULL,
		  `subscr_id` varchar(100) NOT NULL,
		  `memo` varchar(255) NOT NULL,
		  `protection_eligibility` varchar(10) NOT NULL,
		  PRIMARY KEY  (`ipnid`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;');
		
	}
	
}
