window.addEvent('domready', function() { 
	
	var _table = 'subscriptions';
	var tablekey = 'itemid';
	
	
	
	function clearForm(){
		$('membershipsubscriptions').getElements('.memelem').each(function(el){
			el.value = '';
		});
	}
	
    // editing
	function onEdit(evt)
    {
		//getting the id in question
    	var row = datagrid.getSelectedIndices()[0];
    	var _value = datagrid.getDataByRow(row)[tablekey];
    	
    	$('membershipsubscriptions').getElements('.memelem').each(function(el){
			el.value =  datagrid.getDataByRow(row)[el.name];
		});
    	
    	toggletabs('#addnew');
    }
	
	
	// adding a new record
	function onAdd()
    {
		clearForm();
		toggletabs('#addnew');
    }
	
	function gridButtonClick(button, grid)
    {
        switch(button){
        case 'add': onAdd(); break;
        case 'edit': onEdit(); break;
        case 'delete': popup_delete.open(); break;
        }
    	
    }
	
    function accordionFunction(obj)
	{
		obj.parent.set('html', '<div style="padding:5px"> Row '+obj.row+'<br/><br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </div>');
	}
    
    datagrid = new omniGrid('tablegrid', {
	        columnModel: [
				{
					header: "ID",
					dataIndex: tablekey,
					dataType:'number',
					width:25
				},
				{
					header: "Status",
					dataIndex: 'status',
					dataType:'string',
					width:75
				},
				{
					header: "Subscription Title",
					dataIndex: 'item_name',
					dataType:'string',
					width:350
				},
				{
					header: "Subscription Role",
					dataIndex: 'role',
					dataType:'string',
					width:120
				},
				{
					header: "Price",
					dataIndex: 'a3',
					dataType:'number',
					width:50
				},
				{
					header: "Duration",
					dataIndex: 'p3',
					dataType:'number',
					width:70
				},
				{
					header: ".",
					dataIndex: 't3',
					dataType:'string',
					width:20
				}
				
	        ],
	        buttons : [
	          {name: 'Add', bclass: 'add', onclick : gridButtonClick},
	          {separator: true},
	          {name: 'Edit', bclass: 'edit', onclick : gridButtonClick},
	          {separator: true},
		      {name: 'Delete', bclass: 'delete', onclick : gridButtonClick},
	          {separator: true}
		         
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
	        resizeColumns:true,
	        multipleSelection:true,
	        
	        // uncomment this if you want accordion behavior for every row
	        /*
	        accordion:true,
	        accordionRenderer:accordionFunction,
	        autoSectionToggle:false,
	        */
				
	        width:800,
	        height: 400
	    });
	    
    datagrid.addEvent('dblclick', onEdit);
	   
    
    
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
					        + '</b> : ' + datagrid.getDataByRow(row).item_name + '</li>';
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