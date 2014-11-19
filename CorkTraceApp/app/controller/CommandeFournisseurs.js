Ext.define('CT.controller.CommandeFournisseurs', {
    extend: 'Ext.app.Controller',

    stores: ['CommandeFournisseurs'],
	
	models: ['CommandeFournisseur'],
	   
    views: [
    	'commandefournisseur.List',
    ],
	   
    init: function() {
        this.control({
        	'commandefournisseurlist button[action=delete]': {
		    	click: this.deleteCommandeFournisseur
		    },
        });
    },

    deleteCommandeFournisseur: function(button) {
		
		var row = Ext.getCmp('commandefournisseurlist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
		Ext.getCmp('commandefournisseurlist').getStore().remove(row);
		Ext.getCmp('commandefournisseurlist').getStore().sync();
    }
});