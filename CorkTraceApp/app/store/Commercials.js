Ext.define('CT.store.Commercials', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Commercial',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/commercial/read.php',
	        update: 'data/commercial/update.php',
	        create: 'data/commercial/create.php',
	        destroy: 'data/commercial/delete.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'commercials'
	    },
	    writer: {
	        type: 'json',
	        encode: true,
	        root: 'data'
	    }
	},
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
		},

		'write' : function( storeCommercial, operation, eOpts ){

			if( operation.action == "create"){

				response =  JSON.parse(operation.response.responseText);
				var idInsert = response.data.com_id;
				var index = storeCommercial.find("com_id", -1);
				storeCommercial.getAt(index).set("com_id", idInsert);
			}
		}
	}
	
});