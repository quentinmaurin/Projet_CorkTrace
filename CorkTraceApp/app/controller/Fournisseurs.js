Ext.define('CT.controller.Fournisseurs', {
    extend: 'Ext.app.Controller',

    stores: ['Fournisseurs', 'TypeFournisseurs'],
	
	models: ['Fournisseur', 'TypeFournisseur'],
	   
    views: [
    	'fournisseur.List',
		'fournisseur.Edit',
		'fournisseur.Add'
    ],
	   
    init: function() {
        this.control({
		    'fournisseurlist': {
		    	itemdblclick: this.editFournisseur
		    },
		    'fournisseurlist button[action=delete]': {
		    	click: this.deleteFournisseur
		    },
	        'fournisseuredit button[action=save]': {
	        	click: this.updateFournisseur
	        },
	        'fournisseuradd button[action=save]': {
	        	click: this.createFournisseur
	        }
        });
    },
	
	deleteFournisseur: function(button) {
		
		var row = Ext.getCmp('fournisseurlist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
		this.getFournisseursStore().remove(row);
		this.getFournisseursStore().sync();
    },

    editFournisseur: function(grid, record) {
		
        var view = Ext.widget('fournisseuredit');
        view.down('form').loadRecord(record);
    },
	
    updateFournisseur: function(button) {
		
		var win = button.up('window'),
	    form = win.down('form'),
	    record = form.getRecord(),
	    values = form.getValues();

	    record.set(values);
	    win.close();
		
	  	// synchronize the store after editing the record
	    this.getFournisseursStore().sync();
    },
    createFournisseur: function(button) {
		
		console.log("create fournisseur");
		var win = button.up('window'),
	    form = win.down('form'),
	    record = form.getRecord(),
	    values = form.getValues();

	    var fournisseurInstance = Ext.create('CT.model.Fournisseur', {

		    fou_id : -1,
		    fou_nom : values['fou_nom'],
		    fou_adresse : values['fou_adresse'],
		    fou_mail : values['fou_mail'],
		    fou_tel : values['fou_tel'],
		    fou_fax : values['fou_fax'],
		    tyf_id : values['tyf_id']
		});

   		//console.log(clientInstance);
	    this.getFournisseursStore().add(fournisseurInstance);
	    win.close();
		
	  	// synchronize the store after editing the record
	    this.getFournisseursStore().sync();
    }
});