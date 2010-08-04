window.addEvent('domready', function() { 
	new Element('img', {'src':"__HTTP__/media/images/ajax-loader.gif" });
	
	var _table = 'roles';
	var tablekey = 'ID';
	
	// loading the pagination
	function onGridSelect(evt)
    {
		//getting the id in question
    	var row = datagrid.getSelectedIndices()[0];
    	var _value = datagrid.getDataByRow(row)[tablekey];
    	
    	popup_edit.ajax.options.morevariables = '&ID='+ _value;
    	popup_edit.open();
    }
	
    function gridButtonClick(button, grid)
    {
        switch(button){
        case 'add':
        	popup_add.open();
        	break;
        case 'edit':
        	onGridSelect();
        	break;
        case 'delete':
        	popup_delete.open();
        	break;
        	
        }
    	
    }
	
	/**
	 * What happens when a capability is toggled
	 */
	function checkTheBox(){
		var row = datagrid.getSelectedIndices()[0];
    	var _value = datagrid.getDataByRow(row)[tablekey];
    	var that = this;
    	
    	var saveit = new Request({
			form: 'formedit',
			url: "__HTTP__/includes/omnitable.php",
			variables: '&table='+ _table  +'&task=saveCapabilities&role='+ _value 
						+'&'+ this.name +'='+ this.checked,
			onRequest: function(){
				
			},
			onSuccess: function(response){
				
			}
		
		}).send();
	}
	
    /**
     * displays a list of capabilities that can be modified
     * @variable: obj.row
     */
    function accordionFunction(obj)
	{
		
		var div = new Element('div', {
			'style':{
				'padding':'5px'
			}
		}).inject(obj.parent);
			
    	var text = '';
    	var capabilities = datagrid.getDataByRow(obj.row).capabilities;
    	$H(capabilities).each(function(value, key){
    		
    		if (value == 'false') value = false;
    		if (value){ var checked = true; } else { var checked = false; }
			
    		var label = new Element('label', {
				'text': key,
				'for': key + obj.row,
				'styles':{
					'position':'relative',
					'float':'left',
					'display':'block',
					'width':'200px',
					'text-align':'right',
					'margin-right':'10px'
				}
			}).inject(div);
					
    		var input = new Element('input', {
				'checked':checked,
				'type':'checkbox',
				'name':key,
				'value':value,
				'id':key + obj.row,
				'styles':{
					'position':'relative',
					'float':'left',
					'display':'inline'
				},
				'events':{
					'click': checkTheBox
				}
			}).inject(div);
					
    	});
		
	}
    
    
    datagrid = new omniGrid('tablegrid', {
	        columnModel: [
				{
					header: "Role",
					dataIndex: 'role',
					dataType:'string',
					width:150
				},
				{
					header: "Display Name",
					dataIndex: 'display_name',
					dataType:'string',
					width:610
				}
				
	        ],
	        buttons : [
	          {name: 'Add', bclass: 'add', onclick : gridButtonClick},{separator: true},
	          {name: 'Edit', bclass: 'edit', onclick : gridButtonClick}, {separator: true},
		      {name: 'Delete', bclass: 'delete', onclick : gridButtonClick}, {separator: true}
		         
	        ],
	        url:"__HTTP__/includes/omnitable.php?table="+ _table  +"&task=view",
	        perPageOptions: [15,30,60,100,200],
	        perPage:15,
	        page:1,
	        pagination:true,
	        serverSort:true,
	        showHeader: true,
	        alternaterows: true,
	        showHeader:true,
	        sortHeader:true,
	        resizeColumns:false,
	        multipleSelection:false,
	        
	        // uncomment this if you want accordion behavior for every row
	        accordion:true,
	        accordionRenderer:accordionFunction,
	        autoSectionToggle:false,
	        
				
	        width:800,
	        height: 600
	    });
	    
    datagrid.addEvent('dblclick', onGridSelect);
	   
    
    
    // adding a new record
	var popup_add = new fbPopUp({
		ajax: true,
		variables: '&table='+ _table +'&task=addRole',
		title: 'Add',
		subtitle: 'Adding a new record',
		buttons: {
			Save : function (){
				
				// creates the popup
				var saveit = new Request({
					form: 'formadd',
					url: "__HTTP__/includes/omnitable.php",
					variables: '&table='+ _table  +'&task=save',
					onSuccess: function(response){
					 	//updates and closes the box
						popup_add.body( response, true );
						datagrid.refresh();
						setTimeout(function(){ popup_add.close(); },1000);
					}
					
				}).send();
				
			}
			
		}
		
	});
	
	// editing records
	var popup_edit = new fbPopUp({
		ajax: true,
		variables: '&table='+ _table +'&task=edit',
		title: 'Edit',
		subtitle: 'editing a record',
		buttons: {
			Save : function (){
				
				// creates the popup
				var saveit = new Request({
					form: 'formedit',
					url: "__HTTP__/includes/omnitable.php",
					variables: '&table='+ _table  +'&task=save',
					onSuccess: function(response){
						//updates and closes the box
						popup_edit.body( response, true );
						datagrid.refresh();
						setTimeout(function(){ popup_edit.close(); },1000);
						
					}
				
				}).send();
				
			}

		}
	
	});
	
	// deleteing records
	var popup_delete = new fbPopUp({
		ajax: false,
		variables: '&table='+ _table +'&task=delete',
		title: 'Delete',
		subtitle: 'Are you sure you want to Delete this record?',
		body: function(){
			var selected = datagrid.getSelectedIndices();
			var _value = '';
			var _return = '<form action="#" method="get" name="formdelete" id="formdelete"><ul>';
			
			//loop through and show the selected items
			if($chk(selected)){
				selected.each(function(row){
					_value 	= _value + ',' + datagrid.getDataByRow(row)[tablekey];
					_return = _return + '<li><b>' + datagrid.getDataByRow(row)[tablekey] 
							+ '</b> : ' + datagrid.getDataByRow(row).display_name + '</li>';
				});
				_return = _return + '<input type="hidden" value="' + _value + '" name="keys" />';
			}
			
			_return = _return + '</ul></form>'+
								'<BR><div class="clear" style="clear:both;"></div>';
			
			return _return;
		},
		buttons: {
			'Yes! Delete it.' : function (){
				
				// creates the popup
				var saveit = new Request({
					form: 'formdelete',
					url: "__HTTP__/includes/omnitable.php",
					variables: '&table='+ _table  +'&task=delete',
					onSuccess: function(response){
						//updates and closes the box
						popup_delete.body( response, true );
						datagrid.refresh();
						setTimeout(function(){ popup_delete.close(); },1000);
					}
				
				}).send();
			
			}

		}
		
	});
	
	
});