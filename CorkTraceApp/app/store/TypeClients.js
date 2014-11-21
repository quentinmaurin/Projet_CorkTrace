Ext.define('CT.store.TypeClients', {
    extend: 'Ext.data.Store',
	model: 'CT.model.TypeClient',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/type_client/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'type_clients'
	    }
	},
    autoLoad: true,
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){

		}
	}
	
});