Ext.define('CT.store.Mesures', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Mesure',

    proxy: {
        type: 'ajax',
        api: {
            read: 'data/mesure/read.php',
        },
        reader: {
            type: 'json',
            root: 'mesures'
        }
    },

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});