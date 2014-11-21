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
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
		}
	}
	
});