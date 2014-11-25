Ext.define('CT.controller.StatCommercials', {
    extend: 'Ext.app.Controller',

    stores: ['StatCommercials', 'Commercials'],
	
	models: ['StatCommercial', 'Commercial'],
	   
    views: [
    	'statcommercial.List'
    ],
	   
    init: function() {
        this.control({
            'statcommerciallist #gridCommList': {
                itemclick: this.getCommandeDetail
            }
        });
    },

    getCommandeDetail: function( gridclientlist, record, item, index, e, eOpts) {

        Ext.getCmp('griddetailcommande').getStore().getProxy().extraParams = {
            com_id: record.get("com_id")
        };

        Ext.getCmp('griddetailcommande').getStore().load();
    }
});