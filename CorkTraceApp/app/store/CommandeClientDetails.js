Ext.define('CT.store.CommandeClientDetails', {
    extend: 'Ext.data.Store',
	model: 'CT.model.CommandeClientDetail',

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});