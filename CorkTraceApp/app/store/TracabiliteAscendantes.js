Ext.define('CT.store.TracabiliteAscendantes', {
    extend: 'Ext.data.Store',
	model: 'CT.model.TracabiliteAscendante',

	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/tracabilite_ascendante/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'tracabilite_ascendante'
	    }
	},
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
		}
	}
	
});