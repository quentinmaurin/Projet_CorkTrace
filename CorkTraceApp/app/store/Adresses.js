Ext.define('CT.store.Adresses', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Adresse',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/test.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'adresses'
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