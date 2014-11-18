Ext.define('CT.store.Clients', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Client',
	
	//*
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/clients2.php',
	        update: 'data/updateClients.php',
	        create: 'data/createClients.php?action=adrien',
	        destroy: 'data/destroyClients.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'clients'
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