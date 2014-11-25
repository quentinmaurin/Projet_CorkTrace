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
                    text:"Verifier conformite et sauvegarder ce lot",
                    handler : function(){


                        var row = Ext.getCmp('gridarrivagecontroledetails').getSelectionModel().getSelection()[0];
                        var store = Ext.getCmp("gridarrivagecontrolemesures").getStore();
                        var details = new Array();
                        store.each(function(record,idx){

                            details.push({
                                "mes_id" : record.get("mes_id"),
                                "mes_longueur" : record.get("mes_longueur"),
                                "mes_diam" : record.get("mes_diam"),
                                "mes_diam2" : record.get("mes_diam2"),
                                "mes_humidite" : record.get("mes_humidite"),
                                "mes_compression" : record.get("mes_compression"),
                                "cfm_id" :  record.get("cfm_id")
                            });
                        });

                        var values = Ext.getCmp("form_controle_arrivage_details").getForm().getValues();
                        var cfm_id = Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_id").getValue();
                        var cfm_decision = Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_decision").getValue();

                        var data = new Object();
                        data.module = "arrivage";
                        data.cfm_id = cfm_id;
                        data.cfm_tca_fourni = values.cfm_tca_fourni;
                        data.cfm_tca_inter = values.cfm_tca_inter;
                        data.cfm_gout = values.cfm_gout;
                        data.cfm_capilarite = values.cfm_capilarite;
                        data.cfm_decision = cfm_decision;
                        data.hauteur = row.get("pro_taille");
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
                    text:"Generer automatiquement pour ce lot",
                    listeners : {
                        'click' : function(){

                            var row = Ext.getCmp('gridarrivagecontroledetails').getSelectionModel().getSelection()[0];
                            var data = {
                                "hauteur" : row.get("pro_taille")
                            };

                            Ext.Ajax.request({
                                url: 'data/generation_valeur/genere_arrivage.php',
                                method: 'POST',          
                                waitTitle: 'Connecting',
                                waitMsg: 'Sending data...',                                     
                                params: {
                                    "data" : JSON.stringify(data)
                                },
                                scope:this,
                                success: function(response, opts) {
                                  
                                    var responseParse = JSON.parse(response.responseText);
                                    Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_gout").setValue(responseParse.data.cfm_gout);
                                    Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_tca_fourni").setValue(responseParse.data.cfm_tca_fourni);
                                    Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_tca_inter").setValue(responseParse.data.cfm_tca_inter);
                                    //Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_diamcompr").setValue(responseParse.data.cfm_diamcompr);
                                    //Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_humidite").setValue(responseParse.data.cfm_humidite);
                                    Ext.getCmp("form_controle_arrivage_details").getForm().findField("cfm_capilarite").setValue(responseParse.data.cfm_capilarite);

                                    var store = Ext.getCmp("gridarrivagecontrolemesures").getStore();
                                    var i =0;
                                    for(i=0; i < responseParse.details.length;i++){
                                    
                                        var row = store.getAt(i);
                                        row.set("mes_longueur", responseParse.details[i]["mes_longueur"]);
                                        row.set("mes_diam", responseParse.details[i]["mes_diam"]);
                                        row.set("mes_diam2", responseParse.details[i]["mes_diam2"]);
                                        row.set("mes_humidite", responseParse.details[i]["mes_humidite"]);
                                        row.set("mes_compression", responseParse.details[i]["mes_compression"]);
                                    }

                                },                                    
                                failure: function(){
                                    alert("echec ajout");
                                }
                            });
                        }
                    }
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
                        {header: 'Diam1', dataIndex: 'mes_diam', flex: 1,
                        field: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 99999999
                        }},
                        {header: 'Diam2', dataIndex: 'mes_diam2', flex: 1,
                        field: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 99999999
                        }},
                        {header: 'Humidite', dataIndex: 'mes_humidite', flex: 1,
                        field: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 0,
                            maxValue: 99999999
                        }},
                        {header: 'Compr', dataIndex: 'mes_compression', flex: 1,
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