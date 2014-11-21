Ext.define('CT.controller.Menu', {
    extend: 'Ext.app.Controller',

    stores: ['Menu'],
	   
    views: [
    	'menu.List'
    ],
	   
    init: function() {
        this.control({
		    'menulist': {
		    	itemclick: this.showPanel
		    }
        });
    },

	showPanel : function(treeMenu, record, item, index, e, eOpts ){
		
		var name = record.get("text");
		var feed = Ext.getCmp("feedviewer");
		feed.removeAll(false);
		
		var pan = null;
        var grid_id = null;
		
		if( name == "Client" ){

            pan = {xtype: "clientlist"};
            grid_id= "gridclientlist";

        }else if( name == "Fournisseur" ){

   			pan = {xtype: "fournisseurlist"};
            grid_id= "fournisseurlist";

        }else if( name == "Commercial" ){

   			pan = {xtype: "commerciallist"};
            grid_id= "commerciallist";

        }else if( name == "Stock" ){

            pan = {xtype: "stocklist"};
            grid_id= "stocklist";

        }else if( name == "Commande fournisseur" ){

            pan = {xtype: "commandefournisseurlist"};
            grid_id= "commandefournisseurlist";

        }else if( name == "Arrivage" ){

            pan = {xtype: "arrivagelist"};
            grid_id= "arrivagelist";

        }else if( name == "Commande client" ){

            pan = {xtype: "commandeclientlist"};
            grid_id= "commandeclientlist";

        }else if( name == "Livraison" ){

        }else if( name == "Ascendante" ){

            pan = {xtype: "tracabiliteascendantelist"};
            grid_id= "gridtracabiliteascendantelot";

        }else if( name == "Descendante" ){

            pan = {xtype: "tracabilitedescendantelist"};
            grid_id= "gridtracabilitedescendantelot";

        }else if( name == "Stats Fournisseur" ){

        }else if( name == "Stats Client" ){

        }else if( name == "Fournisseur/Produit" ){

        }else if( name == "Client/Produit" ){

        }else{
            // Nothing
        }
		
		feed.add(pan);

        if( grid_id != null ){

            Ext.getCmp(grid_id).getStore().load();
        }
	}

});