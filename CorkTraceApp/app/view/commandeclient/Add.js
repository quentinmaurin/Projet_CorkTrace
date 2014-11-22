Ext.define('CT.view.commandeclient.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.commandeclientadd',

    title: 'Add Cmd',
    layout: 'border',
    autoShow: true,
    width:"100%",
    height:"100%",
    id: "window_commandecli_add",

    initComponent: function() {
        
        this.items = [
            {
                xtype:"grid",
                region:"center",
                title:"Details",
                store:"CommandeClientDetails",
                id : "gridcommandeclientdetails",
                plugins: [ Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 1
                })],
                columns : [
                    {header: 'Ccd Id',  dataIndex: 'ccd_id',  flex: 1},
                    {header: 'Ccl Id', dataIndex: 'ccl_id', flex: 1},
                    {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
                    {header: 'Nom', dataIndex: 'pro_nom', flex: 1},
                    {header: 'Taille', dataIndex: 'pro_taille', flex: 1},
                    {header: 'Qualite', dataIndex: 'pro_qualite', flex: 1},
                    {header: 'Prix', dataIndex: 'ccd_prix', flex: 1,
                    field: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 99999999
                    }},
                    {header: 'Qte', dataIndex: 'ccd_quantite', flex: 1,
                    field: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 99999999
                    }},
                    {header: 'Marquage', dataIndex: 'ccd_marquage', flex: 1,
                    field: {xtype: 'textfield'}}
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
                id : "form_add_cmd_cli",
                region:"north",
                height:"20%",
                title:"Commande Client",
                layout : "vbox",
                items: [{
                    xtype:"panel",
                    layout: "hbox",
                    border:false,
                    defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 150
                    },
                    items : [{
                        xtype:"datefield",
                        name: "ccl_dateLiv",
                        fieldLabel: "Date de livraison",
                        editable:false,
                        format : "d/m/Y"
                    }]
                },{
                    xtype:"panel",
                    layout: "hbox",
                    border:false,
                    defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 150
                    },
                    items:[{
                        xtype: "combobox",
                        name : 'cli_id',
                        fieldLabel: 'Choisir client',
                        displayField: 'cli_nom',
                        valueField: 'cli_id',
                        store: 'Clients',
                        queryMode: 'local',
                        editable:false,
                        listeners: {
                            'afterrender': function(cb, eOpts){
                                cb.getStore().load();
                            },
                            'change': function(cb, newValue, oldValue, eOpts){
                            
                                Ext.getCmp("form_add_cmd_cli").getForm().findField('clc_id').getStore().getProxy().extraParams={
                                    cli_id: newValue
                                };
                                Ext.getCmp("form_add_cmd_cli").getForm().findField('clc_id').getStore().load();
                                Ext.getCmp("form_add_cmd_cli").getForm().findField('cla_id').getStore().getProxy().extraParams={
                                    cli_id: newValue
                                };
                                Ext.getCmp("form_add_cmd_cli").getForm().findField('cla_id').getStore().load();
                            }
                        }
                    },{
                        xtype: "combobox",
                        name : 'clc_id',
                        fieldLabel: 'Choisir Commercial',
                        displayField: 'com_nom',
                        valueField: 'clc_id',
                        store: 'AssigneCommercials',
                        queryMode: 'local',
                        editable:false
                    },{
                        xtype: "combobox",
                        name : 'dpy_id',
                        fieldLabel: 'Choisir delai',
                        displayField: 'dpy_jour',
                        valueField: 'dpy_id',
                        store: 'DelaiPaiements',
                        queryMode: 'local',
                        editable:false
                    },{
                        xtype: "combobox",
                        name : 'cla_id',
                        fieldLabel: 'Choisir Adresse livraison',
                        displayField: 'adr_adresse',
                        valueField: 'cla_id',
                        store: 'AssigneAdresses',
                        queryMode: 'local',
                        editable:false
                    }]
                }]
            }
        ];

        this.buttons = [
            {
                text: 'Ajouter cette commande client',
                action: 'save',
                handler : function(){

           
                    var store = Ext.getCmp("gridcommandeclientdetails").getStore();

                    var details = new Array();
                    store.each(function(record,idx){

                        details.push({
                            "pro_id" : record.get("pro_id"),
                            "ccd_quantite" : record.get("ccd_quantite"),
                            "ccd_prix" : record.get("ccd_prix"),
                            "ccd_marquage" :  record.get("ccd_marquage")
                        });
                    });

                    var values = Ext.getCmp("form_add_cmd_cli").getForm().getValues();

                    var data = new Object();
                    data.ccl_dateLiv = values.ccl_dateLiv;
                    data.clc_id = values.clc_id;
                    data.dpy_id = values.dpy_id;
                    data.cla_id = values.cla_id;
                    data.details = details;

                    Ext.Ajax.request({
                        url: 'data/commande_client/create.php',
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

                    Ext.getCmp("commandeclientlist").getStore().reload();
                    Ext.getCmp("commandeclientlist").getView().refresh();
                    Ext.getCmp("window_commandecli_add").close();

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