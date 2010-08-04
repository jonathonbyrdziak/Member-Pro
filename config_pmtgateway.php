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
<h2>Paypal Configurations</h2>
	<p>I have tried to include all of the options possible in this first version of this software. If you need anything specific, let me know.</p>	
	<table>
		<tr>
			<td width="200"><label for="business">Paypal Email</label></td>
			<td><input id="business" name="business" type="text" size="50" value="<?php echo $this->business; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">Your PayPal ID or an email address associated with your PayPal account. Email addresses must be confirmed.</td>
		</tr>
		<tr>
			<td><label for="pp_sandbox">Sandbox Mode</label></td>
			<td><input <?php byrd_checkbox( $this->pp_sandbox ); ?> id="pp_sandbox" name="pp_sandbox" type="checkbox" class="pp_large" /></td>
		</tr><tr> 
			<td colspan="2" class="paypalinfo">
			Check this after setting up a test account <a href="https://developer.paypal.com/">developer.paypal.com</a>
			You shouldn't need to test this with a paypal developer account. I've already done extensive testing, the developer accounts are mostly for ironing out the bugs. You should just have a friend subscribe for a penny on a live account as a final test.
			</td>
		</tr>
		
		<tr>
			<td><label for="page_style">Payment page style</label></td>
			<td><select id="page_style" name="page_style">
				<option <?php if ($this->page_style == 'paypal') echo 'selected'; ?>>paypal</option>
				<option <?php if ($this->page_style == 'primary') echo 'selected'; ?>>primary</option>
				<option <?php if ($this->page_style == 'page_style_name') echo 'selected'; ?>>page_style_name</option>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The custom payment page style for checkout pages. Allowable values:
			<br/>paypal - use the PayPal page style
			<br/>primary - use the page style that you marked as primary in your account profile
			<br/>page_style_name - use the custom payment page style from your account profile that has the specified name
			<br/>The default is primary if you added a custom payment page style to your account profile. Otherwise, the default is paypal.
			</td>
		</tr>
		<tr>
			<td><label for="image_url">Header Image Url</label></td>
			<td><input id="image_url" name="image_url" type="text" size="20" value="<?php echo $this->image_url; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The URL of the 150x50-pixel image displayed as your logo in the upper left corner of the PayPal checkout pages.
			<br/>Default - Your business name, if you have a Business account, or your email address, if you have Premier or Personal account.
			</td>
		</tr>
		<tr>
			<td><label for="cpp_header_image">Header Image</label></td>
			<td><input id="cpp_header_image" name="cpp_header_image" type="text" size="20" value="<?php echo $this->cpp_header_image; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The image at the top left of the checkout page. The image's maximum size is 750 pixels wide by 90 pixels high. PayPal recommends that you provide an image that is stored only on a secure (https) server.
			<br/>For more information, see Co-Branding the PayPal Checkout Pages.
			</td>
		</tr>
		<tr>
			<td><label for="cpp_headerback_color">Header BG Color</label></td>
			<td><input id="cpp_headerback_color" name="cpp_headerback_color" type="text" size="20" value="<?php echo $this->cpp_headerback_color; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The background color for the header of the checkout page. Valid value is case-insensitive six-character HTML hexadecimal color code in ASCII.
			</td>
		</tr>
		<tr>
			<td><label for="cpp_headerborder_color">Header Border Color</label></td>
			<td><input id="cpp_headerborder_color" name="cpp_headerborder_color" type="text" size="20" value="<?php echo $this->cpp_headerborder_color; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The border color around the header of the checkout page. The border is a 2-pixel perimeter around the header space, which has a maximum size of 750 pixels wide by 90 pixels high.
			<br/>Valid value is case-insensitive six-character HTML hexadecimal color code in ASCII.
			</td>
		</tr>
		<tr>
			<td><label for="cpp_payflow_color">Background Color First</label></td>
			<td><input id="cpp_payflow_color" name="cpp_payflow_color" type="text" size="20" value="<?php echo $this->cpp_payflow_color; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The background color for the checkout page below the header. Valid value is case-insensitive six-character HTML hexadecimal color code in ASCII.
			<br/><b>NOTE:</b> Background colors that conflict with PayPal's error messages are not allowed; in these cases, the default color is white.
			</td>
		</tr>
		<tr>
			<td><label for="cs">Background Color Second</label></td>
			<td><input id="cs" name="cs" type="checkbox" <?php byrd_checkbox( $this->cs ); ?> /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The background color of the checkout page. Allowable values:
			<br/>0 - background color is white
			<br/>checked - background color is black
			<br/>The default is 0.
			</td>
		</tr>
		<tr>
			<td><label for="lc">Language</label></td>
			<td><select id="lc" name="lc">
			<option value="en_AL">Albania - English</option> 
		<option value="en_DZ">Algeria - English</option> 
		<option value="en_AD">Andorra - English</option> 
		<option value="en_AO">Angola - English</option> 
		<option value="en_AI">Anguilla - English</option> 
		<option value="en_AG">Antigua and Barbuda - English</option> 
		<option value="en_AR">Argentina - English</option> 
		<option value="en_AM">Armenia - English</option> 
		<option value="en_AW">Aruba - English</option> 
		<option value="en_AU">Australia - Australian English</option> 
		<option value="de_AT">Austria - German</option> 
		<option value="en_AT">Austria - English</option> 
		<option value="en_AZ">Azerbaijan Republic - English</option> 
		<option value="en_BS">Bahamas - English</option> 
		<option value="en_BH">Bahrain - English</option> 
		<option value="en_BB">Barbados - English</option> 
		<option value="en_BE">Belgium - English</option> 
		<option value="nl_BE">Belgium - Dutch</option> 
		<option value="fr_BE">Belgium - French</option> 
		<option value="en_BZ">Belize - English</option> 
		<option value="en_BJ">Benin - English</option> 
		<option value="en_BM">Bermuda - English</option> 
		<option value="en_BT">Bhutan - English</option> 
		<option value="en_BO">Bolivia - English</option> 
		<option value="en_BA">Bosnia and Herzegovina - English</option> 
		<option value="en_BW">Botswana - English</option> 
		<option value="en_BR">Brazil - English</option> 
		<option value="en_VG">British Virgin Islands - English</option> 
		<option value="en_BN">Brunei - English</option> 
		<option value="en_BG">Bulgaria - English</option> 
		<option value="en_BF">Burkina Faso - English</option> 
		<option value="en_BI">Burundi - English</option> 
		<option value="en_KH">Cambodia - English</option> 
		<option value="en_CA">Canada - English</option> 
		<option value="fr_CA">Canada - French</option> 
		<option value="en_CV">Cape Verde - English</option> 
		<option value="en_KY">Cayman Islands - English</option> 
		<option value="en_TD">Chad - English</option> 
		<option value="en_CL">Chile - English</option> 
		<option value="en_C2">China - English</option> 
		<option value="zh_C2">China - Simplified Chinese</option> 
		<option value="en_CO">Colombia - English</option> 
		<option value="en_KM">Comoros - English</option> 
		<option value="en_CK">Cook Islands - English</option> 
		<option value="en_CR">Costa Rica - English</option> 
		<option value="en_HR">Croatia - English</option> 
		<option value="en_CY">Cyprus - English</option> 
		<option value="en_CZ">Czech Republic - English</option> 
		<option value="en_CD">Democratic Republic of the Congo - English</option> 
		<option value="en_DK">Denmark - English</option> 
		<option value="en_DJ">Djibouti - English</option> 
		<option value="en_DM">Dominica - English</option> 
		<option value="en_DO">Dominican Republic - English</option> 
		<option value="en_EC">Ecuador - English</option> 
		<option value="en_SV">El Salvador - English</option> 
		<option value="en_ER">Eritrea - English</option> 
		<option value="en_EE">Estonia - English</option> 
		<option value="en_ET">Ethiopia - English</option> 
		<option value="en_FK">Falkland Islands - English</option> 
		<option value="en_FO">Faroe Islands - English</option> 
		<option value="en_FM">Federated States of Micronesia - English</option> 
		<option value="en_FJ">Fiji - English</option> 
		<option value="en_FI">Finland - English</option> 
		<option value="fr_FR">France - French</option> 
		<option value="en_FR">France - English</option> 
		<option value="en_GF">French Guiana - English</option> 
		<option value="en_PF">French Polynesia - English</option> 
		<option value="en_GA">Gabon Republic - English</option> 
		<option value="en_GM">Gambia - English</option> 
		<option value="de_DE">Germany - German</option> 
		<option value="en_DE">Germany - English</option> 
		<option value="en_GI">Gibraltar - English</option> 
		<option value="en_GR">Greece - English</option> 
		<option value="en_GL">Greenland - English</option> 
		<option value="en_GD">Grenada - English</option> 
		<option value="en_GP">Guadeloupe - English</option> 
		<option value="en_GT">Guatemala - English</option> 
		<option value="en_GN">Guinea - English</option> 
		<option value="en_GW">Guinea Bissau - English</option> 
		<option value="en_GY">Guyana - English</option> 
		<option value="en_HN">Honduras - English</option> 
		<option value="zh_HK">Hong Kong - Traditional Chinese</option> 
		<option value="en_HK">Hong Kong - English</option> 
		<option value="en_HU">Hungary - English</option> 
		<option value="en_IS">Iceland - English</option> 
		<option value="en_IN">India - English</option> 
		<option value="en_ID">Indonesia - English</option> 
		<option value="en_IE">Ireland - English</option> 
		<option value="en_IL">Israel - English</option> 
		<option value="it_IT">Italy - Italian</option> 
		<option value="en_IT">Italy - English</option> 
		<option value="en_JM">Jamaica - English</option> 
		<option value="ja_JP">Japan - Japanese</option> 
		<option value="en_JP">Japan - English</option> 
		<option value="en_JO">Jordan - English</option> 
		<option value="en_KZ">Kazakhstan - English</option> 
		<option value="en_KE">Kenya - English</option> 
		<option value="en_KI">Kiribati - English</option> 
		<option value="en_KW">Kuwait - English</option> 
		<option value="en_KG">Kyrgyzstan - English</option> 
		<option value="en_LA">Laos - English</option> 
		<option value="en_LV">Latvia - English</option> 
		<option value="en_LS">Lesotho - English</option> 
		<option value="en_LI">Liechtenstein - English</option> 
		<option value="en_LT">Lithuania - English</option> 
		<option value="en_LU">Luxembourg - English</option> 
		<option value="en_MG">Madagascar - English</option> 
		<option value="en_MW">Malawi - English</option> 
		<option value="en_MY">Malaysia - English</option> 
		<option value="en_MV">Maldives - English</option> 
		<option value="en_ML">Mali - English</option> 
		<option value="en_MT">Malta - English</option> 
		<option value="en_MH">Marshall Islands - English</option> 
		<option value="en_MQ">Martinique - English</option> 
		<option value="en_MR">Mauritania - English</option> 
		<option value="en_MU">Mauritius - English</option> 
		<option value="en_YT">Mayotte - English</option> 
		<option value="es_MX">Mexico - Spanish</option> 
		<option value="en_MX">Mexico - English</option> 
		<option value="en_MN">Mongolia - English</option> 
		<option value="en_MS">Montserrat - English</option> 
		<option value="en_MA">Morocco - English</option> 
		<option value="en_MZ">Mozambique - English</option> 
		<option value="en_NA">Namibia - English</option> 
		<option value="en_NR">Nauru - English</option> 
		<option value="en_NP">Nepal - English</option> 
		<option value="nl_NL">Netherlands - Dutch</option> 
		<option value="en_NL">Netherlands - English</option> 
		<option value="en_AN">Netherlands Antilles - English</option> 
		<option value="en_NC">New Caledonia - English</option> 
		<option value="en_NZ">New Zealand - English</option> 
		<option value="en_NI">Nicaragua - English</option> 
		<option value="en_NE">Niger - English</option> 
		<option value="en_NU">Niue - English</option> 
		<option value="en_NF">Norfolk Island - English</option> 
		<option value="en_NO">Norway - English</option> 
		<option value="en_OM">Oman - English</option> 
		<option value="en_PW">Palau - English</option> 
		<option value="en_PA">Panama - English</option> 
		<option value="en_PG">Papua New Guinea - English</option> 
		<option value="en_PE">Peru - English</option> 
		<option value="en_PH">Philippines - English</option> 
		<option value="en_PN">Pitcairn Islands - English</option> 
		<option value="pl_PL">Poland - Polish</option> 
		<option value="en_PL">Poland - English</option> 
		<option value="en_PT">Portugal - English</option> 
		<option value="en_QA">Qatar - English</option> 
		<option value="en_CG">Republic of the Congo - English</option> 
		<option value="en_RE">Reunion - English</option> 
		<option value="en_RO">Romania - English</option> 
		<option value="en_RU">Russia - English</option> 
		<option value="en_RW">Rwanda - English</option> 
		<option value="en_VC">Saint Vincent and the Grenadines - English</option> 
		<option value="en_WS">Samoa - English</option> 
		<option value="en_SM">San Marino - English</option> 
		<option value="en_ST">São Tomé and Príncipe - English</option> 
		<option value="en_SA">Saudi Arabia - English</option> 
		<option value="en_SN">Senegal - English</option> 
		<option value="en_SC">Seychelles - English</option> 
		<option value="en_SL">Sierra Leone - English</option> 
		<option value="en_SG">Singapore - English</option> 
		<option value="en_SK">Slovakia - English</option> 
		<option value="en_SI">Slovenia - English</option> 
		<option value="en_SB">Solomon Islands - English</option> 
		<option value="en_SO">Somalia - English</option> 
		<option value="en_ZA">South Africa - English</option> 
		<option value="en_KR">South Korea - English</option> 
		<option value="es_ES">Spain - Spanish</option> 
		<option value="en_ES">Spain - English</option> 
		<option value="en_LK">Sri Lanka - English</option> 
		<option value="en_SH">St. Helena - English</option> 
		<option value="en_KN">St. Kitts and Nevis - English</option> 
		<option value="en_LC">St. Lucia - English</option> 
		<option value="en_PM">St. Pierre and Miquelon - English</option> 
		<option value="en_SR">Suriname - English</option> 
		<option value="en_SJ">Svalbard and Jan Mayen Islands - English</option> 
		<option value="en_SZ">Swaziland - English</option> 
		<option value="en_SE">Sweden - English</option> 
		<option value="de_CH">Switzerland - German</option> 
		<option value="fr_CH">Switzerland - French</option> 
		<option value="en_CH">Switzerland - English</option> 
		<option value="en_TW">Taiwan - English</option> 
		<option value="en_TJ">Tajikistan - English</option> 
		<option value="en_TZ">Tanzania - English</option> 
		<option value="en_TH">Thailand - English</option> 
		<option value="en_TG">Togo - English</option> 
		<option value="en_TO">Tonga - English</option> 
		<option value="en_TT">Trinidad and Tobago - English</option> 
		<option value="en_TN">Tunisia - English</option> 
		<option value="en_TR">Turkey - English</option> 
		<option value="en_TM">Turkmenistan - English</option> 
		<option value="en_TC">Turks and Caicos Islands - English</option> 
		<option value="en_TV">Tuvalu - English</option> 
		<option value="en_UG">Uganda - English</option> 
		<option value="en_UA">Ukraine - English</option> 
		<option value="en_AE">United Arab Emirates - English</option> 
		<option value="en_GB">United Kingdom - English</option> 
		<option value="en_US" selected>United States - English</option> 
		<option value="fr_US">United States - French</option> 
		<option value="es_US">United States - Spanish</option> 
		<option value="zh_US">United States - Simplified Chinese</option> 
		<option value="en_UY">Uruguay - English</option> 
		<option value="en_VU">Vanuatu - English</option> 
		<option value="en_VA">Vatican City State - English</option> 
		<option value="en_VE">Venezuela - English</option> 
		<option value="en_VN">Vietnam - English</option> 
		<option value="en_WF">Wallis and Futuna Islands - English</option> 
		<option value="en_YE">Yemen - English</option> 
		<option value="en_ZM">Zambia - English</option> 
		<option value="en_GB">International</option> 
		<option value="en_AL">Albania - English</option> 
		<option value="en_DZ">Algeria - English</option> 
		<option value="en_AD">Andorra - English</option> 
		<option value="en_AO">Angola - English</option> 
		<option value="en_AI">Anguilla - English</option> 
		<option value="en_AG">Antigua and Barbuda - English</option> 
		<option value="en_AR">Argentina - English</option> 
		<option value="en_AM">Armenia - English</option> 
		<option value="en_AW">Aruba - English</option> 
		<option value="en_AU">Australia - Australian English</option> 
		<option value="de_AT">Austria - German</option> 
		<option value="en_AT">Austria - English</option> 
		<option value="en_AZ">Azerbaijan Republic - English</option> 
		<option value="en_BS">Bahamas - English</option> 
		<option value="en_BH">Bahrain - English</option> 
		<option value="en_BB">Barbados - English</option> 
		<option value="en_BE">Belgium - English</option> 
		<option value="nl_BE">Belgium - Dutch</option> 
		<option value="fr_BE">Belgium - French</option> 
		<option value="en_BZ">Belize - English</option> 
		<option value="en_BJ">Benin - English</option> 
		<option value="en_BM">Bermuda - English</option> 
		<option value="en_BT">Bhutan - English</option> 
		<option value="en_BO">Bolivia - English</option> 
		<option value="en_BA">Bosnia and Herzegovina - English</option> 
		<option value="en_BW">Botswana - English</option> 
		<option value="en_BR">Brazil - English</option> 
		<option value="en_VG">British Virgin Islands - English</option> 
		<option value="en_BN">Brunei - English</option> 
		<option value="en_BG">Bulgaria - English</option> 
		<option value="en_BF">Burkina Faso - English</option> 
		<option value="en_BI">Burundi - English</option> 
		<option value="en_KH">Cambodia - English</option> 
		<option value="en_CA">Canada - English</option> 
		<option value="fr_CA">Canada - French</option> 
		<option value="en_CV">Cape Verde - English</option> 
		<option value="en_KY">Cayman Islands - English</option> 
		<option value="en_TD">Chad - English</option> 
		<option value="en_CL">Chile - English</option> 
		<option value="en_C2">China - English</option> 
		<option value="zh_C2">China - Simplified Chinese</option> 
		<option value="en_CO">Colombia - English</option> 
		<option value="en_KM">Comoros - English</option> 
		<option value="en_CK">Cook Islands - English</option> 
		<option value="en_CR">Costa Rica - English</option> 
		<option value="en_HR">Croatia - English</option> 
		<option value="en_CY">Cyprus - English</option> 
		<option value="en_CZ">Czech Republic - English</option> 
		<option value="en_CD">Democratic Republic of the Congo - English</option> 
		<option value="en_DK">Denmark - English</option> 
		<option value="en_DJ">Djibouti - English</option> 
		<option value="en_DM">Dominica - English</option> 
		<option value="en_DO">Dominican Republic - English</option> 
		<option value="en_EC">Ecuador - English</option> 
		<option value="en_SV">El Salvador - English</option> 
		<option value="en_ER">Eritrea - English</option> 
		<option value="en_EE">Estonia - English</option> 
		<option value="en_ET">Ethiopia - English</option> 
		<option value="en_FK">Falkland Islands - English</option> 
		<option value="en_FO">Faroe Islands - English</option> 
		<option value="en_FM">Federated States of Micronesia - English</option> 
		<option value="en_FJ">Fiji - English</option> 
		<option value="en_FI">Finland - English</option> 
		<option value="fr_FR">France - French</option> 
		<option value="en_FR">France - English</option> 
		<option value="en_GF">French Guiana - English</option> 
		<option value="en_PF">French Polynesia - English</option> 
		<option value="en_GA">Gabon Republic - English</option> 
		<option value="en_GM">Gambia - English</option> 
		<option value="de_DE">Germany - German</option> 
		<option value="en_DE">Germany - English</option> 
		<option value="en_GI">Gibraltar - English</option> 
		<option value="en_GR">Greece - English</option> 
		<option value="en_GL">Greenland - English</option> 
		<option value="en_GD">Grenada - English</option> 
		<option value="en_GP">Guadeloupe - English</option> 
		<option value="en_GT">Guatemala - English</option> 
		<option value="en_GN">Guinea - English</option> 
		<option value="en_GW">Guinea Bissau - English</option> 
		<option value="en_GY">Guyana - English</option> 
		<option value="en_HN">Honduras - English</option> 
		<option value="zh_HK">Hong Kong - Traditional Chinese</option> 
		<option value="en_HK">Hong Kong - English</option> 
		<option value="en_HU">Hungary - English</option> 
		<option value="en_IS">Iceland - English</option> 
		<option value="en_IN">India - English</option> 
		<option value="en_ID">Indonesia - English</option> 
		<option value="en_IE">Ireland - English</option> 
		<option value="en_IL">Israel - English</option> 
		<option value="it_IT">Italy - Italian</option> 
		<option value="en_IT">Italy - English</option> 
		<option value="en_JM">Jamaica - English</option> 
		<option value="ja_JP">Japan - Japanese</option> 
		<option value="en_JP">Japan - English</option> 
		<option value="en_JO">Jordan - English</option> 
		<option value="en_KZ">Kazakhstan - English</option> 
		<option value="en_KE">Kenya - English</option> 
		<option value="en_KI">Kiribati - English</option> 
		<option value="en_KW">Kuwait - English</option> 
		<option value="en_KG">Kyrgyzstan - English</option> 
		<option value="en_LA">Laos - English</option> 
		<option value="en_LV">Latvia - English</option> 
		<option value="en_LS">Lesotho - English</option> 
		<option value="en_LI">Liechtenstein - English</option> 
		<option value="en_LT">Lithuania - English</option> 
		<option value="en_LU">Luxembourg - English</option> 
		<option value="en_MG">Madagascar - English</option> 
		<option value="en_MW">Malawi - English</option> 
		<option value="en_MY">Malaysia - English</option> 
		<option value="en_MV">Maldives - English</option> 
		<option value="en_ML">Mali - English</option> 
		<option value="en_MT">Malta - English</option> 
		<option value="en_MH">Marshall Islands - English</option> 
		<option value="en_MQ">Martinique - English</option> 
		<option value="en_MR">Mauritania - English</option> 
		<option value="en_MU">Mauritius - English</option> 
		<option value="en_YT">Mayotte - English</option> 
		<option value="es_MX">Mexico - Spanish</option> 
		<option value="en_MX">Mexico - English</option> 
		<option value="en_MN">Mongolia - English</option> 
		<option value="en_MS">Montserrat - English</option> 
		<option value="en_MA">Morocco - English</option> 
		<option value="en_MZ">Mozambique - English</option> 
		<option value="en_NA">Namibia - English</option> 
		<option value="en_NR">Nauru - English</option> 
		<option value="en_NP">Nepal - English</option> 
		<option value="nl_NL">Netherlands - Dutch</option> 
		<option value="en_NL">Netherlands - English</option> 
		<option value="en_AN">Netherlands Antilles - English</option> 
		<option value="en_NC">New Caledonia - English</option> 
		<option value="en_NZ">New Zealand - English</option> 
		<option value="en_NI">Nicaragua - English</option> 
		<option value="en_NE">Niger - English</option> 
		<option value="en_NU">Niue - English</option> 
		<option value="en_NF">Norfolk Island - English</option> 
		<option value="en_NO">Norway - English</option> 
		<option value="en_OM">Oman - English</option> 
		<option value="en_PW">Palau - English</option> 
		<option value="en_PA">Panama - English</option> 
		<option value="en_PG">Papua New Guinea - English</option> 
		<option value="en_PE">Peru - English</option> 
		<option value="en_PH">Philippines - English</option> 
		<option value="en_PN">Pitcairn Islands - English</option> 
		<option value="pl_PL">Poland - Polish</option> 
		<option value="en_PL">Poland - English</option> 
		<option value="en_PT">Portugal - English</option> 
		<option value="en_QA">Qatar - English</option> 
		<option value="en_CG">Republic of the Congo - English</option> 
		<option value="en_RE">Reunion - English</option> 
		<option value="en_RO">Romania - English</option> 
		<option value="en_RU">Russia - English</option> 
		<option value="en_RW">Rwanda - English</option> 
		<option value="en_VC">Saint Vincent and the Grenadines - English</option> 
		<option value="en_WS">Samoa - English</option> 
		<option value="en_SM">San Marino - English</option> 
		<option value="en_ST">São Tomé and Príncipe - English</option> 
		<option value="en_SA">Saudi Arabia - English</option> 
		<option value="en_SN">Senegal - English</option> 
		<option value="en_SC">Seychelles - English</option> 
		<option value="en_SL">Sierra Leone - English</option> 
		<option value="en_SG">Singapore - English</option> 
		<option value="en_SK">Slovakia - English</option> 
		<option value="en_SI">Slovenia - English</option> 
		<option value="en_SB">Solomon Islands - English</option> 
		<option value="en_SO">Somalia - English</option> 
		<option value="en_ZA">South Africa - English</option> 
		<option value="en_KR">South Korea - English</option> 
		<option value="es_ES">Spain - Spanish</option> 
		<option value="en_ES">Spain - English</option> 
		<option value="en_LK">Sri Lanka - English</option> 
		<option value="en_SH">St. Helena - English</option> 
		<option value="en_KN">St. Kitts and Nevis - English</option> 
		<option value="en_LC">St. Lucia - English</option> 
		<option value="en_PM">St. Pierre and Miquelon - English</option> 
		<option value="en_SR">Suriname - English</option> 
		<option value="en_SJ">Svalbard and Jan Mayen Islands - English</option> 
		<option value="en_SZ">Swaziland - English</option> 
		<option value="en_SE">Sweden - English</option> 
		<option value="de_CH">Switzerland - German</option> 
		<option value="fr_CH">Switzerland - French</option> 
		<option value="en_CH">Switzerland - English</option> 
		<option value="en_TW">Taiwan - English</option> 
		<option value="en_TJ">Tajikistan - English</option> 
		<option value="en_TZ">Tanzania - English</option> 
		<option value="en_TH">Thailand - English</option> 
		<option value="en_TG">Togo - English</option> 
		<option value="en_TO">Tonga - English</option> 
		<option value="en_TT">Trinidad and Tobago - English</option> 
		<option value="en_TN">Tunisia - English</option> 
		<option value="en_TR">Turkey - English</option> 
		<option value="en_TM">Turkmenistan - English</option> 
		<option value="en_TC">Turks and Caicos Islands - English</option> 
		<option value="en_TV">Tuvalu - English</option> 
		<option value="en_UG">Uganda - English</option> 
		<option value="en_UA">Ukraine - English</option> 
		<option value="en_AE">United Arab Emirates - English</option> 
		<option value="en_GB">United Kingdom - English</option> 
		<option value="en_US" selected>United States - English</option> 
		<option value="fr_US">United States - French</option> 
		<option value="es_US">United States - Spanish</option> 
		<option value="zh_US">United States - Simplified Chinese</option> 
		<option value="en_UY">Uruguay - English</option> 
		<option value="en_VU">Vanuatu - English</option> 
		<option value="en_VA">Vatican City State - English</option> 
		<option value="en_VE">Venezuela - English</option> 
		<option value="en_VN">Vietnam - English</option> 
		<option value="en_WF">Wallis and Futuna Islands - English</option> 
		<option value="en_YE">Yemen - English</option> 
		<option value="en_ZM">Zambia - English</option> 
		<option value="en_GB">International</option>
		</select></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The language of the login or sign-up page that subscribers see when they click the Subscribe button. If unspecified, the language is determined by a PayPal cookie in the subscriber's browser. If there is no PayPal cookie, the default language is U.S. English.
			<br/>For allowable values, see .
			</td>
		</tr>
		<tr>
			<td><label for="sra">Reattempt on failure</label></td>
			<td><input id="sra" name="sra" type="checkbox" <?php $this->clicked( $this->sra ); ?> /></td>
			</tr><tr><td colspan="2" class="paypalinfo">
			Reattempt on failure. If a recurring payment fails, PayPal attempts to collect the payment two more times before canceling the subscription.
			<BR/>Allowable values:
			<BR/>0 - do not reattempt failed recurring payments
			<BR/>checked - reattempt failed recurring payments before canceling
			<BR/>The default is checked.
			<BR/>For more information, see Reattempting Failed Recurring Payments With Subscribe Buttons.
			</td>
		</tr>
		
		<tr>
			<td><label for="no_note">Enable Notes to Seller</label></td>
			<td><input id="no_note" name="no_note" type="checkbox" <?php byrd_checkbox( $this->no_note ); ?> /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			Do not prompt payers to include a note with their payments. Allowable values:
			<br/>0 - provide a text box and prompt for the note
			<br/>checked - hide the text box and the prompt
			<br/>The default is 0.
			</td>
		</tr>
		<tr>
			<td><label for="cn">Note Field Label</label></td>
			<td><input id="cn" name="cn" type="text" size="50" value="<?php echo $this->cn; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			Label that appears above the note field. This value is not saved and will not appear in any of your notifications. If omitted, the default label above the note field is "Add special instructions to merchant." The cn variable is not valid with Subscribe buttons or if you include no_note="1".
			</td>
		</tr>
		<tr>
			<td><label for="no_shipping">Shipping Values</label></td>
			<td><select id="no_shipping" name="no_shipping">
				<option <?php byrd_select($this->no_shipping, '0'); ?> value="0">Prompt but not required</option>
				<option <?php byrd_select($this->no_shipping, '1'); ?> value="1">Do not prompt</option>
				<option <?php byrd_select($this->no_shipping, '2'); ?> value="2">Prompt and is required</option>
			</select></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			Do not prompt payers for shipping address. Allowable values:
			<br/>0 - prompt for an address, but do not require one
			<br/>1 - do not prompt for an address
			<br/>2 - prompt for an address, and require one
			<br/>The default is 0.
			</td>
		</tr>
		<tr>
			<td><label for="rm">Return Method</label></td>
			<td><select id="rm" name="rm">
				<option <?php byrd_select($this->rm, '0'); ?> value="0">GET</option>
				<option <?php byrd_select($this->rm, '1'); ?> value="1">None</option>
				<option <?php byrd_select($this->rm, '2'); ?> value="2">POST</option>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			Return method. The FORM METHOD used to send data to the URL specified by the return variable after payment completion. Allowable values:
			<br/>0 - all shopping cart transactions use the GET method
			<br/>1 - the payer's browser is redirected to the return URL by the GET method, and no transaction variables are sent
			<br/>2 - the payer's browser is redirected to the return URL by the POST method, and all transaction variables are also posted
			<br/>The default is 0.
			<br/><b>NOTE:</b> The rm variable takes effect only if the return variable is also set.
			</td>
		</tr>
		<tr>
			<td><label for="cbt">Return to Merchant Text</label></td>
			<td><input id="cbt" name="cbt" type="text" size="50" value="<?php echo $this->cbt; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			Sets the text for the Return to Merchant button on the PayPal Payment Complete page. For Business accounts, the return button displays your business name in place of the word "Merchant" by default. For Donate buttons, the text reads "Return to donations coordinator" by default.
			<br/><b>NOTE:</b> The return variable must also be set.
			</td>
		</tr>
		<tr>
			<td><label for="return">Return Url</label></td>
			<td><input id="return" name="return" type="text" size="70" value="<?php echo $this->return; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			The URL to which the payer's browser is redirected after completing the payment; for example, a URL on your site that displays a "Thank you for your payment" page.
			<br/>Default - The browser is redirected to a web page controlled by this plugin.
			</td>
		</tr>
		<tr>
			<td><label for="cancel_return">Cancel Return Url</label></td>
			<td><input id="cancel_return" name="cancel_return" type="text" size="70" value="<?php echo $this->cancel_return; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			A URL to which the payer's browser is redirected if payment is cancelled; for example, a URL on your website that displays a "Payment Canceled" page.
			<br/>Default - The browser is redirected to a web page controlled by this plugin.
			</td>
		</tr>
		<tr>
			<td><label for="notify_url">IPN Url</label></td>
			<td><input id="notify_url" name="notify_url" type="text" size="70" value="<?php echo $this->notify_url; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="paypalinfo">
			<?php echo get_bloginfo( 'wpurl' ); ?>/wp-content/plugins/byrd_rolessubscriptions/ipn.php
			<br/>The URL to which PayPal posts information about the transaction, in the form of Instant Payment Notification messages.
			</td>
		</tr>
		
	</table>