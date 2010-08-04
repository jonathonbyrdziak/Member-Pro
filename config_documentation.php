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
<h2>Overview</h2>
	<p>Thank you for downloading the Membership Subscription Manager from <a href="http://www.jonathonbyrd.com">JonathonByrd.com</a>. This plugin is not designed to be fully featured.
	The goal with this plugin was to get a useable Membership Subscription Manager up and running with all of the features necessary to a
	healthy membership website. I've only put a couple of days into this plugin but I'm offering it for free to the Wordpress Community.</p>
	
	<p>I will be continuing to develop a lot of features into this plugin over the next week and I'll be selling it as a Pro version on my site.
	I would appreciate you buying me a beer with a small donation if you begin to make money off of this plugin. If you need assistance with
	traffic and conversion rates, visit my website, as all of the tools I'm providing are geared to helping you make a profit.</p>
	
	<h2>Installation</h2>
	<p><b>This plugin does one thing and one thing only, it is designed to create user accounts 
	for new subscribers and delete user accounts of expired subscribers.</b> This plugin does not manage 
	access rights to anypages or posts.</p>
	
	<p>You will need to install a Membership Plugin designed to restrict users access to posts.
	Look here for a plugin: <a href="http://wordpress.org/extend/plugins/search.php?q=members&sort=top-rated" target="_blank">Wordpress Members Only Plugins</a>.
	I've installed <a href="http://wordpress.org/extend/plugins/member-access/" target="_blank">Member Access</a>, 
	but this is purely a preference.</p>
	
	<p>You shouldn't need to modify any of your paypal account settings in order for this system to work. I've provided
	every option that I could find for you to configure and override your default account settings, right from this configurations
	area. I've also preset many default settings so that this plugin will run right out of the box.</p>
	
	<p><b>TIP:</b> If you have problems getting the email notifications to save, check that the file permissions are set to 755.</p>
	
	<h2>Features Walkthrough</h2>
	<ul>
		<li>
		
		<li>
		<h4>Subscription</h4>
		<p>If designed this to be an insertable block so that you can paste your subscription information anywhere
		around your website. Just use the code below.</p>
		
		<p>This tag will display all subscriptions</p>
		<pre>
		&lt;!-- getSubscription() --&gt;
		</pre>
		
		<p>Entering the # of the subscription will only display this single subscription.</p>
		<pre>
		&lt;!-- getSubscription(#) --&gt;
		</pre>
		</li>
		
		<li>
		<h4>Confirmation Page</h4>
		<p>The confirmation page will wrap itself with your template and show as a receipt to your new Member.
		No adjustments are needed for this page.</p>
		</li>
		
		<li>
		<h4>Cancel Return Page</h4>
		<p>If the user cancels the payment process before completing the transaction, they will be redirected
		to this page.</p>
		</li>
		
		<li>
		<h4>Notification Emails</h4>
		<p>These email notifications are just simple html/php files that I've saved in the plugins directory.
		You have your choice of opening those files directly, or using the tiny text areas on the
		Notifications tab.</p>
		<p>This email system is super simple to use. I've provided you with a list of variables that are received
		from the paypal transaction, you can paste any of these variables into the Notifications Emails and the
		system will automatically replace them with their value.</p>
		</li>
		
		<li>
		<h4>Completely Managed Memberships</h4>
		<p>The system is designed to create new user accounts, using the persons paypal email and real name. The
		system will auto generate a password for the user, so you should provide your members with the ability
		to change their passwords so that they will remember how to login.</p>
		<b>Signup</b>
		<p>A new account is created and an email notification is emailed.</p>
		<b>Renewed</b>
		<p>An email notification of the accepted payment is emailed.</p>
		<b>Expired</b>
		<p>The users account is deleted and an email notification is emailed.</p>
		<b>Canceled</b>
		<p>The users account is deleted and an email notification is emailed.</p>
		</li>
		
	</ul>


