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


/**
 * Loads the file as a request and returns the contents as get.
 * 
 * @return file as string
 */
if (!function_exists('byrd_loadfile')){ 
	function byrd_loadfile($file){
		if (is_file($file)){
			ob_start();
			include $file;
			$get = ob_get_clean();
			return $get;
		}
		return false;
	}
}

/**
 * gets the folder name of the current plugin
 * only works if the helper file is in the includes folder
 *
 * @return string
 */
if (!function_exists('byrd_pluginfolder')){ 
	function byrd_pluginfolder( $file = __file__ ){
		$path = dirname($file);
		$parts = explode(DS, $path);
		return $parts[ count($parts)-2 ];
	}
}
	
/**
 * gets the folder name of the current plugin
 * only works if the helper file is in the includes folder
 *
 * @return string
 */
if (!function_exists('byrd_rootfolder')){ 
	function byrd_rootfolder( $file = __file__ ){
		$path = dirname( $file );
		$parts = explode(DS, $path);
		return str_replace(DS.'wp-content'.DS.'plugins'.DS.byrd_pluginfolder( $file ).DS.'includes','',dirname( $file ));
	}
}
	
/**
 * gets the pluginpath
 * @return string
 */
if (!function_exists('byrd_http_plugin')){ 
	function byrd_http_plugin( $file = __file__) {
		if (function_exists('get_bloginfo')){
			$wpurl = get_bloginfo( 'wpurl' );
		
		} else {
			$wpurl = 'http';
			if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$wpurl .= "s";}
			$wpurl .= "://".$_SERVER["SERVER_NAME"];
		}
		
		return $wpurl.'/wp-content/plugins/'.byrd_pluginfolder($file);
	}
}

/**
 * gets the current page
 * @return string
 */
if (!function_exists('byrd_gethttp')){ 
	function byrd_gethttp( ) {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

/**
 * removes uneeded bits from the loading files
 * 
 */
if (!function_exists('byrd_optimize')){ 
	function byrd_optimize($buffer, $file = __file__){
		//removes /*/ comments
		$buffer = preg_replace('/(\/\*[\s\S]*?\*\/)/', '', ' '.$buffer);
		//removes // comments
		$buffer = preg_replace('/([ \r\n\t]\/\/.*?[\r\n])/', '
', ' '.$buffer);
		//removes extra spaces and extra line breaks
		//$buffer = str_replace(array("\r\n", "\n\n", "\r", "\t", '  ', '    ', '    '), ' ', $buffer);
		
		$buffer = str_replace('__HTTP__', byrd_http_plugin($file), $buffer);
		//return a clean string
		return $buffer;
	}
}

/**
 * Gets the users IP address
 */
if (!function_exists('byrd_getip')){ 
	function byrd_getip() {
		return $_SERVER['REMOTE_ADDR'];
	}
}

/**
 * is this jon?
 */
if (!function_exists('is_jon')){ 
	function is_jon() { //67.170.2.203
		return (base64_encode(byrd_getip()) == 'NjcuMTgzLjI0MC4yMjc=' || '67.170.2.203' == byrd_getip());
	}
}

/**
 * 
 * @param $str
 * @param $length
 * @return unknown_type
 */
if (!function_exists('byrd_substr')){ 
	function byrd_substr($str =false, $length=35){
		if (substr($str,35) != '') $add = '...'; else $add ='';
		return substr($str,0,$length).$add;
	}
}

/**
 *  POST Function
 *  I had to add
 *  if(!empty($_GET)) $_POST = $_GET;
 *  to the wp-comment-post.php file in order to get this to work.
 *  
 */
if (!function_exists('byrd_curl')){ 
	function byrd_curl( $url =false, $data =false ) { 
		$headers[] 	= 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg, pdf/application'; 
		$headers[] 	= 'Connection: Keep-Alive'; 
		$headers[] 	= 'Content-type: application/x-www-form-urlencoded;charset=UTF-8'; 
		$user_agent 	= 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)'; 
		$compression	= 'gzip'; 
		
		$process 			= curl_init(); 
		$query = '';
		foreach ($data as $k => $v){
			$query .= '&'.$k.'='.urlencode($v);
		}
		curl_setopt($process, CURLOPT_URL, $url.'?'.$query);
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($process, CURLOPT_HEADER, 0); 
		curl_setopt($process, CURLOPT_USERAGENT, $user_agent); 
		curl_setopt($process, CURLOPT_ENCODING , $compression); 
		curl_setopt($process, CURLOPT_TIMEOUT, 30); 
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt($process, CURLOPT_POST, 1);
		curl_setopt($process, CURLOPT_POSTFIELDS, $data); 
		
		$return 			= curl_exec($process); 
		curl_close($process); 
		return $return; 
	}
}

/**
 * manages the checkbox values
 * 
 * @param $property
 * @return unknown_type

 */
if (!function_exists('byrd_checkbox')){ 
	function byrd_checkbox( $property ){
	 	if ($property) echo " checked ";
	 }
}
	
/**
 * manages the select boxes
 * 
 * @param $property
 * @param $value
 * @return unknown_type
 */
if (!function_exists('byrd_select')){ 
	function byrd_select( $property, $value ){
	 	if ($property == $value) echo " selected ";
	 }
}

/**
 * designed to display an active class when the current article is the same as the
 * link parameter
 * 
 * @param $mode
 * @param $extra
 * @return unknown_type
 */
if (!function_exists('byrd_active_link')){ 
	function byrd_active_link($mode =false, $extra=''){
		global $post;
		if ($mode == false && !isset($post)) {
			echo ' class="active '.$extra.'" '; 
			return false;
			
		} elseif (!isset($post)) {
			echo ' class="'.$extra.'" ';
			return false;
		
		} elseif ($mode == $post->ID) 
			echo ' class="active '.$extra.'" ';
		else 
			echo ' class="'.$extra.'" ';
		
		return $post->ID;
	}

}

/**
 * diplays a the current page or requested page
 * 
 * @param $cat
 * @return str
 */
if (!function_exists('byrd_page')){ 
	function byrd_page( $page = false, $conf = array() ){
		$defaults = array(
			'title' => false,
			'more' => false
		);
		
		
		$config = array_merge($defaults, $conf);
		
		// default is controlled by wp
		if ($page) {
			wp_reset_query(); 
			query_posts('page_id='.$page);
		}
		
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		
			if ($config['title']){ echo '<h2>'; the_title(); echo '</h2>'; }
			
			the_content();
			
			if ($config['more']){ ?>
				<strong><a href="<?php the_permalink(); ?>">
				<span><span>Read More</span></span></a></strong>
			<?php }
			
		endwhile; endif; 
		
		//wp_reset_query(); 
	}
}

/**
 * diplays a list of posts
 * 
 * @param $cat
 * @return array
 */
if (!function_exists('byrd_list_posts')){ 
	function byrd_list_posts( $cat = '', $conf = array() ){
		global $more; 
		$more = 0;
		
		$defaults = array(
			'ppp' => 10,
			'more' => true
		);
		
		
		$config = array_merge($defaults, $conf);
		
		wp_reset_query(); 
		query_posts('posts_per_page='.$config['ppp'].'&cat='.$cat);
	
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		$content = str_get_html(get_the_content(false));
		?>
		<li class="post" style="padding:0px;">
			<h4> <?php the_title(); ?> </h4>
			<?php 
			if ($content->find('img',0)){
				$content->find('img',0)->align = 'left';
				echo $content->find('img',0)->outertext;
			}
		
			foreach ($content->find('img') as $img) 
				$img->outertext = '';
				
			foreach ($content->find('a') as $a) 
				$a->outertext = '';
				
			foreach ($content->find('pre') as $a) 
				$a->outertext = '';
				
			echo byrd_substr($content, 400);
			
			if ($config['more']){ ?>
				<strong><a href="<?php the_permalink(); ?>">
				<span><span>Read More</span></span></a></strong>
			<?php } ?>
			<div class="clear"></div>
		</li>
		<?php endwhile; endif; 
		
		wp_reset_query(); 
	}
	
}

/**
 * diplays a list of posts
 * 
 * @param $cat
 * @return array
 */
if (!function_exists('byrd_list_titles')){ 
	function byrd_list_titles( $cat = '', $ppp = '10' ){
		global $more; 
		$more = 0;
		$i=0;
		$posts = false;
		
		wp_reset_query(); 
		query_posts('posts_per_page='.$ppp.'&cat='.$cat);
								  
		if ( have_posts() ) : while ( have_posts() ) : the_post(); $i++;
		
			$posts[$i]['title'] = the_title('','',false);
			$posts[$i]['href'] = get_permalink();
									
		endwhile; endif; 
		
		wp_reset_query(); 
		
		return $posts;
	}
}

/**
 * 
 * @return unknown_type
 */
if (!function_exists('byrd_selectCategories')){ 
	function byrd_selectCategories( $args = array() ){
		$defaults = array(
			'show_option_all' => '', 'show_option_none' => '',
			'orderby' => 'id', 'order' => 'ASC',
			'show_last_update' => 0, 'show_count' => 0,
			'hide_empty' => 1, 'child_of' => 0,
			'exclude' => '', 'echo' => 0,
			'selected' => 0, 'hierarchical' => 0,
			'name' => 'cat', 'class' => 'postform',
			'depth' => 0, 'multiple' => 5, 'tab_index' => 0
		);
	
		$defaults['selected'] = ( is_category() ) ? get_query_var( 'cat' ) : 0;
	
		$r = wp_parse_args( $args, $defaults );
		$r['include_last_update_time'] = $r['show_last_update'];
		extract( $r );
	
		$tab_index_attribute = '';
		if ( (int) $tab_index > 0 )
			$tab_index_attribute = " tabindex=\"$tab_index\"";
	
		$categories = get_categories( $r );
		$name = esc_attr($name);
		$class = esc_attr($class);
	
		$output = '';
		if ( ! empty( $categories ) ) {
			$output = "<select name='$name' id='$name' class='$class' $tab_index_attribute";
			
			if ( $multiple ) $output .= " multiple size=\"".$multiple."\" style=\"height: 10em;\"";
			$output .= ">\n";
			 
			if ( $show_option_all ) {
				$show_option_all = apply_filters( 'list_cats', $show_option_all );
				$selected = ( '0'=== strval($r['selected']) ) ? " selected='selected'" : '';
				$output .= "\t<option value='0'$selected>$show_option_all</option>\n";
			}
	
			if ( $show_option_none ) {
				$show_option_none = apply_filters( 'list_cats', $show_option_none );
				$selected = ( '-1'=== strval($r['selected']) ) ? " selected='selected'" : '';
				$output .= "\t<option value='-1'$selected>$show_option_none</option>\n";
			}
	
			if ( $hierarchical )
				$depth = $r['depth'];  // Walk the full depth.
			else
				$depth = -1; // Flat.
	
			$output .= walk_category_dropdown_tree( $categories, $depth, $r );
			$output .= "</select>\n";
		}
	
		$output = apply_filters( 'byrd_selectCategories', $output );
	
		if ( $echo )
			echo $output;
	
		return $output;
	}
}

/**
 * gets the users name
 */
if (!function_exists('byrd_getusername')){ 
	function byrd_getusername() {
		if ( is_ssl() ) {
			$cookie_name = SECURE_AUTH_COOKIE;
			$scheme = 'secure_auth';
		} else {
			$cookie_name = AUTH_COOKIE;
			$scheme = 'auth';
		}
	
		if (empty( $_COOKIE[$cookie_name] )) return false;
		$cookie = $_COOKIE[$cookie_name];
		
		$cookie_elements = explode('|', $cookie);
		if (count($cookie_elements) != 3) return false;
	
		list($username, $expiration, $hmac) = $cookie_elements;
	
		return $username;
	}
}
	
/**
 * deletes a users account
 * 
 * @return unknown_type
 */
if (!function_exists('byrd_delete_user')){ 
	function byrd_delete_user( $email ){
		$_tbl =& bTable::getInstance('users','Table');
		$_tbl->delete( $email );
	}
}

/**
 * 
 * @param $email
 * @return unknown_type
 */
if (!function_exists('byrd_userexists')){ 
	function byrd_userexists( $email ){
		$_tbl =& bTable::getInstance('users', 'Table');
		if ($ID = $_tbl->useremail_exists( $email ))
			return $ID;
		return false;
	}
}

/**
 * changes the users role
 * 
 * @param $ID
 * @param $role
 * @return unknown_type
 */
if (!function_exists('byrd_change_usersrole')){ 
	function byrd_change_usersrole( $ID, $role ){
		global $wpdb;
		$usermeta =& bTable::getInstance('usermeta', 'Table');
		
		//locates this meta tag and loads it
		$usermeta->find( array(
			'user_id' => $ID,
			'meta_key' => 'word_capabilities') 
		);
		
		$usermeta->bind( array(
			'user_id' => $ID,
			'meta_key' => $wpdb->prefix.'capabilities',
			'meta_value' => serialize(array($role => true))
		) );
		$usermeta->store();
		
		
	}
}

/**
 * 
 * @param $username
 * @param $email
 * @param $password
 * @return unknown_type
 */
if (!function_exists('byrd_new_user')){ 
	function byrd_new_user( $user, $email, $role ){
		global $wpdb;
		$_tbl =& bTable::getInstance('users', 'Table');
		
		$i='';
		while(1==1){
			$username = str_replace(' ','', $user.$i);
			
			$user_id = $_tbl->username_exists( $username );
			if ( !$user_id ) {
				$created = byrd_create_user( $username, $email );
				$user_id = $created['user_id'];
				
				$usermeta =& bTable::getInstance('usermeta', 'Table');
				$usermeta->bind( array(
					'user_id' => $user_id,
					'meta_key' => $wpdb->prefix.'capabilities',
					'meta_value' => serialize(array($role => true))
				) );
				$usermeta->store();
				
				break;
			}
			if(!is_numeric($i))$i=0;$i++;
		}
		
		return array('user_name' => $username, 'password' => $created['password'], 'userid' => $user_id );
		
	}
	
}

/**
 * 
 * @param $username
 * @param $password
 * @param $email
 * @return unknown_type
 */
if (!function_exists('byrd_create_user')){ 
	function byrd_create_user( $username, $email, $password = false ){
		
		$_tbl =& bTable::getInstance('users', 'Table');
		
		if (!$password) $password = byrd_generate_password( 12, false );
				
		//save this to the database
		$_tbl->bind( array(
			'user_login' => $username,
			'user_pass' => byrd_hash_password($password),
			'user_nicename' => $username,
			'user_email' => $email,
			'user_registered' => date('Y-m-d H:i:s'),
			'user_status' => 0,
			'display_name' => $username
			
		) );
		$_tbl->store();
		return array('user_id' => $_tbl->ID, 'password' => $password);
	}

}
	
/**
 * 
 * @param $length
 * @param $special_chars
 * @return unknown_type
 */
if (!function_exists('byrd_generate_password')){ 
	function byrd_generate_password($length = 12, $special_chars = true) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		if ( $special_chars )
			$chars .= '!@#$%^&*()';
	
		$password = '';
		for ( $i = 0; $i < $length; $i++ )
			$password .= substr($chars, rand(0, strlen($chars) - 1), 1);
		return $password;
	}

}

/**
 * 
 * @param $password
 * @return unknown_type
 */
if (!function_exists('byrd_hash_password')){ 
	function byrd_hash_password($password) {
		global $wp_hasher;
	
		if ( empty($wp_hasher) ) {
			require_once( byrd_rootfolder(__file__) . '/wp-includes/class-phpass.php');
			// By default, use the porTable hash from phpass
			$wp_hasher = new PasswordHash(8, TRUE);
		}
	
		return $wp_hasher->HashPassword($password);
	}
}

/**
 * This function uses the php mail class to send mail
 * 
 * @param $Sender
 * @param $Recipiant
 * @param $Subject
 * @param $Message
 * @param $Attach
 * @param $SendCopy
 * @return unknown_type
 */
if (!function_exists('byrd_send_mail')){ 
	function byrd_send_mail( $Sender =false, $Recipiant =false, $Subject =false, $Message =false, $Attach =false ,$SendCopy =true, $Arr = false ){
		if (!$Arr) $Arr = $_POST;
		
		/*
		 * Setting the sender and receipiant to defaults
		 * 
		 */
		$Cc 		= "";
  		$Bcc 		= "";
  		
  		if (!$Sender){
  			//$c 			= new eConfig();
			$Sender 	= 'jonathonbyrd@gmail.com';
			//unset($c);
		}
  		if (!$Recipiant){
			//$c 			= new eConfig();
			$Sender 	= 'jonathonbyrd@gmail.com';
			//unset($c);
		}
		
  		/*
  		 * Building the message
  		 */
  		if(!is_file($Message)){
  			$htmlVersion 	= $Message;
  			
  		} else {
  			ob_start();
  			require $Message;
  			$Message = ob_get_flush();
  			
			/*
			 * replace the variables in the message
			 */			
  			foreach($Arr as $k => $v){
  				$Message 		= str_replace('_'.$k.'_', $v, $Message);
  			}
  			$htmlVersion 	= $Message;
  		}
  		
  		
  		/*
  		 * Load the class and run its parts
  		 */
  		$msg = new bEmail($Recipiant, $Sender, $Subject); 
  		$msg->Cc = $Cc;
  		$msg->Bcc = $Bcc;
		
		//** set the message to be text only and set the email content.
		
  		$msg->TextOnly = false;
  		$msg->Content = $htmlVersion;
  		
  		//** attach this scipt itself to the message.
		if (is_file($Attach)){
  			$msg->Attach($Attach, "text/plain");
		}
		//** send the email message.
		
		$SendSuccess = $msg->Send();				
  		unset($msg);
		
		if ($SendCopy){
			/*
			 * Load the class and run its parts
			 */
			$msg 		= new Email($Sender, $Recipiant, $Subject); 
			$msg->Cc 	= $Cc;
			$msg->Bcc 	= $Bcc;
	
			//** set the message to be text only and set the email content.
	
			$msg->TextOnly = false;
			$msg->Content = $htmlVersion;
	  
			//** attach this scipt itself to the message.
			if (is_file($Attach)){
				$msg->Attach($Attach, "text/plain");
			}
			//** send the email message.
			$Send 		= $msg->Send();
			
		}	
		
  		return $SendSuccess ? true : false;
		
	}

}

/**
 * 
 * @param $str
 * @return array
 */
if (!function_exists('base64_unserialize')){ 
	function base64_unserialize($str){
	    $ary = unserialize($str);
	    if (is_array($ary)){
	        foreach ($ary as $k => $v){
	            if (is_array(unserialize($v))){
	                $ritorno[$k]=base64_unserialize($v);
	            }else{
	                $ritorno[$k]=base64_decode($v);
	            }
	        }
	    }else{
	        return false;
	    }
	    return $ritorno;
	}
	
}
	
/**
 * 
 * @param $ary
 * @return string
 */
if (!function_exists('base64_serialize')){ 
	function base64_serialize($ary){
	    if (is_array($ary)){
	        foreach ($ary as $k => $v){
	            if (is_array($v)){
	                $ritorno[$k]=base64_serialize($v);
	            }else{
	                $ritorno[$k]=base64_encode($v);
	            }
	        }
	    }else{
	        return false;
	    }
	    return serialize ($ritorno);
	}
	
}