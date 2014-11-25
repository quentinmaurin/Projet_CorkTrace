Ext.define('CT.store.StatCommercials', {
    extend: 'Ext.data.Store',
	model: 'CT.model.StatCommercial',

	proxy: {
	    type: 'ajax',
	    api: {
	        read: 'data/stat_commercial/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'statCom'
	    }
	},
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
		}
	}
	
});