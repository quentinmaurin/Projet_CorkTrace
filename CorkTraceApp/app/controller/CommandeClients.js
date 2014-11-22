Ext.define('CT.controller.CommandeClients', {
    extend: 'Ext.app.Controller',

    stores: ['CommandeClients', 'Produits', 'CommandeClientDetails', 'Clients', 'DelaiPaiements', 'AssigneCommercials', 'AssigneAdresses'],
	
	models: ['CommandeClient', 'Produit', 'CommandeClientDetail', 'Client', 'DelaiPaiement', 'AssigneCommercial', 'AssigneAdresse'],
	   
    views: [
    	'commandeclient.List',
        'commandeclient.Add'
    ],
	   
    init: function() {
        this.control({
            'commandeclientadd #gridajoutproduit': {
                itemdblclick: this.ajoutProduitToDetails
            },
            'commandeclientadd #gridcommandeclientdetails': {
                itemdblclick: this.removeProduit
            },
        });
    },
    
    ajoutProduitToDetails: function( gridajoutproduit, record, item, index, e, eOpts){
        
        var pro_exist = Ext.getCmp("gridcommandeclientdetails").getStore().find("pro_id", record.get("pro_id"));

        var cmdCliDetailInstance = Ext.create('CT.model.CommandeClientDetail', {

            pro_id : record.get("pro_id"),
            pro_nom : record.get("pro_nom"),
            pro_taille : record.get("pro_taille"),
            pro_qualite : record.get("pro_qualite"),
            ccd_quantite : 0,
            ccd_prix : 0,
            ccd_id : "",
            ccl_id : "",
            ccd_marquage : ""
        });

        if( pro_exist == -1){
            Ext.getCmp("gridcommandeclientdetails").getStore().add(cmdCliDetailInstance);
            cmdCliDetailInstance.set("ccd_marquage", "");
        }
    },

    removeProduit: function( gridcommandeclientdetails, record, item, index, e, eOpts){
        
        gridcommandeclientdetails.getStore().remove(record);
    }
});