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

global $support_id;

?>
<script>
jQuery(document).ready(function(){
	
	if (def = getAnchor()) createCookie('tablink', def, 30);

	//Setting the tabs
	if (readCookie('tablink') == null){
		createCookie('tablink', '#settings', 30);
	}
	
	toggletabs(readCookie('tablink')); //default tab goes here
	
	jQuery.each(jQuery('.tablink'), function(){
		jQuery(this).click(function(event){
			event.preventDefault(); 

			var href = jQuery(this).attr('href');

			toggletabs(href);
			
		});
	});
	
	//setting the support form functions
	jQuery('#postcommentbutton').click(function(evt){ 
		evt.preventDefault();
		var query = 'email='+ jQuery('#email').val()
				  + '&author='+ jQuery('#author').val()
				  + '&url='+ jQuery('#url').val()
				  + '&comment='+ jQuery('#comment').val()
				  + '&postingcomment=true'
				  + '&comment_post_ID=<?php echo $support_id; ?>'
				  + '&comment_parent=0'
				  + '&_wp_unfiltered_html_comment=8a1392377e';
				
		jQuery.ajax({
			type: "GET",
			url: "<?php echo CON_HTTP; ?>/config_support.php?"+query,
			dataType: "text",
			success: function(msg){
				jQuery('#commentsgohere').html(msg);
			},
			request: function(){
				alert('test');
			}
		});
		return false;
		
	});

	
	
});

function getAnchor( ){
  var regexS = "[\#](.*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return false;
  else
    return results[0];
}

function toggletabs(id){
	if (jQuery(id).length == 0) id = jQuery('#defaultlink').attr('href');
	
	jQuery.each(jQuery('.tabdiv'), function(){
		jQuery(this).css('display', 'none');
	});
	
	jQuery.each(jQuery('.tablink'), function(){
		jQuery(this).removeClass('current');
	});
	
	jQuery.each(jQuery('[href='+ id +']'), function(){
		jQuery(this).addClass('current');
	});
	
	jQuery(id).css('display', 'block');
	
	createCookie('tablink', id, 30);
}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

</script>