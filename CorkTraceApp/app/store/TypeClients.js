Ext.define('CT.store.TypeClients', {
    extend: 'Ext.data.Store',
	model: 'CT.model.TypeClient',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/test.json'
	    },
	    reader: {
	        type: 'json',
	        root: 'type_clients'
	    }
	},
    autoLoad: true,
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
			console.log("load store = "+successful);
			console.log(records);
		}
	}
	
});