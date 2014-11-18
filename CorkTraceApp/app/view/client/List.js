Ext.define('CT.view.client.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.clientlist',

    title: 'All Client',

    store: 'Clients',
	
    bbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){
                   var view = Ext.widget('clientadd');
        } },   
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Id',  dataIndex: 'cli_id',  flex: 1},
            {header: 'Nom', dataIndex: 'cli_nom', flex: 1},
            {header: 'Mail', dataIndex: 'cli_mail', flex: 1},
            {header: 'Nom', dataIndex: 'cli_tel', flex: 1}
        ];

        this.callParent(arguments);
    }
});