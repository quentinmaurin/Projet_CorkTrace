Ext.define('CT.store.Clients', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Client',

	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/client/read.php',
	        update: 'data/client/update.php',
	        create: 'data/client/create.php',
	        destroy: 'data/client/delete.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'clients'
	    },
	    writer: {
	        type: 'json',
	        encode: true,
	        root: 'data'
	    }
	},
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
			console.log("load store client = "+successful);
			console.log(records);
		},

		'write' : function( storeClient, operation, eOpts ){

			//console.log(operation);

			if( operation.action == "create"){

				response =  JSON.parse(operation.response.responseText);
				var idInsert = response.data.cli_id;
				var index = storeClient.find("cli_id", -1);
				storeClient.getAt(index).set("cli_id", idInsert);
			}
		}
	}
	
});