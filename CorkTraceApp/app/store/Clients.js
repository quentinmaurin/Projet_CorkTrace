Ext.define('CT.store.Clients', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Client',
	
	//*
    proxy: {
    	type: 'ajax',
        url: 'data/clients.json',
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