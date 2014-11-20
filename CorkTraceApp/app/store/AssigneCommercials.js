Ext.define('CT.store.AssigneCommercials', {
    extend: 'Ext.data.Store',
	model: 'CT.model.AssigneCommercial',
	
	proxy: {
	    type: 'ajax',

	    api: {
	        read: 'data/assign_commercial/read.php'
	    },
	    reader: {
	        type: 'json',
	        root: 'assign_commerciaux'
	    }
	},
    //autoLoad: true,
	
	listeners :{
		
		'load' : function( st, records, successful, eOpts ){
			
			console.log("load store assign commercial = "+successful);
			console.log(records);
		}
	}
	
});