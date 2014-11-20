Ext.define('CT.controller.CommandeFournisseurs', {
    extend: 'Ext.app.Controller',

    stores: ['CommandeFournisseurs', 'Produits', 'CommandeFournisseurDetails', 'Fournisseurs'],
	
	models: ['CommandeFournisseur', 'Produit', 'CommandeFournisseurDetail', 'Fournisseur'],
	   
    views: [
    	'commandefournisseur.List',
        'commandefournisseur.Add'
    ],
	   
    init: function() {
        this.control({
        	'commandefournisseurlist button[action=delete]': {
		    	click: this.deleteCommandeFournisseur
		    },
            'commandefournisseuradd #gridajoutproduit': {
                itemdblclick: this.ajoutProduitToDetails
            },
            'commandefournisseuradd #gridcommandefournisseurdetails': {
                itemdblclick: this.removeProduit
            },
        });
    },

    deleteCommandeFournisseur: function(button) {
		
		var row = Ext.getCmp('commandefournisseurlist').getSelectionModel().getSelection()[0];
		console.log("delete");
        console.log(row);
		Ext.getCmp('commandefournisseurlist').getStore().remove(row);
		Ext.getCmp('commandefournisseurlist').getStore().sync();
    },
    
    ajoutProduitToDetails: function( gridajoutproduit, record, item, index, e, eOpts){
        
        var pro_exist = Ext.getCmp("gridcommandefournisseurdetails").getStore().find("pro_id", record.get("pro_id"));

        if( pro_exist == -1){
            Ext.getCmp("gridcommandefournisseurdetails").getStore().add(record);
        }

        console.log("test");
    },

    removeProduit: function( gridcommandefournisseurdetails, record, item, index, e, eOpts){
        
        gridcommandefournisseurdetails.getStore().remove(record);
        console.log("test");
    }
});