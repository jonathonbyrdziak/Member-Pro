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

$config = new byrdConfigRoles();
$config->getCss();
$config->getJs();


?>
<form action="" method="post" id="membershipsubscriptions">
	<div class="byrdtabs">
		<ul id="sidemenu">
			<li><a href="#subscriptions" class="tablink" id="defaultlink">Subscriptions</a></li>
			<li><a href="#addnew" class="tablink">Add New</a></li>
			<li><a href="#notifications" class="tablink">Notifications</a></li>
			<li><a href="#pmtgateway" class="tablink">Pmt Gateway</a></li>
			<li><a href="#Settings" class="tablink" id="defaultlink">Settings</a></li>
		</ul>
	</div>
	<div style="display:block;height:1px;line-height:1px;clear:both;"></div>
	
	
	<div class="tabdiv" id="subscriptions"><?php $config->getSubscriptions(); ?></div>
	<div class="tabdiv" id="addnew"><?php $config->getAddnew_subscription(); ?></div>
	<div class="tabdiv" id="notifications"><?php $config->getNotifications(); ?></div>
	<div class="tabdiv" id="pmtgateway"><?php $config->getPmtgateway(); ?></div>
	<div class="tabdiv" id="Settings"><?php $config->getSettings(); ?></div>
	
	
	<input type="submit" name="submit" value="Update Options" style="position:relative;float:right;" />
</form>

