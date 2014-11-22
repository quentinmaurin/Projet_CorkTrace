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
            'commandefournisseuradd #gridajoutproduit': {
                itemdblclick: this.ajoutProduitToDetails
            },
            'commandefournisseuradd #gridcommandefournisseurdetails': {
                itemdblclick: this.removeProduit
            },
        });
    },

    ajoutProduitToDetails: function( gridajoutproduit, record, item, index, e, eOpts){
        
        var pro_exist = Ext.getCmp("gridcommandefournisseurdetails").getStore().find("pro_id", record.get("pro_id"));
        
        var cmdFouDetailInstance = Ext.create('CT.model.CommandeFournisseurDetail', {

            pro_id : record.get("pro_id"),
            pro_nom : record.get("pro_nom"),
            pro_taille : record.get("pro_taille"),
            pro_qualite : record.get("pro_qualite"),
            cfd_quantite : 0,
            cfd_prix : 0
        });

        if( pro_exist == -1){
            Ext.getCmp("gridcommandefournisseurdetails").getStore().add(cmdFouDetailInstance);
        }
    },

    removeProduit: function( gridcommandefournisseurdetails, record, item, index, e, eOpts){
        
        gridcommandefournisseurdetails.getStore().remove(record);
    }
});