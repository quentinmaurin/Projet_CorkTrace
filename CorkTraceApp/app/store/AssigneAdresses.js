Ext.define('CT.store.AssigneAdresses', {
    extend: 'Ext.data.Store',
	model: 'CT.model.AssigneAdresse',
	
	proxy: {
	    type: 'ajax',

	    api: {
	        read: 'data/assign_adress/read.php',
	        update: 'data/assign_adress/update.php',
	        create: 'data/assign_adress/create.php',
	        destroy: 'data/assign_adress/delete.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'adresse_livraisons'
	    },
	    writer: {
	        type: 'json',
	        encode: true,
	        root: 'data'
	    }
	},
    //autoLoad: true,
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){

		},

		'write' : function( storeAssigneAdresses, operation, eOpts ){

			if( operation.action == "create"){

				response =  JSON.parse(operation.response.responseText);
				var idInsert = response.data.cla_id;
				var idAddressInsert = response.data.adr_id;
				var index = storeAssigneAdresses.find("cla_id", -1);
				storeAssigneAdresses.getAt(index).set("cla_id", idInsert);
				storeAssigneAdresses.getAt(index).set("adr_id", idAddressInsert);
			}
		}
	}
	
});