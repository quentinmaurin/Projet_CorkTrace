Ext.define('CT.controller.TracabiliteDescendantes', {
    extend: 'Ext.app.Controller',

    stores: ['LivraisonDetails', 'TracabiliteDescendantes'],
	
	models: ['LivraisonDetail', 'TracabiliteDescendante'],
	   
    views: [
    	'tracabilitedescendante.List'
    ],
	   
    init: function() {
        this.control({
            'tracabilitedescendantelist #gridtracabilitedescendantelot': {
                itemclick: this.getFournisseurPossedantLot
            }
        });
    },

    getFournisseurPossedantLot: function( gridclientlist, record, item, index, e, eOpts) {

        Ext.getCmp('gridtracabilitedescendanteclient').getStore().getProxy().extraParams = {
            lid_id: record.get("lid_id")
        };

        Ext.getCmp('gridtracabilitedescendanteclient').getStore().load();
    }
});