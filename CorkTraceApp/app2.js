Ext.onReady(function(){

	/***********************************************************************
	 * VUE TREE MENU
	 ***********************************************************************/
	
	var store_menu = Ext.create('Ext.data.TreeStore', {
	    root: {
	        expanded: true,
	        children: [
	            { text: "Client", leaf: true },
	            { text: "Fournisseur", leaf: true },
	            { text: "Commande client", leaf: true },
	            { text: "Commande fournisseur", leaf: true }
	        ]
	    }
	});

	var tree_menu = Ext.create('Ext.tree.Panel', {
	    width: 200,
	    height: 150,
	    store: store_menu,
	    rootVisible: false,
        collapsible : false
	});
	
	tree_menu.on('itemclick', function(treeMenu, record, item, index, e, eOpts ){
		
		var name = record.get("text");
		var feed = Ext.getCmp("feedviewer");
		feed.removeAll(false);
		
		var pan = null;
		
		if( name == "Client" ){

            console.log("Client");
            pan = Ext.getCmp("pan_client");

        }else if( name == "Fournisseur" ){

            pan = Ext.getCmp("pan_fournisseur");
        }else{
            console.log("Aucun");
        }
		
		feed.add(pan);

	});
	
	/***********************************************************************
	 * VUE CLIENT
	 ***********************************************************************/
	
	
	/* ONGLET CLIENT
	-------------------------------*/

    var typesClient = Ext.create('Ext.data.Store', {
        fields: ['type'],
        data : [
            {"type":"Aucun"},
            {"type":"Particulier"},
            {"type":"Distributeur"},
        ]
    });

    var cb_typesClient = Ext.create('Ext.form.ComboBox', {
        fieldLabel: 'Choisir un type',
        store: typesClient,
        queryMode: 'local',
        displayField: 'type',
        valueField: 'type',
    });
	
	Ext.create('Ext.data.Store', {
	    storeId:'store_client',
	    fields:['nom', 'mail', 'numero_telephone', 'fax', 'adresse_facturation'],
	    data:{
			'items':[
	        { 'nom': "Lisa",  "mail":"toto", "numero_telephone":"06 85 49 38 23", "fax":"fdsq", "adresse_facturation":"fsjd"},
	        { 'nom': "Lisa",  "mail":"toto", "numero_telephone":"06 85 49 38 23", "fax":"fdsq", "adresse_facturation":"fsjd"},
	        { 'nom': "Lisa",  "mail":"toto", "numero_telephone":"06 85 49 38 23", "fax":"fdsq", "adresse_facturation":"fsjd"},
	        { 'nom': "Lisa",  "mail":"toto", "numero_telephone":"06 85 49 38 23", "fax":"fdsq", "adresse_facturation":"fsjd"},
	        { 'nom': "Lisa",  "mail":"toto", "numero_telephone":"06 85 49 38 23", "fax":"fdsq", "adresse_facturation":"fsjd"}
	    	]
		},
	    proxy: {
	        type: 'memory',
	        reader: {
	            type: 'json',
	            root: 'items'
	        }
	    }
	});
	
	var selModel_client = Ext.create('Ext.selection.CheckboxModel', {
         listeners: {
             selectionchange: function(sm, selections) {
                 //grid4.down('#removeButton').setDisabled(selections.length === 0);
             }
         }
	});

	
	var filterRow_grid_client = Ext.create("Ext.ux.grid.FilterRow");
	 
    var grid_client = Ext.create('Ext.grid.Panel', {
        store: Ext.data.StoreManager.lookup('store_client'),
		selModel: selModel_client,
		plugins:[filterRow_grid_client],
		forceFit:true,
	    columns: [
	        { text: 'Nom',  dataIndex: 'nom', filterElement: new Ext.form.TextField() },
	        { text: 'Mail', dataIndex: 'mail', filterElement: new Ext.form.TextField() },
	        { text: 'Telephone', dataIndex: 'numero_telephone' },
	        { text: 'Fax', dataIndex: 'fax' },
	        { text: 'Adresse Fact.', dataIndex: 'adresse_facturation'}
	    ],
		dockedItems: [{
			xtype: 'toolbar',
			dock: 'bottom',
			ui: 'footer',
			padding: 10,
		    layout: {
		    	pack: 'center'
		    },
			items: [{
				minWidth: 80,
				text: 'Supprimer',
				glyph: 'xf057@FontAwesome',
				handler : function(){
					
					  var selectedRec = grid_client.getView().getSelectionModel().getSelection();
					  grid_client.getStore().remove(selectedRec);
				}
			},{
				minWidth: 80,
				text: 'Ajouter',
				glyph: 'xf055@FontAwesome',
                handler: function(){

                    Ext.create('Ext.window.Window', {
                        id:'window_ajout_client',
                        title: 'Ajouter un client',
                        height: "60%",
                        width: "60%",
                        layout: 'fit',
                        items: [{
                            xtype:'form',
                            id: 'form_ajout_client',
                            bodyPadding: 30,
                            defaultType: 'textfield',
                            items: [{
                                fieldLabel: 'Nom',
                                name: 'nom'
                            },{
                                fieldLabel: 'Mail',
                                name: 'mail'
                            },{
                                fieldLabel: 'N°Tel',
                                name: 'numero_telephone'
                            },{
                                fieldLabel: 'Fax',
                                name: 'fax'
                            },{
                                fieldLabel: 'Adresse Fact.',
                                name: 'adresse_facturation'
                            },{
                                xtype: "combobox",
                                fieldLabel: 'Choisir un type',
                                store: typesClient,
                                queryMode: 'local',
                                displayField: 'type',
                                valueField: 'type',
                            }]
                        }],
                        buttons: [{
                            text: 'Ajouter',
                            handler: 	function ajouterContact(){
	
								var rec = Ext.getCmp('form_ajout_client').getValues();
								grid_client.getStore().add(rec);
								Ext.getCmp('window_ajout_client').close();
							}
	
                        }]
                    }).show();
                }
            }]
		}, {
			xtype: 'toolbar',
			items: []
		}],
		listeners:{
			itemclick: function( grid_client, record, item, index, e, eOpts ){
				
				pan_cv = Ext.getCmp("pan_client_view");
			    //pan_mv.body.hide();
			    pan_cv.tpl.overwrite(pan_cv.body, record.data);
			    
				pan_cv.body.slideIn('l', {
			    	duration: 250
			    });
				
			}
		}
	});
	
    var pan_client_view = Ext.create('Ext.Panel', {
		id: 'pan_client_view',
		padding:30,
		border:false,
		tpl: [
		'<center>',
		'<div class="details">',
			'<tpl for=".">',
				'<div class="details-info">',
					'<p><b>Nom : </b>{nom}</p>',
					'<p><b>Prenom : </b>{prenom}</p>',
					'<p><b>Telephone : </b>{numero_telephone}</p>',
				'</div>',
			'</tpl>',
		'</div>' ,
		'</center>'  
		]
	});
 
	var pan_client = Ext.create('Ext.panel.Panel',{
		id:"pan_client",
		layout:"border",
		items:[{
			xtype:"panel",
			region:"center",
			title:"Liste des clients",
			layout:"fit",
			items:[grid_client]
		},{
			xtype:"panel",
			region:"east",
			title:"Information du client",
			width:"35%",
			layout:"fit",
			items:[pan_client_view]
		}]	
	});

	/***********************************************************************
	 * VUE FOURNISSEUR
	 ***********************************************************************/
	
	
	/* ONGLET FOURNISSEUR
	-------------------------------*/

    var typesFournisseur = Ext.create('Ext.data.Store', {
        fields: ['type'],
        data : [
            {"type":"Aucun"},
            {"type":"Particulier"},
            {"type":"Distributeur"},
        ]
    });

    var cb_typesFournisseur = Ext.create('Ext.form.ComboBox', {
        fieldLabel: 'Choisir un type',
        store: typesFournisseur,
        queryMode: 'local',
        displayField: 'type',
        valueField: 'type',
    });
	
	Ext.create('Ext.data.Store', {
	    storeId:'store_fournisseur',
	    fields:['nom', 'adresse', 'mail', 'numero_telephone', 'fax'],
	    data:{
			'items':[
	        { 'nom': "Lisa",  "adresse":"toto", "mail": "fesef", "numero_telephone":"06 85 49 38 23", "fax":"fdsq"},
	        { 'nom': "Lisa",  "adresse":"toto", "mail": "fesef", "numero_telephone":"06 85 49 38 23", "fax":"fdsq"},
	        { 'nom': "Lisa",  "adresse":"toto", "mail": "fesef", "numero_telephone":"06 85 49 38 23", "fax":"fdsq"},
	        { 'nom': "Lisa",  "adresse":"toto", "mail": "fesef", "numero_telephone":"06 85 49 38 23", "fax":"fdsq"},
	        { 'nom': "Lisa",  "adresse":"toto", "mail": "fesef", "numero_telephone":"06 85 49 38 23", "fax":"fdsq"}
	    	]
		},
	    proxy: {
	        type: 'memory',
	        reader: {
	            type: 'json',
	            root: 'items'
	        }
	    }
	});
	
	var selModel_fournisseur = Ext.create('Ext.selection.CheckboxModel', {
         listeners: {
             selectionchange: function(sm, selections) {
                 //grid4.down('#removeButton').setDisabled(selections.length === 0);
             }
         }
	});

	
	var filterRow_grid_fournisseur = Ext.create("Ext.ux.grid.FilterRow");
	 
    var grid_fournisseur = Ext.create('Ext.grid.Panel', {
        store: Ext.data.StoreManager.lookup('store_fournisseur'),
		selModel: selModel_fournisseur,
		plugins:[filterRow_grid_fournisseur],
		forceFit:true,
	    columns: [
	        { text: 'Nom',  dataIndex: 'nom', filterElement: new Ext.form.TextField() },
	        { text: 'Adresse',  dataIndex: 'adresse', filterElement: new Ext.form.TextField() },
	        { text: 'Mail', dataIndex: 'mail', filterElement: new Ext.form.TextField() },
	        { text: 'Telephone', dataIndex: 'numero_telephone' },
	        { text: 'Fax', dataIndex: 'fax' }
	    ],
		dockedItems: [{
			xtype: 'toolbar',
			dock: 'bottom',
			ui: 'footer',
			padding: 10,
		    layout: {
		    	pack: 'center'
		    },
			items: [{
				minWidth: 80,
				text: 'Supprimer',
				glyph: 'xf057@FontAwesome',
				handler : function(){
					
					  var selectedRec = grid_fournisseur.getView().getSelectionModel().getSelection();
					  grid_fournisseur.getStore().remove(selectedRec);
				}
			},{
				minWidth: 80,
				text: 'Ajouter',
				glyph: 'xf055@FontAwesome',
                handler: function(){

                    Ext.create('Ext.window.Window', {
                        id:'window_ajout_fournisseur',
                        title: 'Ajouter un fournisseur',
                        height: "60%",
                        width: "60%",
                        layout: 'fit',
                        items: [{
                            xtype:'form',
                            id: 'form_ajout_fournisseur',
                            bodyPadding: 30,
                            defaultType: 'textfield',
                            items: [{
                                fieldLabel: 'Nom',
                                name: 'nom'
                            },{
                                fieldLabel: 'Adresse',
                                name: 'adresse'
                            },{
                                fieldLabel: 'Mail',
                                name: 'mail'
                            },{
                                fieldLabel: 'N°Tel',
                                name: 'numero_telephone'
                            },{
                                fieldLabel: 'Fax',
                                name: 'fax'
                            },{
                                xtype: "combobox",
                                fieldLabel: 'Choisir un type',
                                store: typesFournisseur,
                                queryMode: 'local',
                                displayField: 'type',
                                valueField: 'type',
                            }]
                        }],
                        buttons: [{
                            text: 'Ajouter',
                            handler: 	function ajouterContact(){
	
								var rec = Ext.getCmp('form_ajout_fournisseur').getValues();
								grid_fournisseur.getStore().add(rec);
								Ext.getCmp('window_ajout_fournisseur').close();
							}
	
                        }]
                    }).show();
                }
            }]
		}, {
			xtype: 'toolbar',
			items: []
		}],
		listeners:{
			itemclick: function( grid_fournisseur, record, item, index, e, eOpts ){
				
				pan_cv = Ext.getCmp("pan_fournisseur_view");
			    //pan_mv.body.hide();
			    pan_cv.tpl.overwrite(pan_cv.body, record.data);
			    
				pan_cv.body.slideIn('l', {
			    	duration: 250
			    });
				
			}
		}
	});
	
    var pan_fournisseur_view = Ext.create('Ext.Panel', {
		id: 'pan_fournisseur_view',
		padding:30,
		border:false,
		tpl: [
		'<center>',
		'<div class="details">',
			'<tpl for=".">',
				'<div class="details-info">',
					'<p><b>Nom : </b>{nom}</p>',
					'<p><b>Prenom : </b>{adresse}</p>',
					'<p><b>Telephone : </b>{numero_telephone}</p>',
				'</div>',
			'</tpl>',
		'</div>' ,
		'</center>'  
		]
	});
 
	var pan_fournisseur = Ext.create('Ext.panel.Panel',{
		id:"pan_fournisseur",
		layout:"border",
		items:[{
			xtype:"panel",
			region:"center",
			title:"Liste des fournisseurs",
			layout:"fit",
			items:[grid_fournisseur]
		},{
			xtype:"panel",
			region:"east",
			title:"Information du fournisseur",
			width:"35%",
			layout:"fit",
			items:[pan_fournisseur_view]
		}]	
	});
	
	/***********************************************************************
	 * VIEWPORT
	 ***********************************************************************/
	
	var viewport = Ext.create('Ext.container.Viewport', {
		renderTo:"app",
		name: "viewport",
		layout: "border",
		items:[{
			region:"north",
			title: "CorkTrace"
		},{
			xtype: "panel",
			region: "west",
			title: "Menu",
			width: "20%",
			layout: "fit",
			items: [tree_menu]
		},{
			xtype: "panel",
			region: "center",
			layout:"fit",
			id:"feedviewer",
			items:[]
		}]
	});
	
});
