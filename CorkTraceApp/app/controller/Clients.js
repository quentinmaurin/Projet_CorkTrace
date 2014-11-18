Ext.define('CT.controller.Clients', {
    extend: 'Ext.app.Controller',

    stores: ['Clients'],
	
	models: ['Client'],
	   
    views: [
    	'client.List',
		'client.Edit'
    ],
	   
    init: function() {
        this.control({
            'viewport > panel': {
                render: this.onPanelRendered
            },
		    'clientlist': {
		    	itemdblclick: this.editClient
		    },
	        'clientedit button[action=save]': {
	        	click: this.updateClient
	        }
        });
    },

    onPanelRendered: function() {
        console.log('The panel client was rendered');
		console.log( this.getClientsStore());
    },
	
    editClient: function(grid, record) {
		
        var view = Ext.widget('clientedit');
        view.down('form').loadRecord(record);
    },
	
    updateClient: function(button) {
		
		var win = button.up('window'),
	    form = win.down('form'),
	    record = form.getRecord(),
	    values = form.getValues();

	    record.set(values);
	    win.close();
		
	  	// synchronize the store after editing the record
	    this.getClientsStore().sync();
    }
});