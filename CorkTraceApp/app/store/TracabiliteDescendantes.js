Ext.define('CT.store.TracabiliteDescendantes', {
    extend: 'Ext.data.Store',
	model: 'CT.model.TracabiliteDescendante',

	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/tracabilite_descendante/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'tracabilite_descendante'
	    }
	},
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
		}
	}
	
});