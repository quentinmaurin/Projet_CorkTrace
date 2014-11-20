Ext.define('CT.controller.CommandeClients', {
    extend: 'Ext.app.Controller',

    stores: ['CommandeClients'],
	
	models: ['CommandeClient'],
	   
    views: [
    	'commandeclient.List'
    ],
	   
    init: function() {
        this.control({
        	'commandeclientlist button[action=delete]': {
		    	click: this.deleteArrivage
		    }
        });
    },

    deleteArrivage: function(button) {
		
		var row = Ext.getCmp('commandeclientlist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
		Ext.getCmp('commandeclientlist').getStore().remove(row);
		Ext.getCmp('commandeclientlist').getStore().sync();
    }
});