Ext.define('CT.store.FournisseurRepartitionConformites', {
    extend: 'Ext.data.Store',
	model: 'CT.model.PieChart',
	
	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/stats_fournisseur/read_repartition_conformite_generale.php'
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