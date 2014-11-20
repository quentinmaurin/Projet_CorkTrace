Ext.define('CT.controller.Arrivages', {
    extend: 'Ext.app.Controller',

    stores: ['Arrivages'],
	
	models: ['Arrivage'],
	   
    views: [
    	'arrivage.List'
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
		console.log("delete");
        console.log(row);
		Ext.getCmp('arrivagelist').getStore().remove(row);
		Ext.getCmp('arrivagelist').getStore().sync();
    }
});