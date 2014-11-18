Ext.define('CT.store.Clients', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Client',
	
	//*
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
    autoLoad: true,
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
			console.log("load store = "+successful);
			console.log(records);
		}
	}
	//*/
	
	/*
    data: [
        {"id": 1, "name": 'Ed',    "email": "ed@sencha.com"},
        {"id": 2, "name": 'Tommy', "email": "tommy@sencha.com"}
    ]
	*/
});