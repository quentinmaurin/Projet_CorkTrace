Ext.define('CT.view.commandefournisseur.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.commandefournisseuradd',

    title: 'Add Cmd',
    layout: 'border',
    autoShow: true,
    width:"100%",
    height:"100%",

    initComponent: function() {
        
        this.items = [
            {
                xtype:"grid",
                region:"center",
                title:"Details",
                store:"CommandeFournisseurDetails",
                id : "gridcommandefournisseurdetails",
                plugins: [ Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 1
                })],
                columns : [
                    {header: 'Pro Id',  dataIndex: 'pro_id',  flex: 1},
                    {header: 'Nom', dataIndex: 'pro_nom', flex: 1},
                    {header: 'Taille', dataIndex: 'pro_taille', flex: 1},
                    {header: 'Qualite', dataIndex: 'pro_qualite', flex: 1},
                    {header: 'Qte', dataIndex: 'cfd_quantite', flex: 1,
                    field: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 100000
                    }},
                    {header: 'Prix', dataIndex: 'cfd_prix', flex: 1,
                    field: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 100000
                    }}
                ]
            },{
                xtype:"grid",
                region:"south",
                height:"35%",
                id : "gridajoutproduit",
                title:"Ajouter un produit au details",
                store: 'Produits',
                columns : [
                    {header: 'Pro Id',  dataIndex: 'pro_id',  flex: 1},
                    {header: 'Nom', dataIndex: 'pro_nom', flex: 1},
                    {header: 'Taille', dataIndex: 'pro_taille', flex: 1},
                    {header: 'Qualite', dataIndex: 'pro_qualite', flex: 1}
                ]
            },{
                xtype:"form",
                id : "form_add_cmd_fou",
                region:"north",
                height:"15%",
                title:"Commande fournisseur",
                layout : "hbox",
                defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 150
                },
                items: [{
                    xtype: "combobox",
                    name : 'fou_id',
                    fieldLabel: 'Choisir fournisseur',
                    displayField: 'fou_nom',
                    valueField: 'fou_id',
                    store: 'Fournisseurs',
                    queryMode: 'local',
                    listeners: {
                            'afterrender': function(cb, eOpts){
                                cb.getStore().load();
                            }
                    }
                },{
                    xtype:"datefield",
                    name: "cfo_datecmd",
                    fieldLabel: "Date de commmande"
                }]
            }
        ];

        this.buttons = [
            {
                text: 'Ajouter cette commande fournisseur',
                action: 'save',
                handler : function(){

                    console.log("debut loop");
                    var store = Ext.getCmp("gridcommandefournisseurdetails").getStore();

                    var details = new Array();
                    var detail = new Object();
                    store.each(function(record,idx){
                
                        detail.pro_id = record.get("pro_id");
                        detail.cfd_quantite = record.get("cfd_quantite");
                        detail.cfd_prix = record.get("cfd_prix");

                        details.push({
                            "pro_id" : record.get("pro_id"),
                            "cfd_quantite" : record.get("cfd_quantite"),
                            "cfd_prix" : record.get("cfd_prix")
                        });
                    });

                    var values = Ext.getCmp("form_add_cmd_fou").getForm().getValues();

                    var data = new Object();
                    data.fou_id = values.fou_id;
                    data.cfo_datecmd = values.cfo_datecmd;
                    data.details = details;

                    console.log(data);
                    console.log("End loop");

                    Ext.Ajax.request({
                        url: 'data/commande_fournisseur/create.php',
                        method: 'POST',          
                        waitTitle: 'Connecting',
                        waitMsg: 'Sending data...',                                     
                        params: {
                        "data" : JSON.stringify(data)
                        },
                        scope:this,
                        success: true,                                    
                        failure: function(){console.log('failure');}
                    });

                }
            },
            {
                text: 'Annuler',
                scope: this,
                handler: this.close
            }
        ];

        this.callParent(arguments);
    }
});