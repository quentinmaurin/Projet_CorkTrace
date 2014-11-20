Ext.define('CT.store.Produits', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Produit',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/produit/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'produits'
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