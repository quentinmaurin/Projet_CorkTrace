Ext.define('CT.view.livraison.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.livraisonadd',

    title: 'Add Livraison',
    layout: 'border',
    autoShow: true,
    width:"100%",
    height:"100%",
    id:"window_livraison_add",
    closable:false,

    initComponent: function() {
        
        this.items = [
            {
                xtype:"grid",
                region:"center",
                title:"Details",
                store:"CommandeClientDetails",
                id : "gridlivraisondetails",
                plugins: [ Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 1
                })],
                columns : [
                    {header: 'Cdd Id',  dataIndex: 'ccd_id',  flex: 1},
                    {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
                    {header: 'Nom', dataIndex: 'pro_nom', flex: 1},
                    {header: 'Taille', dataIndex: 'pro_taille', flex: 1},
                    {header: 'Qualite', dataIndex: 'pro_qualite', flex: 1},
                    {header: 'Marquage', dataIndex: 'ccd_marquage', flex: 1},
                    {header: 'Prix',  dataIndex: 'ccd_prix',  flex: 1},
                    {header: 'Cdd Qte',  dataIndex: 'ccd_quantite',  flex: 1},
                    {header: 'Ard Id', dataIndex: 'ard_id', flex: 1,
                    field: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 99999999
                    }},
                    {header: 'Lid Qte', dataIndex: 'lid_quantite', flex: 1,
                    field: {
                        xtype: 'numberfield',
                        allowBlank: false,
                        minValue: 0,
                        maxValue: 99999999
                    }}
                ]
            },{
                xtype:"form",
                id : "form_add_livraison",
                region:"north",
                height:"15%",
                title:"Livraison",
                layout : "hbox",
                defaults : {
                    margins : "10 10 10 10",
                    labelWidth : 150
                },
                items: [{
                    xtype:"displayfield",
                    name: "ccl_id",
                    fieldLabel: "Commmande cli Id"
                },{
                    xtype:"displayfield",
                    name: "cli_nom",
                    fieldLabel: "Client"
                },{
                    xtype:"textfield",
                    name: "liv_responsable",
                    fieldLabel: "Responsable"
                }]
            }
        ];

        this.buttons = [
            {
                text: 'Ajouter une livraison',
                action: 'save',
                handler : function(){

                    var store = Ext.getCmp("gridlivraisondetails").getStore();

                    var details = new Array();
                    store.each(function(record,idx){

                        details.push({
                            "pro_id" : record.get("pro_id"),
                            "ard_id" : record.get("ard_id"),
                            "lid_quantite" : record.get("lid_quantite"),
                            "ccd_marquage" : record.get("ccd_marquage"),
                            "ccd_prix" : record.get("ccd_prix")
                        });
                    });

                    var values = Ext.getCmp("form_add_livraison").getForm().getValues();
                    var ccl_id = Ext.getCmp("form_add_livraison").getForm().findField("ccl_id").getValue();

                    var data = new Object();
                    data.ccl_id = ccl_id;
                    data.liv_responsable = values.liv_responsable;
                    data.details = details;

                    Ext.Ajax.request({
                        url: 'data/livraison/create.php',
                        method: 'POST',          
                        waitTitle: 'Connecting',
                        waitMsg: 'Sending data...',                                     
                        params: {
                        "data" : JSON.stringify(data)
                        },
                        scope:this,
                        success: function(response, opts) {

                            Ext.getCmp("livraisonlist").getStore().reload();
                            Ext.getCmp("livraisonlist").getView().refresh();
                            Ext.getCmp("window_livraison_add").close();
                        },                                   
                        failure: function(){

                            alert("echec ajout");
                            Ext.getCmp("window_livraison_add").close();
                        }
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