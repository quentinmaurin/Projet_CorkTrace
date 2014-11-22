Ext.define('CT.store.Livraisons', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Livraison',

  	proxy: {
        type: 'ajax',
        api: {
            read: 'data/livraison/read.php',
            update: 'data/livraison/update.php',
            create: 'data/livraison/create.php',
            destroy: 'data/livraison/delete.php'
        },
        reader: {
            type: 'json',
            root: 'livraisons'
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