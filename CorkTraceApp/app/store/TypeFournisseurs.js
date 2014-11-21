Ext.define('CT.store.TypeFournisseurs', {
    extend: 'Ext.data.Store',
	model: 'CT.model.TypeFournisseur',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/type_fournisseur/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'type_fournisseurs'
	    }
	},
    autoLoad: true,
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
		}
	}
	
});