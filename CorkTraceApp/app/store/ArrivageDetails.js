Ext.define('CT.store.ArrivageDetails', {
    extend: 'Ext.data.Store',
	model: 'CT.model.ArrivageDetail',

   proxy: {
        type: 'ajax',
        api: {
            read: 'data/arrivage_detail/read.php',
            update: 'data/arrivage_detail/update.php',
            create: 'data/arrivage_detail/create.php',
            destroy: 'data/arrivage_detail/delete.php'
        },
        reader: {
            type: 'json',
            root: 'arrivages_details'
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