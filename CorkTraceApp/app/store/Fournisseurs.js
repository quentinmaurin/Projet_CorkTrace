Ext.define('CT.store.Fournisseurs', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Fournisseur',

   proxy: {
        type: 'ajax',
        api: {
            read: 'data/fournisseur/read.php',
            update: 'data/fournisseur/update.php',
            create: 'data/fournisseur/create.php',
            destroy: 'data/fournisseur/delete.php'
        },
        reader: {
            type: 'json',
            root: 'fournisseurs'
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

            if( operation.action == "create"){

                response =  JSON.parse(operation.response.responseText);
                var idInsert = response.data.fou_id;
                var index = storeFournisseur.find("fou_id", -1);
                storeFournisseur.getAt(index).set("fou_id", idInsert);
            }
        }
    }

});