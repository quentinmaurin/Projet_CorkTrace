Ext.define('CT.controller.StatClients', {
    extend: 'Ext.app.Controller',

    stores: ['Clients'],
	
	models: ['Client'],
	   
    views: [
    	'statclient.List',
        'statclient.ListLot'
    ],
	   
    init: function() {
        this.control({
        });
    }
});