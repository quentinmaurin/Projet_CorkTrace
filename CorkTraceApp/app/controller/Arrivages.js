Ext.define('CT.controller.Arrivages', {
    extend: 'Ext.app.Controller',

    stores: ['Arrivages', 'CommandeFournisseurDetails'],
	
	models: ['Arrivage', 'CommandeFournisseurDetail'],
	   
    views: [
    	'arrivage.List',
        'arrivage.Add'
    ],
	   
    init: function() {
        this.control({
        	'arrivagelist button[action=delete]': {
		    	click: this.deleteArrivage
		    }
        });
    },

    deleteArrivage: function(button) {
		
		var row = Ext.getCmp('arrivagelist').getSelectionModel().getSelection()[0];
		Ext.getCmp('arrivagelist').getStore().remove(row);
		Ext.getCmp('arrivagelist').getStore().sync();
    }
});