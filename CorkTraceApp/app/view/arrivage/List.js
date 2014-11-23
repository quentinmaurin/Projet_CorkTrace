Ext.define('CT.view.arrivage.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.arrivagelist',

    title: 'Tous les arrivages',
    id: 'arrivagelist',
    store: 'Arrivages',
	
    tbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){

            Ext.create('Ext.window.Window', {
                title: 'Saisir cfo_id',
                layout: 'fit',
                id : "window_cfo_id",
                items: {
                    xtype: 'form',
                    id : "form_cfo_id",
                    defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 150
                    },
                    items:[{
                        xtype:"textfield",
                        name: "cfo_id",
                        fieldLabel : "cfo_id"
                    }],
                    buttons: [{
                        text: 'Annuler',
                        handler: function() {
                            Ext.getCmp("window_cfo_id").close();
                        }
                    }, {
                        text: 'Receptionner',
                        scope: this,
                        handler: function() {
           
                            var values = Ext.getCmp("form_cfo_id").getForm().getValues();
                            Ext.getCmp("window_cfo_id").close();
                            var view = Ext.widget('arrivageadd');
                            Ext.getCmp("form_add_arrivage").getForm().findField("cfo_id").setValue(values.cfo_id);

                            Ext.getCmp('gridarrivagedetails').getStore().getProxy().extraParams = {
                                cfo_id: values.cfo_id
                            };

                            Ext.getCmp('gridarrivagedetails').getStore().load();
                        }
                    }]
                }
            }).show();

       
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete',
            listeners : {
                'click' : function(){
                    
                    var row = Ext.getCmp('arrivagelist').getSelectionModel().getSelection()[0];
                    Ext.getCmp('arrivagelist').getStore().remove(row);
                    Ext.getCmp('arrivagelist').getStore().sync();
                }
            }
        },
        {
            xtype: 'button', text: 'Bon de réception PDF', action: 'visualiserPDF', href:"services/ficheArrivage.php",
            listeners : {
                'click' : function(){
                    console.log("test");
                    var row = Ext.getCmp('arrivagelist').getSelectionModel().getSelection()[0];
                    var ari_id = row.get("ari_id");
                    console.log(ari_id);
                    this.href = "services/ficheArrivage.php?id="+ari_id;
                    this.el.dom.href = this.getHref();
                    console.log(this.href);
                }
            }
        },{
            xtype: 'button', text: 'Controler arrivage', action: 'controleArrivage',
            listeners : {
            'click' : function(){
                    
                    var view = Ext.widget('arrivagecontrole');

                    var row = Ext.getCmp('arrivagelist').getSelectionModel().getSelection()[0];
                    var ari_id = row.get("ari_id");
                    Ext.getCmp('gridarrivagecontroledetails').getStore().getProxy().extraParams = {
                        ari_id: ari_id
                    };
                    Ext.getCmp('gridarrivagecontroledetails').getStore().load();
                }
            }
        },
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Ari Id',  dataIndex: 'ari_id',  flex: 1},
            {header: 'Num Ari', dataIndex: 'ari_num_arrivage', flex: 1},
            {header: 'Date recept', dataIndex: 'ari_date_recept', flex: 1},
            {header: 'Responsable', dataIndex: 'ari_responsable', flex: 1}
        ];

        this.callParent(arguments);
    }
});