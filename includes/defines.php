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


//Defining base path
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

define('ROL', str_replace(DS.'includes','', dirname(__file__) ));

//defining all paths
define('ROL_INCLUDES', 	ROL.DS.'includes');
define('ROL_DATABASE', 	ROL.DS.'database');
define('ROL_TABLES', 	ROL_DATABASE.DS.'tables');

//define('ROL_HTTP', 		get_bloginfo( 'wpurl' ).'/wp-content/plugins/'.$plugin_folder);