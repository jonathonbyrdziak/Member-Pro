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

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'framework.php';


// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();

$support_post 	= 'http://www.jonathonbyrd.com/wordpress/membership-plugin-support-page';
$support_id		= 364;


if (!isset($_GET['postingcomment'])) {
	
	
	$html = file_get_html($support_post);
	foreach ($html->find('cite.fn') as $admin) if ($admin->innertext == 'admin') $admin->innertext = 'Jonathon';
	foreach ($html->find('script') as $script) $script = null;
	?>
	<h2>Online Support</h2>
		<div id="commentsgohere">
			<?php echo stripslashes($html->find('#commentlist',0)->outertext); ?>
		</div>
	<br/>
	
	<table width="600px">
		<tr>
			<td>Name</td><td><input name="author" id="author" size="50" type="text" value="<?php echo $current_user->user_firstname.' '.$current_user->user_lastname; ?>" /></td>
		</tr>
		<tr>
			<td>Email</td><td><input name="email" id="email" size="50" type="text" value="<?php echo $current_user->user_email; ?>" /></td>
		</tr>
		<tr>
			<td>Url</td><td><input name="url" id="url" size="50" type="text" value="<?php echo get_bloginfo( 'wpurl' ); ?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><textarea name="comment" id="comment"></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><button id="postcommentbutton" name="postingcomment">Post!</button></td>
		</tr>
	</table>
	
	<h2>JonathonByrd.com</h2>
	<p>If you end up making it big, don't forget about me :)</p>
	
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="10690444">
		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<?php 
	
} else {
	$posted = byrd_curl('http://www.jonathonbyrd.com/wp-comments-post.php', $_GET);
	
	$html = file_get_html($support_post);
	foreach ($html->find('cite.fn') as $admin) if ($admin->innertext == 'admin') $admin->innertext = 'Jonathon';
	foreach ($html->find('script') as $script) $script = null;
	echo stripslashes($html->find('#commentlist',0)->outertext);
	
	if ($posted){ 
		$html = str_get_html($posted)->find('p',0)->innertext;
		echo '<br/><b>'.$html.'</b>';
		
	} else {
		echo '<br/><b>'.date('g:i a d-m-Y').' Posted, please wait for Jonathon to answer.</b>';
	}
	
}