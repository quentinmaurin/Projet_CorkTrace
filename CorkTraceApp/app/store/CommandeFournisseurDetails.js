Ext.define('CT.store.CommandeFournisseurDetails', {
    extend: 'Ext.data.Store',
	model: 'CT.model.CommandeFournisseurDetail',

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
            console.log("load store = "+successful);
            console.log(records);
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});