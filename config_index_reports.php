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
			<li><a href="#ipn" class="tablink" id="defaultlink">IPNs Received</a></li>
			<li></li>
		</ul>
	</div>
	<div style="display:block;height:1px;line-height:1px;clear:both;"></div>
	
	
	<div class="tabdiv" id="ipn"><?php $config->getIpnreports(); ?></div>
	
	
	<input type="hidden" name="submit" value="Update Options" style="position:relative;float:right;" />
</form>

