Ext.define('CT.view.livraison.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.livraisonlist',

    title: 'Toutes les livraisons',
    id: 'livraisonlist',
    store: 'Livraisons',
	
    tbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){

             Ext.create('Ext.window.Window', {
                title: 'Saisir id commande client',
                layout: 'fit',
                id : "window_ccl_id",
                items: {
                    xtype: 'form',
                    id : "form_ccl_id",
                    defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 150
                    },
                    items:[{
                        xtype:"textfield",
                        name: "ccl_id",
                        fieldLabel : "ccl_id"
                    }],
                    buttons: [{
                        text: 'Annuler',
                        handler: function() {
                            Ext.getCmp("window_ccl_id").close();
                        }
                    }, {
                        text: 'Livrer',
                        scope: this,
                        handler: function() {
           
                            var values = Ext.getCmp("form_ccl_id").getForm().getValues();
                            Ext.getCmp("window_ccl_id").close();
                            var view = Ext.widget('livraisonadd');
                            Ext.getCmp("form_add_livraison").getForm().findField("ccl_id").setValue(values.ccl_id);

                            Ext.getCmp('gridlivraisondetails').getStore().getProxy().extraParams = {
                                ccl_id: values.ccl_id
                            };

                            Ext.getCmp('gridlivraisondetails').getStore().load();
                        }
                    }]
                }
            }).show();

        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete',
            listeners : {
                'click' : function(){

                    var row = Ext.getCmp('livraisonlist').getSelectionModel().getSelection()[0];
                    Ext.getCmp('livraisonlist').getStore().remove(row);
                    Ext.getCmp('livraisonlist').getStore().sync();
                }
            }
        },
        {
            xtype: 'button', text: 'Bon de livraison PDF', action: 'visualiserPDF', href:"services/ficheLivraison.php",
            listeners : {
                'click' : function(){

                    var row = Ext.getCmp('livraisonlist').getSelectionModel().getSelection()[0];
                    var liv_id = row.get("liv_id");
                    this.href = "services/ficheLivraison.php?id="+liv_id;
                    this.el.dom.href = this.getHref();
                    console.log(this.href);
                }
            }
        },
        {
            xtype: 'button', text: 'Facture PDF', action: 'visualiserPDF', href:"services/factureCmdClient.php",
            listeners : {
                'click' : function(){

                    var row = Ext.getCmp('livraisonlist').getSelectionModel().getSelection()[0];
                    var ccl_id = row.get("ccl_id");
                    this.href = "services/factureCmdClient.php?id="+ccl_id;
                    this.el.dom.href = this.getHref();
                    console.log(this.href);
                }
            }
        },{
            xtype: 'button', text: 'Controler livraison', action: 'controleLivraison',
            listeners : {
            'click' : function(){
                    
                    var view = Ext.widget('livraisoncontrole');

                    var row = Ext.getCmp('livraisonlist').getSelectionModel().getSelection()[0];
                    var liv_id = row.get("liv_id");
                    Ext.getCmp('gridlivraisoncontroledetails').getStore().getProxy().extraParams = {
                        liv_id: liv_id
                    };
                    Ext.getCmp('gridlivraisoncontroledetails').getStore().load();
                }
            }
        },
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Liv Id',  dataIndex: 'liv_id',  flex: 1},
            {header: 'Ccl Id', dataIndex: 'ccl_id', flex: 1},
            {header: 'Date liv.', dataIndex: 'liv_dateLiv', flex: 1},
            {header: 'Responsable', dataIndex: 'liv_responsable', flex: 1}
        ];

        this.callParent(arguments);
    }
});