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

        }else if( name == "Edition etiquette" ){

            Ext.create('Ext.window.Window', {
                title: 'Saisir un numero',
                layout: 'fit',
                id : "window_code_barre",
                items: {
                    xtype: 'form',
                    id : "form_code_barre",
                    defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 150
                    },
                    items:[{
                        xtype:"textfield",
                        name: "tf_code_barre",
                        fieldLabel : "Numero"
                    }],
                    buttons: [{
                        text: 'Annuler',
                         handler: function() {
                            
                            Ext.getCmp("window_code_barre").close();
                        }
                    }, {
                        text: 'Editer etiquette',
                        href:"services/editionCodeBarre.php",
                        listeners : {
                            'click' : function(){

                                var values = Ext.getCmp("form_code_barre").getForm().getValues();
                                this.href = "services/editionCodeBarre.php?id="+values.tf_code_barre;
                                this.el.dom.href = this.getHref();
                                Ext.getCmp("window_code_barre").close();
                            }
                        }
                    }]
                }
            }).show();

        }else{
            // Nothing
        }
		
		feed.add(pan);

        if( grid_id != null ){

            Ext.getCmp(grid_id).getStore().load();
        }
	}

});