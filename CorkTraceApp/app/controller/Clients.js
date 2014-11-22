Ext.define('CT.controller.Clients', {
    extend: 'Ext.app.Controller',

    stores: ['Clients', 'TypeClients', 'AssigneAdresses', 'Adresses', 'Commercials', 'AssigneCommercials'],
	
	models: ['Client', 'TypeClient', 'AssigneAdresse', 'Adresse', 'Commercial', 'AssigneCommercial'],
	   
    views: [
    	'client.List',
		'client.Edit',
		'client.Add',
		'assignadress.Add',
		'assigncommercial.Add'
    ],
	   
    init: function() {
        this.control({
            'viewport > panel': {
                render: this.onPanelRendered
            },
            'clientlist #gridclientlist': {
		    	itemclick: this.getAdressesLivraisons
		    },
		     'clientlist #gridadresseslivraisonslist button[action=delete]': {
		    	click: this.deleteAdresseLivraisonClient
		    },
		    'clientlist #gridcommerciallist button[action=delete]': {
		    	click: this.deleteCommercialClient
		    },
		    'clientlist #gridclientlist button[action=edit]': {
		    	click: this.editClient
		    },
		    'clientlist #gridclientlist button[action=delete]': {
		    	click: this.deleteClient
		    },
	        'clientedit button[action=save]': {
	        	click: this.updateClient
	        },
	        'clientadd button[action=save]': {
	        	click: this.createClient
	        },
	        'assignadressadd button[action=save]': {
	        	click:  this.AddAdresseLivraisonClient
	        },
	        'assigncommercialadd button[action=save]': {
	        	click:  this.AddCommercialClient
	        }
        });
    },

	AddCommercialClient: function(button) {
		
		var win = button.up('window'),
	    form = win.down('form'),
	    record = form.getRecord(),
	    values = form.getValues();

		var row = Ext.getCmp('gridclientlist').getSelectionModel().getSelection()[0];
		var com_nom_value = form.getForm().findField("com_id").getRawValue();

	    var CommercialInstance = Ext.create('CT.model.AssigneCommercial', {

		    clc_id : -1,
		    com_nom : com_nom_value,
		    cli_id : row.get("cli_id"),
		    com_id : values['com_id']
		});

	    Ext.getCmp('gridcommerciallist').getStore().add(CommercialInstance);
	    win.close();
		
	  	// synchronize the store after editing the record
	    Ext.getCmp('gridcommerciallist').getStore().sync();
    },

    deleteCommercialClient : function(button) {
		
		var row = Ext.getCmp('gridcommerciallist').getSelectionModel().getSelection()[0];
		Ext.getCmp('gridcommerciallist').getStore().remove(row);
		Ext.getCmp('gridcommerciallist').getStore().sync();
    },

	AddAdresseLivraisonClient: function(button) {
		
		var win = button.up('window'),
	    form = win.down('form'),
	    record = form.getRecord(),
	    values = form.getValues();

		var row = Ext.getCmp('gridclientlist').getSelectionModel().getSelection()[0];

	    var AssigneAdresseInstance = Ext.create('CT.model.AssigneAdresse', {

		    cla_id : -1,
		    adr_adresse : values['adr_adresse'],
		    cli_id : row.get("cli_id"),
		    adr_id : -1
		});

	    Ext.getCmp('gridadresseslivraisonslist').getStore().add(AssigneAdresseInstance);
	    win.close();
		
	  	// synchronize the store after editing the record
	    Ext.getCmp('gridadresseslivraisonslist').getStore().sync();
    },

	deleteAdresseLivraisonClient: function(button) {
		
		var row = Ext.getCmp('gridadresseslivraisonslist').getSelectionModel().getSelection()[0];
		Ext.getCmp('gridadresseslivraisonslist').getStore().remove(row);
		Ext.getCmp('gridadresseslivraisonslist').getStore().sync();
    },

   	getAdressesLivraisons: function( gridclientlist, record, item, index, e, eOpts) {

   		Ext.getCmp('gridadresseslivraisonslist').getStore().getProxy().extraParams = {
    		cli_id: record.get("cli_id")
		};

   		Ext.getCmp('gridadresseslivraisonslist').getStore().load();

   		Ext.getCmp('gridcommerciallist').getStore().getProxy().extraParams = {
    		cli_id: record.get("cli_id")
		};

   		Ext.getCmp('gridcommerciallist').getStore().load();
    },

    onPanelRendered: function() {
    },
	
	deleteClient: function(button) {
		
		var row = Ext.getCmp('gridclientlist').getSelectionModel().getSelection()[0];
		this.getClientsStore().remove(row);
		this.getClientsStore().sync();
    },

    editClient: function(button) {
		
		var record = Ext.getCmp('gridclientlist').getSelectionModel().getSelection()[0];
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
		
		var win = button.up('window');
	    form = win.down('form');
	    record = form.getRecord(),
	    values = form.getValues();

 		var tyc_nom_value = form.getForm().findField("tyc_id").getRawValue();

	    var clientInstance = Ext.create('CT.model.Client', {

		    cli_id : -1,
		    cli_nom : values['cli_nom'],
		    cli_mail : values['cli_mail'],
		    cli_tel : values['cli_tel'],
		    cli_fax : values['cli_fax'],
		    cli_adr_fact : values['cli_adr_fact'],
		    tyc_id : values['tyc_id'],
		    tyc_nom : tyc_nom_value
		});

	    this.getClientsStore().add(clientInstance);
	    win.close();
		
	  	// synchronize the store after editing the record
	    this.getClientsStore().sync();
    }

});