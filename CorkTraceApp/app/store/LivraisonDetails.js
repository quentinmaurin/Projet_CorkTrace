Ext.define('CT.store.LivraisonDetails', {
    extend: 'Ext.data.Store',
	model: 'CT.model.LivraisonDetail',

  	proxy: {
        type: 'ajax',
        api: {
            read: 'data/livraison_detail/read.php'
        },
        reader: {
            type: 'json',
            root: 'livraisons_details'
        },
        writer: {
            type: 'json',
            encode: true,
            root: 'data'
        }
    },

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});