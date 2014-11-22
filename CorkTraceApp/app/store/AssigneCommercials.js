Ext.define('CT.store.AssigneCommercials', {
    extend: 'Ext.data.Store',
	model: 'CT.model.AssigneCommercial',
	
	proxy: {
	    type: 'ajax',

	    api: {
	        read: 'data/assign_commercial/read.php',
	        create: 'data/assign_commercial/create.php',
	        destroy: 'data/assign_commercial/delete.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'assign_commerciaux'
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
		'write' : function( storeAssigneCommercials, operation, eOpts ){

			if( operation.action == "create"){

				response =  JSON.parse(operation.response.responseText);
				var idInsert = response.data.clc_id;
				var index = storeAssigneCommercials.find("clc_id", -1);
				storeAssigneCommercials.getAt(index).set("clc_id", idInsert);
			}
		}
	}
	
});