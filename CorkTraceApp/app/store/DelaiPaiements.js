Ext.define('CT.store.DelaiPaiements', {
    extend: 'Ext.data.Store',
	model: 'CT.model.DelaiPaiement',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/delai_paiement/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'delai_paiement'
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