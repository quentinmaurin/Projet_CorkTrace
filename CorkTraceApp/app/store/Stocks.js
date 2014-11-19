Ext.define('CT.store.Stocks', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Stock',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/stock/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'stocks'
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