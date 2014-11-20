Ext.define('CT.view.arrivage.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.arrivageadd',

    title: 'Add Arrivage',
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
                        maxValue: 100000
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
                    name: "cmd_id",
                    fieldLabel: "Commande id"
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

                    /*console.log("debut loop");
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

                    console.log(data);
                    console.log("End loop");

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