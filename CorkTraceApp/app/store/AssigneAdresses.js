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
			
			console.log("load store = "+successful);
			console.log(records);
		},

		'write' : function( storeClient, operation, eOpts ){
			console.log("write");
		}
	}
	
});