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


//will be requiring this
if (!defined('_EXEC')) define('_EXEC', true);

require_once dirname(__file__).'/defines.php';
require_once dirname(__FILE__).DS.'helper.php';

ini_set('memory_limit', '200M');

if ( !isset($wp_did_header) ) {
	$wp_did_header = true;
	if (is_file(byrd_rootfolder(__file__).DS.'wp-load.php')){
		require_once( byrd_rootfolder(__file__).DS.'wp-load.php' );
		require_once( ABSPATH . WPINC . DS.'template-loader.php' );
		
	} else {
		trigger_error('Problem loading Wordpress Framework.');
	}
}

//loading resources
require_once dirname(__FILE__).DS.'request.php';
require_once dirname(__FILE__).DS.'object.php';
require_once dirname(__FILE__).DS.'capabilities.class.php';
require_once dirname(__FILE__).DS.'role.class.php';
require_once dirname(__FILE__).DS.'properties.php';
require_once dirname(__FILE__).DS.'configclass.php';
require_once dirname(__FILE__).DS.'siteclass.php';
require_once dirname(__FILE__).DS.'factory.php';

if (!class_exists('Email')) require_once dirname(__FILE__).DS.'phpmail.php';
if (!function_exists('file_get_html')) require_once dirname(__FILE__).DS.'simple_html_dom.php';

require_once ROL_DATABASE.DS.'database.php';
require_once ROL_DATABASE.DS.'table.php';

//make sure to add the db tables include path
bTable::addIncludePath( ROL_TABLES );




