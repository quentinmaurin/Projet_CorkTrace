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
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },
        {
            xtype: 'button', text: 'Visualiser PDF', action: 'visualiserPDF', href:"services/facturation.php",
            listeners : {
                'click' : function(){
                    console.log("test");
                    var row = Ext.getCmp('commandeclientlist').getSelectionModel().getSelection()[0];
                    var ccl_id = row.get("ccl_id");
                    console.log(ccl_id);
                    this.href = "services/facturation.php?id="+ccl_id;
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