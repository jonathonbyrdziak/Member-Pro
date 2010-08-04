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

require_once dirname(__file__).'/framework.php';


// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();


class byrdSiteRoles extends byrdPropertiesRoles {
	
	/**
	 * controller
	 * @return unknown_type
	 */
	function __construct(){
		$this->getOptions();
		$this->setPermissions();
		
	}
	
	/**
	 * This function will add the expiration date to the users table
	 * 
	 * @return string
	 */
	function user_columns($empty, $column,$userid){
		//in case we want to add more columns later
		switch($column){
			case 'subscription_expiration':
				return get_usermeta( $userid, 'subscription_expiration' );
				break;
			case 'subscription_startdate':
				return get_usermeta( $userid, 'subscription_startdate' );
				break;
			case 'subscription_name':
				return get_usermeta( $userid, 'subscription_name' );
				break;
			case 'subscription_streetaddress':return get_usermeta( $userid, 'subscription_streetaddress' );break;
			case 'subscription_city':return get_usermeta( $userid, 'subscription_city' );break;
			case 'subscription_state':return get_usermeta( $userid, 'subscription_state' );break;
			case 'subscription_zip':return get_usermeta( $userid, 'subscription_zip' );break;
			case 'subscription_country':return get_usermeta( $userid, 'subscription_country' );break;
			
		}
		
		return '';
	}
	
	/**
	 * designed to set the permissions to access certain functions
	 * @return bool
	 */
	function setPermissions()
	{
		global $wp_roles, $wp_user_roles, $wpdb;
		$roleStructure = array();
		
		$role =& bTable::getInstance('roles', 'Table');
		
		$roles = $role->getList();
		if (is_Array($roles)){
			foreach ($roles as $num => $value)
			{
				$roleStructure[$value['role']]['name'] = $value['display_name'];
				$roleStructure[$value['role']]['capabilities'] = $value['capabilities'];
			}
			
			//getting the old roles from the db
			$role_key = $wpdb->prefix.'user_roles';
			$this->old_roles = get_option( $role_key );
			
			//merging the old roles into the new roles
			$wp_user_roles = $this->old_roles + $roleStructure;
			
		}
	}
	
	/**
	 * replaces <!-- getSubscription() --> with the subscription
	 * 
	 * @param $content
	 * @return unknown_type
	 */
	function contentFilters( $content = '' ) {
		while(1==1){
			preg_match('/<\!-- getSubscription\((\d+)\) -->/', $content, $form);
			if (!isset($form[1])) break;
			$content = str_replace("<!-- getSubscription(".$form[1].") -->", $this->getSubscription($form[1]), $content);
		}
		
		$content = str_replace("<!-- getSubscription() -->", $this->getSubscriptions(), $content);
		if (strpos($content, "<!-- getLogin() -->") !== false)
			$content = str_replace("<!-- getLogin() -->", $this->getLogin(), $content);
		
		return $content;
	}
	
	/**
	 * returns the formatted subscription
	 * <!-- getSubscription(#) -->
	 * 
	 * @param $content
	 * @return unknown_type
	 */
	function getSubscription( $id = '' ) {
		$sub =& bTable::getInstance('subscriptions', 'Table');
		if (!$sub->load($id))
		{
			return '<!-- Subscription ID does not exist. -->';
		}
		
		if ($this->pp_sandbox) $action ='https://www.sandbox.paypal.com/cgi-bin/webscr'; 
		else $action ='https://www.paypal.com/cgi-bin/webscr';
		
		$return ='<h3>'.$sub->item_name.'</h3>
		<div class="left width75">'.$sub->item_description.'</div>
		<div class="left width25">$'.$sub->a3.'</div>
		<div class="clear"></div>
		
<div style="position:relative;float:right;"> 
 <form action="'.$action.'" method="post">
  <input type="hidden" name="cmd" value="_xclick-subscriptions">
  <input type="hidden" name="item_number" value="'.$sub->role.'">
  <input type="hidden" name="custom" value="'.$this->calc_expiration($sub->p3,$sub->t3,$sub->srt).'">
    '; 
		
		foreach ($this->getProperties() as $property => $value) { 
			if (is_null($this->$property) || !$this->$property) continue; 
			if (in_array($property,array('role','item_number','status','downgradeuser','custom','displayexpirationdata','old_roles','wp_filter_id'))) continue; 
		
			$return .= '<input type="hidden" name="'.$property.'" value="'.$value.'">'; 
		} 
		
		foreach ($sub->getProperties() as $property => $value) { 
			if (is_null($sub->$property) || !$sub->$property) continue; 
			if (in_array($property,array('role','item_number','status','downgradeuser','custom','displayexpirationdata','old_roles','wp_filter_id'))) continue; 
		
			$return .= '<input type="hidden" name="'.$property.'" value="'.$value.'">'; 
		} 
		
		$return .= '<input type="submit" name="submit" value="'.$sub->buy_button.'" border="0" 
		alt="PayPal - The safer, easier way to pay online">
 </form>
</div>
		<div style="display:block;width:100%;clear:both;height:1px;line-height:1px;"></div>';
		
		return $return;
	}
	
	/**
	 * returns the complete formatted subscriptions
	 * <!-- getSubscription() -->
	 * 
	 * @param $content
	 * @return unknown_type
	 */
	function getSubscriptions() {
		$return = '';
		$sub =& bTable::getInstance('subscriptions', 'Table');
		
		if ($this->pp_sandbox) $action ='https://www.sandbox.paypal.com/cgi-bin/webscr'; 
		else $action ='https://www.paypal.com/cgi-bin/webscr';
		
		if (!is_array($subscriptions = $sub->getList()))
		{
			return '<!-- No Subscriptions exist. -->';
		}
		
		foreach($subscriptions as $sub){
			$return .='<h3>'.$sub['item_name'].'</h3>
			<div class="left width75">'.$sub['item_description'].'</div>
			<div class="left width25">$'.$sub['a3'].'</div>
			<div class="clear"></div>
			
<div style="position:relative;float:right;"> 
 <form action="'.$action.'" method="post">
  <input type="hidden" name="cmd" value="_xclick-subscriptions">
  <input type="hidden" name="item_number" value="'.$sub['itemid'].'">
    '; 
			
	foreach ($this->getProperties() as $property => $value) { 
		if (is_null($this->$property) || !$this->$property) continue; 
		if (in_array($property,array('role','item_number','status','downgradeuser','custom','displayexpirationdata','old_roles','wp_filter_id'))) continue; 
		
		$return .= '<input type="hidden" name="'.$property.'" value="'.$value.'"> '; 
	} 
	
	foreach ($sub as $property => $value) { 
		if (is_null($sub[$property]) || !$sub[$property]) continue; 
		if (in_array($property,array('role','item_number','status','downgradeuser','custom','displayexpirationdata','old_roles','wp_filter_id'))) continue; 
		$return .= '<input type="hidden" name="'.$property.'" value="'.$value.'">'; 
	} 
	
	$return .= ' 
    <input type="hidden" name="custom" value="'.$this->calc_expiration($sub['p3'],$sub['t3'],$sub['srt']).'">
  <input type="submit" name="submit" value="'.$sub['buy_button'].'" border="0" alt="PayPal - The safer, easier way to pay online">
  
 </form>
</div>
			<div style="display:block;width:100%;clear:both;height:1px;line-height:1px;"></div>';
		}
		
		return $return;
	}
	
	/**
	 * this is designed to calculate the expiration date of this individual
	 * 
	 * @param $duration
	 * @param $type
	 * @return string
	 */
	function calc_expiration( $p3, $t3, $srt ){
		
		//preload the dates to add to prevent php warnings
		$time = array('day'=>0,'month'=>0,'year'=>0);
		
		switch($t3){
			case 'D': $t3 = 'day'; break;
			case 'M': $t3 = 'month'; break;
			case 'Y': $t3 = 'year'; break;
			case 'W': $t3 = 'day'; $p3 = $p3 * 7; break;
			
		}
		
		//subscription duration ($p3) * number of durations ($srt)
		$srt = $srt * $p3;
		
		//setting the dates
		$time[$t3] = $srt;
		$c = date_parse( date('Y-m-d') );
		
		return date("F j, Y", mktime(0, 0, 0, 
			$c['month']+$time['month'],$c['day']+$time['day'],$c['year']+$time['year']));
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
	
} 
