Ext.define('CT.store.FournisseurProbaConformites', {
    extend: 'Ext.data.Store',
	model: 'CT.model.PieChart',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/stats_fournisseur/read_taux_conformite.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'fournisseurs'
	    }
	},
    autoLoad: true,
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
		}
	}
	
});