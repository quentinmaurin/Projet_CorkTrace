Ext.define('CT.controller.Clients', {
    extend: 'Ext.app.Controller',

    stores: ['Clients', 'TypeClients', 'AssigneAdresses', 'Adresses'],
	
	models: ['Client', 'TypeClient', 'AssigneAdresse', 'Adresse'],
	   
    views: [
    	'client.List',
		'client.Edit',
		'client.Add',
		'assignadress.Add'
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
	        }
        });
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

   		//console.log(clientInstance);
	    Ext.getCmp('gridadresseslivraisonslist').getStore().add(AssigneAdresseInstance);
	    win.close();
		
	  	// synchronize the store after editing the record
	    Ext.getCmp('gridadresseslivraisonslist').getStore().sync();
    },

	deleteAdresseLivraisonClient: function(button) {
		
		var row = Ext.getCmp('gridadresseslivraisonslist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
		Ext.getCmp('gridadresseslivraisonslist').getStore().remove(row);
		Ext.getCmp('gridadresseslivraisonslist').getStore().sync();
    },

   	getAdressesLivraisons: function( gridclientlist, record, item, index, e, eOpts) {
   		console.log("Get Adresses Livraisons");

   		Ext.getCmp('gridadresseslivraisonslist').getStore().getProxy().extraParams = {
    		cli_id: record.get("cli_id")
		};

   		Ext.getCmp('gridadresseslivraisonslist').getStore().load();
    },

    onPanelRendered: function() {
        console.log('The panel client was rendered');
		console.log( this.getClientsStore());
    },
	
	deleteClient: function(button) {
		
		var row = Ext.getCmp('gridclientlist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
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