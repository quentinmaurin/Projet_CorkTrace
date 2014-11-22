Ext.define('CT.store.CommandeClientDetails', {
    extend: 'Ext.data.Store',
	model: 'CT.model.CommandeClientDetail',
  
  	proxy: {
        type: 'ajax',
        api: {
            read: 'data/commande_client_detail/read.php',
        },
        reader: {
            type: 'json',
            root: 'commande_detail'
        }
    },

    listeners :{
        
        'load' : function( st, records, successful, eOpts ){
            
        },

        'write' : function( storeFournisseur, operation, eOpts ){

        }
    }

});