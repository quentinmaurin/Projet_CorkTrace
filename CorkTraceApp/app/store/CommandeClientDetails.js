Ext.define('CT.store.CommandeClientDetails', {
    extend: 'Ext.data.Store',
	model: 'CT.model.CommandeClientDetail',

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
            console.log("load store = "+successful);
            console.log(records);
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});