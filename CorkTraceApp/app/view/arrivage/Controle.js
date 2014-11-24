Ext.define('CT.view.arrivage.Controle', {
    extend: 'Ext.window.Window',
    alias: 'widget.arrivagecontrole',

    title: 'Controler Arrivage',
    layout: 'border',
    autoShow: true,
    width:"100%",
    height:"100%",
    id:"window_arrivage_controle",
    closable:true,

    initComponent: function() {
        
        this.items = [{
            xtype: "panel",
            region : "center",
            layout : "border",
            items : [{
                xtype:"grid",
                region:"center",
                title:"Details",
                store:"ArrivageDetails",
                id : "gridarrivagecontroledetails",
                columns : [
                    {header: 'Cfd Id',  dataIndex: 'ard_id',  flex: 1},
                    {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
                    {header: 'Nom', dataIndex: 'pro_nom', flex: 1},
                    {header: 'Taille', dataIndex: 'pro_taille', flex: 1},
                    {header: 'Qualite', dataIndex: 'pro_qualite', flex: 1},
                    {header: 'Ari Qte', dataIndex: 'ard_quantite', flex: 1},
                    {header: 'Cfm Id', dataIndex: 'cfm_id', flex: 1},
                    {header: 'Gout', dataIndex: 'cfm_gout', flex: 1}
                ],
                listeners : {
                    'itemclick': function( grid, record, item, index, e, eOpts ){

                        Ext.getCmp('gridarrivagecontrolemesures').getStore().getProxy().extraParams = {
                            cfm_id: record.get("cfm_id")
                        };
                        Ext.getCmp('gridarrivagecontrolemesures').getStore().load();

                        Ext.getCmp('form_controle_arrivage_details').getForm().loadRecord(record);
                    }
                }
            },{
                xtype:"panel",
                region: "east",
                width: "70%",
                layout : "border",
                bbar: ['->',{
                    text:"Valider la confirmite et les mesures de ce lot",
                    handler : function(){

                        var store = Ext.getCmp("gridarrivagecontrolemesures").getStore();
                        var details = new Array();
                        store.each(function(record,idx){

                            details.push({
                                "mes_id" : record.get("mes_id"),
                                "mes_longueur" : record.get("mes_longueur"),
                                "mes_diam" : record.get("mes_diam"),
                                "mes_oval" :  record.get("mes_oval"),
                                "cfm_id" :  record.get("cfm_id")
                            });
                        });

                        var values = Ext.getCmp("form_controle_arrivage_details").getForm().getValues();
                        var cfm_id = Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_id").getValue();
                        var cfm_decision = Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_decision").getValue();

                        var data = new Object();
                        data.cfm_id = cfm_id;
                        data.cfm_tca_fourni = values.cfm_tca_fourni;
                        data.cfm_tca_inter = values.cfm_tca_inter;
                        data.cfm_gout = values.cfm_gout;
                        data.cfm_capilarite = values.cfm_capilarite;
                        data.cfm_humidite = values.cfm_humidite;
                        data.cfm_diamcompr = values.cfm_diamcompr;
                        data.cfm_decision = cfm_decision;
                        data.details = details;

                        Ext.Ajax.request({
                            url: 'data/controle/update.php',
                            method: 'POST',          
                            waitTitle: 'Connecting',
                            waitMsg: 'Sending data...',                                     
                            params: {
                            "data" : JSON.stringify(data)
                            },
                            scope:this,
                            success: function(response, opts) {
                              
                                var responseParse = JSON.parse(response.responseText);

                                var values = Ext.getCmp("form_controle_arrivage_details").getForm().getValues();
                                var cfm_id = Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_id").getValue();
                                Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_decision").setValue(responseParse.cfm_decision);
                                var cfm_decision = Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_decision").getValue();
                                var row = Ext.getCmp('gridarrivagecontroledetails').getSelectionModel().getSelection()[0];
                                row.set(values);
                                row.set("cfm_decision", cfm_decision);

                            },                                    
                            failure: function(){
                                alert("echec ajout");
                            }
                        });

                    }
                },{
                    text:"Generer automatiquement pour ce lot"
                },{
                    text:"PDF Conformite du lot", href:"services/conformiteArrivage.php",
                    listeners : {
                        'click' : function(){

                            var row = Ext.getCmp('gridarrivagecontroledetails').getSelectionModel().getSelection()[0];
                            var ard_id = row.get("ard_id");
                            this.href = "services/conformiteArrivage.php?id="+ard_id;
                            this.el.dom.href = this.getHref();
                        }
                    }
                },'->'],
                items:[{
                    xtype:"form",
                    id : "form_controle_arrivage_details",
                    region:"north",
                    height:"20%",
                    title:"Controle",
                    layout : "vbox",
                    items: [{
                        xtype:"panel",
                        layout: "hbox",
                        border:false,
                        defaults : {
                            margins : "10 10 10 10",
                            labelWidth : 100,
                            width:170
                        },
                        items : [{
                            xtype:"displayfield",
                            name: "cfm_id",
                            fieldLabel: "Cfm id"
                        },{
                            xtype:"textfield",
                            name: "cfm_tca_fourni",
                            fieldLabel: "TCA Fourni"
                        },{
                            xtype:"textfield",
                            name: "cfm_tca_inter",
                            fieldLabel: "TCA Inter"
                        },{
                            xtype:"textfield",
                            name: "cfm_gout",
                            fieldLabel: "Gout"
                        }]
                    },{
                        xtype:"panel",
                        layout: "hbox",
                        border:false,
                        defaults : {
                            margins : "10 10 10 10",
                            labelWidth : 100,
                            width:170
                        },
                        items:[{
                            xtype:"textfield",
                            name: "cfm_capilarite",
                            fieldLabel: "Capilarite"
                        },{
                            xtype:"textfield",
                            name: "cfm_humidite",
                            fieldLabel: "Humidite"
                        },{
                            xtype:"textfield",
                            name: "cfm_diamcompr",
                            fieldLabel: "Diam compr."
                        },{
                            xtype:"displayfield",
                            name: "cfm_decision",
                            fieldLabel: "Decision"
                        }]
                    }]
                },{
                    xtype:"grid",
                    region:"center",
                    title:"Les 16 mesures par lot",
                    store:"Mesures",
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
        }];

        this.callParent(arguments);
    }
});