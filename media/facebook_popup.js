var fbPopUp = new Class({
	
	//implements
	Implements: [Events, Options],
	
	//options
	options: {
		onOpen: $empty,
		onClose: $empty,
		
		url: "__HTTP__/includes/omnitable.php",
		variables: '',
		layoutView: 'true',
		ajax: false,
		title: 'Title',
		body: false,
		subtitle: 'Sub-Title'
		/*,
		buttons: {
			Save : function (){
				alert('save worked');
			},
			Apply : function (){
				alert('apply worked');
			}

		}
		*/
		
	},
	
	//initialization
	initialize: function(options) {
		//set options
		this.setOptions(options);
		
		fbPopUps = this;
		// creates the popup
		this.ajax = new Request({
			url: this.options.url,
			variables: this.options.variables,
					   
			onSuccess: function(response){
				fbPopUps.body(response);
				
			}
			
		});
		
	},
	
	//displays the buttons
	body: function(response, refresh) {
		if($chk($('dialog_body')) && $chk(response) && ( !$chk( $('dialog_body').innerHTML ) || $chk(refresh) ) ){
			var Sliders = new Fx.Slide('dialog_body');
			if (!$chk(refresh)) Sliders.hide();
			
			//grab from the store if available
			if ($chk(this.bodystore) && !$chk(refresh) ){
				response = this.bodystore;
			}
			
			//checking on response type
			if ( typeof response == 'function' ){
				$('dialog_body').innerHTML = response();
			} else {
				$('dialog_body').innerHTML = response;
			}
			
			if (!$chk(refresh)) $('dialog_body').setStyle('height', 'auto');
			if (!$chk(refresh)) $('dialog_loading').removeClass('dialog_loading');
			if (!$chk(refresh)) Sliders.slideIn();
			
			//since we used it, clean it all
			this.bodystore = false;
			response = false;
			
		} else {
			this.bodystore = response;
		}
	},

	//displays the buttons
	buttons: function() {
		fbPopUps = this;
		for (var button in this.options.buttons) {
			var myInput = new Element('input', {
			    'type': 'button',
			    'value': button,
			    'name': button,
			    'class': 'inputsubmit',
			    'id': button + '_fb',
			    'events': {
			        'click':  fbPopUps.options.buttons[button]
			    }
			
			});
			$extend($(myInput), fbPopUps);
			$(myInput).inject($('close_fb'), 'before');
		}
		return true;
	},
	
	//sets the initial functionality of this popup box
	setFunction: function(){
		// hide using opacity on page load
		this.pup.setStyles({
			opacity:0,
			display:'block'
		});
		
		self = this;
		
		// hide on close button
		this.closer.addEvent('click',function(e) { 
			self.close();
		});
		
		// hide on esc button
		window.addEvent('keypress',function(e) { 
			if(e.key == 'esc') { self.close(); } 
		});
		
		//hide on off click
		$(document.body).addEvent('click',function(e) {
			if(self.pup.get('opacity') == 1 && !e.target.getParent('.generic_dialog')) { 
				self.close();
			} 
		});
		
		//if(typeof this.options.onOpen == 'function')
		//this.fireevent('onOpen');
		
	},
	
	//inserts the div into position
	insertDiv: function(){
		//generating the id
		this.id = 'popup_fb';  // $('popup_fb')
		
		//create the popup as node
		var pop_node = document.createElement('div');
		pop_node.id = this.id;
		pop_node.className = 'generic_dialog';
		pop_node.innerHTML = this.popup();
		
		//create the body node
		var body_node = document.body.childNodes[0];
		
		//insert the pop into the body
		body_node.parentNode.insertBefore(pop_node, body_node);
		
		//remember it
		this.pup = $(this.id);
		this.closer = $('close_fb');
		this.title = $('dialog_title');
		this.subtitle = $('dialog_summary');
		this.bodydiv = $('dialog_body');
		this.buttons();
		
		//remove the ajax loader if this is not ajax
		if (!this.options.ajax){
			$('dialog_loading').removeClass('dialog_loading');
		}
		
		
	},
	
	//checks if the popup is open
	check: function(){
		if($chk($(this.id))) 
			return true;
		return false;
	},
	
	//initialization
	ajaxsend: function() {
		if(!this.options.ajax){ return false; }
		this.ajax.send();
	},
	
	//opens the popup
	open: function(){
		if(this.check()) return false;
		
		//call to ajax
		this.ajaxsend();
		
		//put the div in place
		this.insertDiv();
		
		//set the initials
		this.setFunction();
		
		this.title.innerHTML = this.options.title;
		this.subtitle.innerHTML = this.options.subtitle;
		this.body( this.options.body );
		
		//bring into view
		this.pup.fade('in');
		this.fireEvent('open');
		
	},
	
	//sets the close function
	close: function(){
		if(!this.check()) return false;
		
		$(this.id).fade('out');
		$$('body')[0].removeChild($(this.id));
		
		this.fireEvent('close');
		
	},
	
	//creates the div
	popup: function(){ return '<div class="generic_dialog_popup" style="top: 125px;">'+
	'<table class="pop_dialog_table" id="pop_dialog_table" style="width: 532px;">'+
		'<tbody>'+
		
		'<tr>'+
		'<td class="pop_topleft"/>'+
		'<td class="pop_border pop_top"/>'+
		'<td class="pop_topright"/>'+
		'</tr>'+
		
		'<tr>'+
		'<td class="pop_border pop_side"/>'+
			'<td id="pop_content" class="pop_content">'+
			'<h2 class="dialog_title"><span id="dialog_title">' + '</span></h2>'+
			'<div class="dialog_content">'+
				'<div class="dialog_summary" id="dialog_summary">' + '</div>'+
				
				'<div class="dialog_body dialog_loading" id="dialog_loading">'+
					'<div class="ubersearch search_profile">'+
						'<div class="result clearfix dialog_content_body">' +
							'<div id="dialog_body"></div>'+
							'<div class="clear" style="clear:both;"></div> '+
						'</div>'+
					'</div>'+
				'</div>'+
				
				'<div class="dialog_buttons" id="_dialog_buttons">' + 
				
					'<input type="button" value="Close" name="close" class="inputsubmit" id="close_fb" />'+
				'</div>'+
			'</div>'+
		'</td>'+
		'<td class="pop_border pop_side"/>'+
		'</tr>'+
		
		'<tr>'+
		'<td class="pop_bottomleft"/>'+
		'<td class="pop_border pop_bottom"/>'+
		'<td class="pop_bottomright"/>'+
		'</tr>'+
		
		'</tbody>'+
		'</table>'+
		'</div>';
	}
	
});
