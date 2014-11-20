Ext.define('CT.store.CommandeFournisseurDetails', {
    extend: 'Ext.data.Store',
	model: 'CT.model.CommandeFournisseurDetail',

    proxy: {
        type: 'ajax',
        api: {
            read: 'data/commande_fournisseur_detail/read.php',
        },
        reader: {
            type: 'json',
            root: 'commande_detail'
        }
    },

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
            console.log("load store commande fournisseur details = "+successful);
            console.log(records);
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});