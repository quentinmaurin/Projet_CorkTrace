Ext.define('CT.controller.Clients', {
    extend: 'Ext.app.Controller',

    stores: ['Clients'],
	
	models: ['Client'],
	   
    views: [
    	'client.List',
		'client.Edit',
		'client.Add'
    ],
	   
    init: function() {
        this.control({
            'viewport > panel': {
                render: this.onPanelRendered
            },
		    'clientlist': {
		    	itemdblclick: this.editClient
		    },
		    'clientlist button[action=delete]': {
		    	click: this.deleteClient
		    },
	        'clientedit button[action=save]': {
	        	click: this.updateClient
	        },
	        'clientadd button[action=save]': {
	        	click: this.createClient
	        }
        });
    },

    onPanelRendered: function() {
        console.log('The panel client was rendered');
		console.log( this.getClientsStore());
    },
	
	deleteClient: function(button) {
		
		var row = Ext.getCmp('clientlist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
		this.getClientsStore().remove(row);
		this.getClientsStore().sync();
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
    },

    createClient: function(button) {
		
		console.log("create clients");
		var win = button.up('window'),
	    form = win.down('form'),
	    record = form.getRecord(),
	    values = form.getValues();

	    var clientInstance = Ext.create('CT.model.Client', {

		    cli_id : -1,
		    cli_nom : values['cli_nom'],
		    cli_mail : values['cli_mail'],
		    cli_tel : values['cli_tel'],
		    cli_fax : values['cli_fax'],
		    cli_adr_fact : values['cli_adr_fact'],
		    tyc_id : values['tyc_id']
		});

   		//console.log(clientInstance);
	    this.getClientsStore().add(clientInstance);
	    win.close();
		
	  	// synchronize the store after editing the record
	    this.getClientsStore().sync();
    }

});