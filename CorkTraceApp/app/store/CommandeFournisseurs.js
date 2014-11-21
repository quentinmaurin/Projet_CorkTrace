Ext.define('CT.store.CommandeFournisseurs', {
    extend: 'Ext.data.Store',
	model: 'CT.model.CommandeFournisseur',

   proxy: {
        type: 'ajax',
        api: {
            read: 'data/commande_fournisseur/read.php',
            update: 'data/commande_fournisseur/update.php',
            create: 'data/commande_fournisseur/create.php',
            destroy: 'data/commande_fournisseur/delete.php'
        },
        reader: {
            type: 'json',
            root: 'commandes_fournisseurs'
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