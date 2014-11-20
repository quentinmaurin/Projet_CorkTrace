Ext.define('CT.controller.CommandeClients', {
    extend: 'Ext.app.Controller',

    stores: ['CommandeClients', 'Produits', 'CommandeClientDetails', 'Clients', 'DelaiPaiements'],
	
	models: ['CommandeClient', 'Produit', 'CommandeClientDetail', 'Client', 'DelaiPaiement'],
	   
    views: [
    	'commandeclient.List',
        'commandeclient.Add'
    ],
	   
    init: function() {
        this.control({
        	'commandeclientlist button[action=delete]': {
		    	click: this.deleteCommandeClient
		    },
            'commandeclientadd #gridajoutproduit': {
                itemdblclick: this.ajoutProduitToDetails
            },
            'commandeclientadd #gridcommandeclientdetails': {
                itemdblclick: this.removeProduit
            },
        });
    },

    deleteCommandeClient: function(button) {
		
		var row = Ext.getCmp('commandeclientlist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
		Ext.getCmp('commandeclientlist').getStore().remove(row);
		Ext.getCmp('commandeclientlist').getStore().sync();
    },
    
    ajoutProduitToDetails: function( gridajoutproduit, record, item, index, e, eOpts){
        
        var pro_exist = Ext.getCmp("gridcommandeclientdetails").getStore().find("pro_id", record.get("pro_id"));

        if( pro_exist == -1){
            Ext.getCmp("gridcommandeclientdetails").getStore().add(record);
        }

        console.log("test");
    },

    removeProduit: function( gridcommandeclientdetails, record, item, index, e, eOpts){
        
        gridcommandeclientdetails.getStore().remove(record);
        console.log("test");
    }
});