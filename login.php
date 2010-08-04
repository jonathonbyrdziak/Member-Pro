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

if (!is_user_logged_in()){ ?>
<h2>Member Login</h2>

<form name="loginform" action="<?php echo wp_login_url(); ?>" method="post">
	<label for="log">Username<br /><input type="text" name="log" id="log" value="" /></label><br />
	<label for="pwd">Password<br /><input type="password" name="pwd" id="pwd" /></label>
	<input type="submit" value="submit" name="submit" />
</form>
	
<?php } else { ?>

<h2>Members Only</h2>
<div>
	<table class="listposts">
		<tr>
			<td>
				<ul>
					<li><a href="<?php echo wp_logout_url( ); ?>" >Log out</a></li>
				</ul>
			</td>
		</tr>
	</table>
</div>
<?php } ?>