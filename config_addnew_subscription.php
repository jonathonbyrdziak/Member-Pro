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
<h2>Add New Subscription</h2>

	<p>Yes, all of this data is here for you to define a single subscription to a single role.</p>
	<table>
		<tr>
			<td><label for="status">Status</label></td>
			<td>
			<select class="memelem" id="status" name="status">
				<option <?php byrd_select($this->status, 'active'); ?>>active</option>
				<option <?php byrd_select($this->status, 'inactive'); ?>>inactive</option>
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			Active will display the subscription and inactive will disable the subscription.
			</td>
		</tr>
		
		<tr>
			<td><label for="role">Subscription Role</label></td>
			<td>
			<select class="memelem" id="role" name="role">
				<?php foreach (array_reverse($this->getRoles()) as $role){ ?>
					<option value="<?php echo $role['role']; ?>"><?php echo $role['display_name']; ?></option>
				<?php } ?>
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			This is the role that the user will be subscribing to.
			</td>
		</tr>
		<tr>
			<td><label for="expiredcontroll">Expiration Control</label></td>
			<td>
			<select class="memelem" id="expiredcontroll" name="expiredcontroll">
				<option<?php byrd_select($this->expiredcontroll, '0'); ?> value="0">Delete the Users Account</option>
				<option<?php byrd_select($this->expiredcontroll, '1'); ?> value="1">Downgrade the role to Subscriber?</option>
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			How do you want to manage this subscription when a user allows their account to be expired or they manual expire the account?
			</td>
		</tr>
		<tr>
			<td><label for="downgradeuser">If Down grading Role</label></td>
			<td>
			<select class="memelem" id="downgradeuser" name="downgradeuser">
				<?php foreach (array_reverse($this->getRoles()) as $role){ ?>
					<option value="<?php echo $role['role']; ?>"><?php echo $role['display_name']; ?></option>
				<?php } ?>
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			If you choose to down grade these subscriptions to a specific
			</td>
		</tr>
		
		<tr>
			<td width="200"><label for="item_name" style="color:red;">Subscription Title<span style="font-size:10px;">* Required</span></label></td>
			<td><input class="memelem" id="item_name" name="item_name" type="text" size="50" value="<?php echo $this->item_name; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">
			Description of item being sold (maximum 127 characters). If you are collecting aggregate payments, this can include a summary of all items purchased, tracking numbers, or generic terms such as "subscription." If omitted, customer will see a field in which they have the option of entering an Item Name
			</td>
		</tr>
		<tr>
			<td><label for="item_description">Description</label></td>
			<td><textarea class="memelem" id="item_description" name="item_description"><?php echo $this->item_description; ?></textarea></td>
			</tr><tr><td colspan="2" class="paypalinfo">
			</td>
		</tr>
		<tr>
			<td><label for="a3">Price</label></td>
			<td><input class="memelem" id="a3" name="a3" type="text" size="20" value="<?php echo $this->a3; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">
			How much are you going to charge?
			</td>
		</tr>
		<tr>
			<td><label for="currency_code">Currency Code</label></td>
			<td><select id="currency_code" name="currency_code">
				<option value="USD" <?php byrd_select($this->currency_code, 'USD'); ?>>U.S. Dollar</option>
				<option value="AUD" <?php byrd_select($this->currency_code, 'AUD'); ?>>Australian Dollar</option>
				<option value="BRL" <?php byrd_select($this->currency_code, 'BRL'); ?>>Brazilian Real</option>
				<option value="CAD" <?php byrd_select($this->currency_code, 'CAD'); ?>>Canadian Dollar</option>
				<option value="CZK" <?php byrd_select($this->currency_code, 'CZK'); ?>>Czech Koruna</option>
				<option value="DKK" <?php byrd_select($this->currency_code, 'DKK'); ?>>Danish Krone</option>
				<option value="EUR" <?php byrd_select($this->currency_code, 'EUR'); ?>>Euro</option>
				<option value="HKD" <?php byrd_select($this->currency_code, 'HKD'); ?>>Hong Kong Dollar</option>
				<option value="HUF" <?php byrd_select($this->currency_code, 'HUF'); ?>>Hungarian Forint</option>
				<option value="ILS" <?php byrd_select($this->currency_code, 'ILS'); ?>>Israeli New Sheqel</option>
				<option value="JPY" <?php byrd_select($this->currency_code, 'JPY'); ?>>Japanese Yen</option>
				<option value="MYR" <?php byrd_select($this->currency_code, 'MYR'); ?>>Malaysian Ringgit</option>
				<option value="MXN" <?php byrd_select($this->currency_code, 'MXN'); ?>>Mexican Peso</option>
				<option value="NOK" <?php byrd_select($this->currency_code, 'NOK'); ?>>Norwegian Krone</option>
				<option value="NZD" <?php byrd_select($this->currency_code, 'NZD'); ?>>New Zealand Dollar</option>
				<option value="PHP" <?php byrd_select($this->currency_code, 'PHP'); ?>>Philippine Peso</option>
				<option value="PLN" <?php byrd_select($this->currency_code, 'PLN'); ?>>Polish Zloty</option>
				<option value="GBP" <?php byrd_select($this->currency_code, 'GBP'); ?>>Pound Sterling</option>
				<option value="SGD" <?php byrd_select($this->currency_code, 'SGD'); ?>>Singapore Dollar</option>
				<option value="SEK" <?php byrd_select($this->currency_code, 'SEK'); ?>>Swedish Krona</option>
				<option value="CHF" <?php byrd_select($this->currency_code, 'CHF'); ?>>Swiss Franc</option>
				<option value="TWD" <?php byrd_select($this->currency_code, 'TWD'); ?>>Taiwan New Dollar</option>
				<option value="THB" <?php byrd_select($this->currency_code, 'THB'); ?>>Thai Baht</option>
				
			</select>
			
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			The currency of prices for trial periods and the subscription. The default is USD.
			<BR/>For allowable values, see Currency Codes.
			</td>
		</tr>
		<tr>
			<td><label for="buy_button">Buy Button Text</label></td>
			<td><input class="memelem" id="buy_button" name="buy_button" type="text" size="20" value="<?php echo $this->buy_button; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">
			What is the buy now button going to say?
			</td>
		</tr>
		<tr>
			<td><label for="p3">Duration</label></td>
			<td>
			<input class="memelem" id="p3" name="p3" type="text" size="20" value="<?php echo $this->p3; ?>" />
			<select class="memelem" id="t3" name="t3">
				<option <?php if ($this->t3 == 'D')echo 'selected'; ?>>D</option>
				<option <?php if ($this->t3 == 'W')echo 'selected'; ?>>W</option>
				<option <?php if ($this->t3 == 'M')echo 'selected'; ?>>M</option>
				<option <?php if ($this->t3 == 'Y')echo 'selected'; ?>>Y</option>
				
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			Subscription duration. Specify an integer value in the allowable range for the units of duration that you specify with t3.
			Regular subscription units of duration. Allowable values:
			<BR/>D - for days; allowable range for p3 is 1 to 90
			<BR/>W - for weeks; allowable range for p3 is 1 to 52
			<BR/>M - for months; allowable range for p3 is 1 to 24
			<BR/>Y - for years; allowable range for p3 is 1 to 5
			</td>
		</tr>
		
		<tr>
			<td><label for="a1">Trial period 1 price</label></td>
			<td><input class="memelem" id="a1" name="a1" type="text" size="30" value="<?php echo $this->a1; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">Trial period 1 price. For a free trial period, specify 0.</td>
		</tr>
		<tr>
			<td><label for="p1">Trial period 1 duration</label></td>
			<td><input class="memelem" id="p1" name="p1" type="text" size="20" value="<?php echo $this->p1; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">Trial period 1 duration. Required if you specify a1. Specify an integer value in the allowable range for the units of duration that you specify with t1.</td>
		</tr>
		<tr>
			<td><label for="t1">Trial period 1 units of duration</label></td>
			<td><select class="memelem" id="t1" name="t1">
				<option <?php if ($this->t1 == 'D')echo 'selected'; ?>>D</option>
				<option <?php if ($this->t1 == 'W')echo 'selected'; ?>>W</option>
				<option <?php if ($this->t1 == 'M')echo 'selected'; ?>>M</option>
				<option <?php if ($this->t1 == 'Y')echo 'selected'; ?>>Y</option>
				
			</select></td>
			</tr><tr><td colspan="2" class="paypalinfo">Trial period 1 units of duration. Required if you specify a1. Allowable values:
			<BR/>D - for days; allowable range for p1 is 1 to 90
			<BR/>W - for weeks; allowable range for p1 is 1 to 52
			<BR/>M - for months; allowable range for p1 is 1 to 24
			<BR/>Y - for years; allowable range for p1 is 1 to 5</td>
		</tr>
		
		<tr>
			<td><label for="a2">Trial period 2 price</label></td>
			<td><input class="memelem" id="a2" name="a2" type="text" size="30" value="<?php echo $this->a2; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">Trial period 2 price. Can be specified only if you also specify a1.</td>
		</tr>
		<tr>
			<td><label for="p2">Trial period 2 duration</label></td>
			<td><input class="memelem" id="p2" name="p2" type="text" size="20" value="<?php echo $this->p2; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">Trial period 2 duration. Required if you specify a2. Specify an integer value in the allowable range for the units of duration that you specify with t2.</td>
		</tr>
		<tr>
			<td><label for="t2">Trial period 2 units of duration</label></td>
			<td><select class="memelem" id="t2" name="t2">
				<option <?php if ($this->t2 == 'D')echo 'selected'; ?>>D</option>
				<option <?php if ($this->t2 == 'W')echo 'selected'; ?>>W</option>
				<option <?php if ($this->t2 == 'M')echo 'selected'; ?>>M</option>
				<option <?php if ($this->t2 == 'Y')echo 'selected'; ?>>Y</option>
				
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">Trial period 2 units of duration. Allowable values:
			<BR/>D - for days; allowable range for p2 is 1 to 90
			<BR/>W - for weeks; allowable range for p2 is 1 to 52
			<BR/>M - for months; allowable range for p2 is 1 to 24
			<BR/>Y - for years; allowable range for p2 is 1 to 5</td>
		</tr>
		
		<tr>
			<td><label for="src">Recurring payments</label></td>
			<td>
			<select id="src" name="src">
				<option <?php if ($this->src == '1')echo 'selected'; ?> value="1">Subscription payments recur</option>
				<option <?php if ($this->src == '0')echo 'selected'; ?> value="0">Subscription payments do not recur</option>
				
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			Recurring payments. Subscription payments recur unless subscribers cancel their subscriptions before the end of the current billing cycle or you limit the number of times that payments recur with the value that you specify for srt.
			<BR/>Allowable values:
			<BR/>0 - subscription payments do not recur
			<BR/>true - subscription payments recur
			<BR/>The default is 0.
			</td>
		</tr>
		<tr>
			<td><label for="srt">Recurring times</label></td>
			<td><input id="srt" name="srt" type="text" size="20" value="<?php echo $this->srt; ?>" /></td>
			</tr><tr><td colspan="2" class="paypalinfo">
			Recurring times. Number of times that subscription payments recur. Specify an integer above 1. Valid only if you specify at least 1.
			</td>
		</tr>
		 
		<tr>
			<td><label for="invoice">Invoice</label></td>
			<td><input class="memelem" id="invoice" name="invoice" type="text" size="20" value="<?php echo $this->invoice; ?>" /></td>
		</tr><tr>
			<td colspan="2" class="paypalinfo">
			User-defined field which must be unique with each subscription. The invoice number will be shown to subscribers with the other details of their transactions
			</td>
		</tr>
		<tr>
			<td><label for="modify">Modification behavior</label></td>
			<td><select class="memelem" id="modify" name="modify">
				<option <?php byrd_select($this->modify, '0'); ?> value="0">New Subscriptions Only</option>
				<option <?php byrd_select($this->modify, '1'); ?> value="1">Modify and New Subscriptions</option>
				<option <?php byrd_select($this->modify, '2'); ?> value="2">Modify Subscriptions Only</option>
			</select>
			</td>
			</tr><tr><td colspan="2" class="paypalinfo">
			Modification behavior. Allowable values:
			<BR/>0 - allows subscribers to only create new subscriptions
			<BR/>1 - allows subscribers to modify their current subscriptions or sign up for new ones
			<BR/>2 - allows subscribers to only modify their current subscriptions
			<BR/>The default value is 0.
			<BR/>For more information, see Working With Modify Subscription Buttons.
		</td>
		</tr>
	</table>
	
	<input class="memelem" id="itemid" name="itemid" type="hidden" value="<?php echo $this->itemid; ?>" />
	
	