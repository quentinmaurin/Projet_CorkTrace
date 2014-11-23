Ext.define('CT.view.commandeclient.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.commandeclientlist',

    title: 'Toutes les commandes clients',
    id: 'commandeclientlist',
    store: 'CommandeClients',
	
    tbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){

            var view = Ext.widget('commandeclientadd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete',
            listeners : {
                'click' : function(){
                
                    var row = Ext.getCmp('commandeclientlist').getSelectionModel().getSelection()[0];
                    Ext.getCmp('commandeclientlist').getStore().remove(row);
                    Ext.getCmp('commandeclientlist').getStore().sync();
                }
            }
        },
        {
            xtype: 'button', text: 'Commande client PDF', action: 'visualiserPDF', href:"services/ficheCmdClient.php",
            listeners : {
                'click' : function(){
                    console.log("test");
                    var row = Ext.getCmp('commandeclientlist').getSelectionModel().getSelection()[0];
                    var ccl_id = row.get("ccl_id");
                    console.log(ccl_id);
                    this.href = "services/ficheCmdClient.php?id="+ccl_id;
                    this.el.dom.href = this.getHref();
                    console.log(this.href);
                }
            }
        },
        {
            xtype: 'button', text: 'Envoi confirmation par mail', action: 'envoieMail', href:"services/confirmCmdClient.php",
            listeners : {
                'click' : function(){
                    console.log("test");
                    var row = Ext.getCmp('commandeclientlist').getSelectionModel().getSelection()[0];
                    var ccl_id = row.get("ccl_id");
                    console.log(ccl_id);
                    this.href = "services/confirmCmdClient.php?id="+ccl_id;
                    this.el.dom.href = this.getHref();
                    console.log(this.href);
                }
            }
        },
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Ccl Id',  dataIndex: 'ccl_id',  flex: 1},
            {header: 'Ccl date cmd', dataIndex: 'ccl_dateCmd', flex: 1},
            {header: 'Ccl date liv', dataIndex: 'ccl_dateLiv', flex: 1},
            {header: 'Clc id', dataIndex: 'clc_id', flex: 1},
            {header: 'Dpy id', dataIndex: 'dpy_id', flex: 1},
            {header: 'Ccl date confirm', dataIndex: 'ccl_dateConfirm', flex: 1},
            {header: 'Ccl confirm', dataIndex: 'ccl_confirm', flex: 1},
            {header: 'Cla id', dataIndex: 'cla_id', flex: 1}
        ];

        this.callParent(arguments);
    }
});