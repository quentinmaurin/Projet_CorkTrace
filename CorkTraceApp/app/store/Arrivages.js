Ext.define('CT.store.Arrivages', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Arrivage',

   proxy: {
        type: 'ajax',
        api: {
            read: 'data/arrivage/read.php',
            update: 'data/arrivage/update.php',
            create: 'data/arrivage/create.php',
            destroy: 'data/arrivage/delete.php'
        },
        reader: {
            type: 'json',
            root: 'arrivages'
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