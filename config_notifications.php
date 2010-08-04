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
<h2>Email Notifications</h2>
	
	<b>mail_signup.php</b>
	<p>This email is sent when a user signs up for the first time.</p>
	<textarea class="large" name="_mail_signup"><?php echo stripslashes(file_get_contents( ROL.DS.'mail_signup.php' )); ?></textarea>
	
	<b>mail_renewed.php</b>
	<p>This email is sent when a payment is made on an existing account.</p>
	<textarea class="large" name="_mail_renewed"><?php echo stripslashes(file_get_contents( ROL.DS.'mail_renewed.php' )); ?></textarea>
	
	<b>mail_expired.php</b>
	<p>This email is sent when a users automated payments failed indefinitely.</p>
	<textarea class="large" name="_mail_expired"><?php echo stripslashes(file_get_contents( ROL.DS.'mail_expired.php' )); ?></textarea>
	
	<b>mail_canceled.php</b>
	<p>This email is sent when a user chooses to cancel their account manually.</p>
	<textarea class="large" name="_mail_canceled"><?php echo stripslashes(file_get_contents( ROL.DS.'mail_canceled.php' )); ?></textarea>
	

