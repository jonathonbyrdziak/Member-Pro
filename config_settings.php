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

?>
<h2>Subscription Settings</h2>
	<table>
		<tr>
			<td width="200"><label for="displayexpirationdata">Display Expiration Data</label></td>
			<td><input id="displayexpirationdata" name="displayexpirationdata" type="checkbox" <?php byrd_checkbox($this->displayexpirationdata); ?> />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			Would you like to display the users subscription information within the users table?
			</td>
		</tr>
		<tr>
			<td width="200"><label for="displayusersaddress">Display Address</label></td>
			<td><input id="displayusersaddress" name="displayusersaddress" type="checkbox" <?php byrd_checkbox($this->displayusersaddress); ?> />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			Would you like to display the users address information within the users table?
			</td>
		</tr>
		
		
	</table>