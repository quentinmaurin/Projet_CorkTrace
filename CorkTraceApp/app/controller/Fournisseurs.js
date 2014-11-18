Ext.define('CT.controller.Fournisseurs', {
    extend: 'Ext.app.Controller',

    stores: ['Fournisseurs'],
	
	models: ['Fournisseur'],
	   
    views: [
    	'fournisseur.List',
		'fournisseur.Edit'
    ],
	   
    init: function() {
        this.control({
		    'fournisseurlist': {
		    	itemdblclick: this.editFournisseur
		    },
	        'fournisseuredit button[action=save]': {
	        	click: this.updateFournisseur
	        }
        });
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
    }
});