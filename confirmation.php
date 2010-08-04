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

if (!defined('WP_USE_THEMES')) define('WP_USE_THEMES', false); 
require_once dirname(__file__).'/includes/framework.php';
require_once byrd_rootfolder().'/wp-blog-header.php';
?>  
<?php get_header(); ?>
<BR/><BR/>
<h2>Subscription Confirmation</h2>
<p>Thank you for your subscription, you will be receiving an email with your account information shortly.</p>
<BR/><BR/>
<?php get_footer(); ?>