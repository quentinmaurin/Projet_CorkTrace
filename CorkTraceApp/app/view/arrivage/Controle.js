Ext.define('CT.view.arrivage.Controle', {
    extend: 'Ext.window.Window',
    alias: 'widget.arrivagecontrole',

    title: 'Controler Arrivage',
    layout: 'border',
    autoShow: true,
    width:"100%",
    height:"100%",
    id:"window_arrivage_controle",
    closable:false,

    initComponent: function() {
        
        this.items = [{
            xtype: "panel",
            region : "center",
            layout : "border",
            items : [{
                xtype:"grid",
                region:"center",
                title:"Details",
                store:"",
                id : "gridarrivagecontroledetails",
                columns : [
                    {header: 'Cfd Id',  dataIndex: 'ard_id',  flex: 1},
                    {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
                    {header: 'Nom', dataIndex: 'pro_nom', flex: 1},
                    {header: 'Taille', dataIndex: 'pro_taille', flex: 1},
                    {header: 'Qualite', dataIndex: 'pro_qualite', flex: 1},
                    {header: 'Ari Qte', dataIndex: 'ard_quantite', flex: 1}
                ]
            },{
                xtype:"panel",
                region: "east",
                width: "70%",
                layout : "border",
                items:[{
                    xtype:"form",
                    id : "form_controle_arrivage_details",
                    region:"north",
                    height:"15%",
                    title:"Controle",
                    layout : "hbox",
                    defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 70
                    },
                    items: [{
                        xtype:"textfield",
                        name: "tca_ext",
                        fieldLabel: "TCA Ext"
                    },{
                        xtype:"textfield",
                        name: "tca_int",
                        fieldLabel: "TCA Interne"
                    },{
                        xtype:"textfield",
                        name: "humidite",
                        fieldLabel: "Humidite"
                    }]
                },{
                    xtype:"grid",
                    region:"center",
                    title:"Les 16 mesures par lot",
                    store:"",
                    id : "gridarrivagecontrolemesures",
                    plugins: [ Ext.create('Ext.grid.plugin.CellEditing', {
                        clicksToEdit: 1
                    })],
                    columns : [
                        {header: 'Mes id',  dataIndex: 'mes_id',  flex: 1},
                        {header: 'Longueur', dataIndex: 'mes_longueur', flex: 1,
                        field: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 99999999
                        }},
                        {header: 'Diam', dataIndex: 'mes_diam', flex: 1,
                        field: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 99999999
                        }},
                        {header: 'Oval', dataIndex: 'mes_oval', flex: 1,
                        field: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 99999999
                        }},
                        {header: 'Cfm id', dataIndex: 'cfm_id', flex: 1}
                    ]
                }]
                
            }]
        },{
            xtype:"form",
            id : "form_controle_arrivage",
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
                name: "ari_id",
                fieldLabel: "Arrivage id"
            },{
                xtype:"textfield",
                name: "cfm_responsable",
                fieldLabel: "Responsable"
            }]
        }];

        this.buttons = [
            {
                text: 'Valider le controle',
                action: 'save',
                handler : function(){

                    /*
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
                        success: function(response, opts) {

                            Ext.getCmp("arrivagelist").getStore().reload();
                            Ext.getCmp("arrivagelist").getView().refresh();
                            Ext.getCmp("window_arrivage_add").close();
                        },                                   
                        failure: function(){

                            alert("echec ajout");
                            Ext.getCmp("window_arrivage_add").close();
                        }
                    });*/

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