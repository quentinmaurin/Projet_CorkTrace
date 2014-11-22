Ext.define('CT.view.arrivage.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.arrivageadd',

    title: 'Add Arrivage',
    layout: 'border',
    autoShow: true,
    width:"100%",
    height:"100%",
    id:"window_arrivage_add",

    initComponent: function() {
        
        this.items = [
            {
                xtype:"grid",
                region:"center",
                title:"Details",
                store:"CommandeFournisseurDetails",
                id : "gridarrivagedetails",
                plugins: [ Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 1
                })],
                columns : [
                    {header: 'Cfd Id',  dataIndex: 'cfd_id',  flex: 1},
                    {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
                    {header: 'Nom', dataIndex: 'pro_nom', flex: 1},
                    {header: 'Taille', dataIndex: 'pro_taille', flex: 1},
                    {header: 'Qualite', dataIndex: 'pro_qualite', flex: 1},
                    {header: 'Cmd Qte', dataIndex: 'cfd_quantite', flex: 1},
                    {header: 'Ari Qte', dataIndex: 'ard_quantite', flex: 1,
                    field: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 99999999
                    }}
                ]
            },{
                xtype:"form",
                id : "form_add_arrivage",
                region:"north",
                height:"15%",
                title:"Arrivage",
                layout : "hbox",
                defaults : {
                    margins : "10 10 10 10",
                    labelWidth : 150
                },
                items: [{
                    xtype:"displayfield",
                    name: "cfo_id",
                    fieldLabel: "Commande cfo_id"
                },{
                    xtype:"displayfield",
                    name: "fou_nom",
                    fieldLabel: "Fournisseur"
                },{
                    xtype:"textfield",
                    name: "ari_responsable",
                    fieldLabel: "Responsable"
                }]
            }
        ];

        this.buttons = [
            {
                text: 'Ajouter arrivage',
                action: 'save',
                handler : function(){

                    var store = Ext.getCmp("gridarrivagedetails").getStore();

                    var details = new Array();
                    store.each(function(record,idx){

                        details.push({
                            "pro_id" : record.get("pro_id"),
                            "ard_quantite" : record.get("ard_quantite")
                        });
                    });

                    var values = Ext.getCmp("form_add_arrivage").getForm().getValues();
                    var cfo_id = Ext.getCmp("form_add_arrivage").getForm().findField("cfo_id").getValue();

                    var data = new Object();
                    data.cfo_id = cfo_id;
                    data.ari_responsable = values.ari_responsable;
                    data.details = details;

                    Ext.Ajax.request({
                        url: 'data/arrivage/create.php',
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

                    Ext.getCmp("arrivagelist").getStore().reload();
                    Ext.getCmp("arrivagelist").getView().refresh();
                    Ext.getCmp("window_arrivage_add").close();

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