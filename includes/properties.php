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

class byrdPropertiesRoles {
	
	//notifications
	public $_mail_signup = 
'<h3>Thank you for your Subscription to Jonathonbyrd.com</h3>
<p>We\'ve created this account for you:</p>
<p>
Username : _user_name_<BR/>
Password : _password_<BR/>
Email : _payer_email_<BR/>
</p>

<p>You may change all these credentials once you log into the system, except the email address.
The email is used to tie your account to your paypal subscription.</p>

<p>Here\'s the link to login to the Members Only area, just scroll to the bottom of any page and use the login form.
Once you\'ve completed this step, the login will be hidden and your Members Directory will be showing. <a href="http://www.jonathonbyrd.com/">http://www.jonathonbyrd.com/</a></p>';

	public $_mail_renewed = 
'<h3>Subscription Renewal Notice</h3>
<p>Account Renewed:</p>
<p>
Email : _payer_email_<BR/>
</p>

<p>I will do my best to continue to make this service better, if you want to take a minute and reply to this
email with questions, comments or even suggestions, please do. I will definitely read it and get back to you.</p>

<p><a href="http://www.jonathonbyrd.com/">http://www.jonathonbyrd.com/</a></p>';
	
	public $_mail_expired = 
'<h3>Oh No! You let your account expire.</h3>
<p>The following account has been restricted:</p>
<p>
Email : _payer_email_<BR/>
</p>

<p>We will never remove your data from our database, however, when you let your account expire we\'ll no longer
be keeping your reports up to date. If this was an accident, hurry and reinstate your account so that we can begin recording 
data for you again.</p>

<p>If you have any questions or concerns, please reply to this email or visit <a href="http://www.jonathonbyrd.com/">http://www.jonathonbyrd.com/</a></p>';

	public $_mail_canceled = 
'<h3>Sorry to see you go!</h3>
<p>This account has been canceled:</p>
<p>
Email : _payer_email_<BR/>
</p>

<p>Please reply to this email message and let us know why you decided to cancel your subscription.
If I can work to make this service any better, I will!</p>

<p>Visit us anytime, <a href="http://www.jonathonbyrd.com/">http://www.jonathonbyrd.com/</a></p>';
	
	
	public $displayexpirationdata = null;
	public $displayusersaddress = null;
	
	//paypal
	public $business = null;
	public $pp_sandbox = false;
	public $pdttoken = null;
	
	//paypage
	public $page_style = null;
	public $image_url = null;
	public $cpp_header_image = null;
	public $cpp_headerback_color = null;
	public $cpp_headerborder_color = null;
	public $cpp_payflow_color = null;
	public $cs = null;
	public $lc = null;
	public $cn = null;
	public $no_shipping = null;
	public $return = null;			//PDT confirmation page
	public $rm = 2;
	public $cbt = 'View Subscription Confirmation';	//return to merchant text
	public $cancel_return = null;	//No Dont Go!!
	public $no_note = null;			//Do not prompt payers to include a note with their payments. Allowable values for Subscribe buttons:
	public $notify_url = null;		//ipn script
	public $usr_manage = null;	//Set to 1 to have PayPal generate usernames and initial passwords for subscribers.
	
	public $sra = 1;		//Reattempt on failure. If a recurring payment fails, PayPal attempts to collect the payment two more times before canceling the subscription.
	
	/*
	//subscription info
	public $item_name = null;
	public $item_description = null;
	public $item_number = 'Sub-one';
	public $currency_code = 'USD';
	public $src = null;		//Recurring payments. Subscription payments recur unless subscribers cancel their subscriptions before the end of the current billing cycle or you limit the number of times that payments recur with the value that you specify for srt.
	public $srt = null;		//Recurring times. Number of times that subscription payments recur. Specify an integer above 1. Valid only if you specify src="1".
	public $a1 = null; 		//Trial period 1 price. For a free trial period, specify 0.
	public $p1 = null; 		//Trial period 1 duration. Required if you specify a1. Specify an integer value in the allowable range for the units of duration that you specify with t1.
	public $t1 = null;		//Trial period 1 units of duration. Required if you specify a1. Allowable values:
	public $a2 = null;		//Trial period 2 price. Can be specified only if you also specify a1.
	public $p2 = null;		//Trial period 2 duration. Required if you specify a2. Specify an integer value in the allowable range for the units of duration that you specify with t2.
	public $t2 = null;		//Trial period 2 units of duration. Allowable values:
	public $a3 = null;		//Regular subscription price.
	public $p3 = '1';		//Subscription duration. Specify an integer value in the allowable range for the units of duration that you specify with t3.
	public $t3 = 'M';		//Regular subscription units of duration. Allowable values:
	public $custom = null;	//User-defined field which will be passed through the system and returned in your merchant payment notification email. This field will not be shown to your subscribers.
	public $invoice = null;	//User-defined field which must be unique with each subscription. The invoice number will be shown to subscribers with the other details of their transactions
	public $modify = null;	//Modification behavior. Allowable values:
	*/
	
	
	
	/**
	 * A hack to support __construct() on PHP 4
	 *
	 * Hint: descendant classes have no PHP4 class_name() constructors,
	 * so this constructor gets called first and calls the top-layer __construct()
	 * which (if present) should call parent::__construct()
	 *
	 * @access	public
	 * @return	Object
	 */
	function byrdPropertiesRoles()
	{
		$args = func_get_args();
		call_user_func_array(array(&$this, '__construct'), $args);
	}
	
	/**
	 * loads the proper functions
	 * 
	 * @return none
	 */
	function __construct(){
		$this->getOptions();
	}
	
	/**
	 * loops through the properties and binds them to this class
	 * 
	 */
	function getOptions(){
		foreach ($this->getProperties() as $property => $value)
			if (get_option($property)) 
				$this->$property = get_option($property);
	}
	
	/**
	 * loops through and stores theres properties
	 * 
	 */
	function setOptions(){
		if (!isset($_POST['submit'])) return false;
		foreach ($this->getProperties() as $property => $value) 
			update_option($property, $value);
	}

	/* 
	 * catch all function
	 */
	function __call($method,$arguments) {
		switch (substr($method,0,3)){
			case 'get': echo $this->loadTheme($method,$arguments); break;
			case 'scr': echo $this->javaScript($method,$arguments); break;
			case 'css': echo $this->cssLink($method,$arguments); break;
			
		}
		
	}
	
	/**
	 * removes uneeded bits from the loading files
	 * 
	 */
	function optimize($buffer){
		//removes /*/ comments
		$buffer = preg_replace('/(\/\*[\s\S]*?\*\/)/', '', ' '.$buffer);
		//removes // comments
		$buffer = preg_replace('/([ \r\n\t]\/\/.*?[\r\n])/', '
', ' '.$buffer);
		//removes extra spaces and extra line breaks
		//$buffer = str_replace(array("\r\n", "\n\n", "\r", "\t", '  ', '    ', '    '), ' ', $buffer);
		
		$buffer = str_replace('__HTTP__', $this->http(), $buffer);
		//return a clean string
		return $buffer;
	}
	
	/**
	 * gets the javascript files
	 */
	function javaScript($method,$arguments){
		$page = strtolower( substr($method,6) );
		$file = str_replace(DS.'includes','', dirname(__file__)).DS.'media'.DS.$page.'.js';
		
		return "<script type='text/javascript'>".$this->optimize($this->loadFile($file))."</script>";
	}
	
	/**
	 * gets the css files
	 */
	function cssLink($method,$arguments){
		$page = strtolower( substr($method,3) );
		$file = str_replace(DS.'includes','', dirname(__file__)).DS.'media'.DS.$page.'.css';
		
		return "<style>".$this->optimize($this->loadFile($file))."</style>";
	}
	
	/**
	 * requires the php file for inclusion
	 */
	function loadTheme($method,$arguments){
		$page = strtolower( substr($method,3) );
		
		//loading the wordpress themes
		if (!defined('WP_USE_THEMES')) define('WP_USE_THEMES', false); 
		$wpblogheader = $_SERVER['DOCUMENT_ROOT'].DS.'wp-blog-header.php';
		if (is_file($wpblogheader)) require_once $wpblogheader;
		
		//loading the requested file
		return $this->loadFile
		(
			str_replace(DS.'includes','', dirname(__file__)).DS.$page.'.php'
		);
	}
	
	/**
	 * requires the php file for inclusion
	 */
	function loadConfig($method,$arguments){
		$page = strtolower( substr($method,3) );
		
		return $this->loadFile
		( 
			str_replace(DS.'includes','', dirname(__file__)).DS.'config_'.$page.'.php' 
		);
	}
	
	/**
	 * 
	 */
	function loadFile($file){
		$get = '';
		if (is_file($file)){
			ob_start();
			include $file;
			$get = ob_get_clean();
		}
		return $get;
	}
	
	/**
	 * gets the folder name of the current plugin
	 */
	function pluginFolder(){
		$path = dirname(__file__);
		$parts = explode(DS, $path);
		return $parts[ count($parts)-2 ];
	}
	
	/**
	 * returns the url of the plugin
	 */
	function http(){
		return get_bloginfo( 'wpurl' ).'/wp-content/plugins/'.$this->pluginFolder();
	}
	
	/**
	 * Set the object properties based on a named array/hash
	 *
	 * @access	protected
	 * @param	$array  mixed Either and associative array or another object
	 * @return	boolean
	 * @see		set()
	 * @since	1.5
	 */
	function setProperties( $properties )
	{
		$properties = (array) $properties; //cast to an array

		if (is_array($properties))
		{
			foreach ($properties as $k => $v) {
				$this->$k = $v;
			}

			return true;
		}

		return false;
	}
	
	/**
	 * Returns an associative array of object properties
	 *
	 * @access	public
	 * @param	boolean $public If true, returns only the public properties
	 * @return	array
	 * @see		get()
	 * @since	1.5
 	 */
	function getProperties( $public = true )
	{
		$vars  = get_object_vars($this);

        if($public)
		{
			foreach ($vars as $key => $value)
			{
				if ('_' == substr($key, 0, 1) && '_return' != $key) {
					unset($vars[$key]);
				}
			}
		}

        return $vars;
	}
	
	
	
}
