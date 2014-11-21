Ext.define('CT.controller.TracabiliteAscendantes', {
    extend: 'Ext.app.Controller',

    stores: ['ArrivageDetails', 'TracabiliteAscendantes'],
	
	models: ['ArrivageDetail', 'TracabiliteAscendante'],
	   
    views: [
    	'tracabiliteascendante.List'
    ],
	   
    init: function() {
        this.control({
            'tracabiliteascendantelist #gridtracabiliteascendantelot': {
                itemclick: this.getClientAyantRecuLot
            }
        });
    },

    getClientAyantRecuLot: function( gridclientlist, record, item, index, e, eOpts) {

        Ext.getCmp('gridtracabiliteascendanteclient').getStore().getProxy().extraParams = {
            ard_id: record.get("ard_id")
        };

        Ext.getCmp('gridtracabiliteascendanteclient').getStore().load();
    }
});