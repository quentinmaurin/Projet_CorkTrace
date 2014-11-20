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

		console.log("MENU");
		
		var name = record.get("text");
		var feed = Ext.getCmp("feedviewer");
		feed.removeAll(false);
		
		var pan = null;
		
		if( name == "Client" ){

            console.log("Client");
            pan = {xtype: "clientlist"};

        }else if( name == "Fournisseur" ){

   			console.log("Fournisseur");
   			pan = {xtype: "fournisseurlist"};

        }else if( name == "Commercial" ){

   			console.log("Commercial");
   			pan = {xtype: "commerciallist"};

        }else if( name == "Stock" ){

            console.log("Stock");
            pan = {xtype: "stocklist"};

        }else if( name == "Commande fournisseur" ){

            console.log("Commande fournisseur");
            pan = {xtype: "commandefournisseurlist"};

        }else if( name == "Commande client" ){

            console.log("Commande client");

        }else{
            console.log("Aucun");
        }
		
		feed.add(pan);
	}

});