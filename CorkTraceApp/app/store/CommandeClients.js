Ext.define('CT.store.CommandeClients', {
    extend: 'Ext.data.Store',
	model: 'CT.model.CommandeClient',

   proxy: {
        type: 'ajax',
        api: {
            read: 'data/commande_client/read.php',
            update: 'data/commande_client/update.php',
            create: 'data/commande_client/create.php',
            destroy: 'data/commande_client/delete.php'
        },
        reader: {
            type: 'json',
            root: 'commandes_clients'
        },
        writer: {
            type: 'json',
            encode: true,
            root: 'data'
        }
    },
    autoLoad: true,

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
            console.log("load store = "+successful);
            console.log(records);
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});