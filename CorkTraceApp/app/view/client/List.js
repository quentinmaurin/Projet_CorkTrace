Ext.define('CT.view.client.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.clientlist',

    title: 'All Client',
    id: 'clientlist',
    store: 'Clients',
	
    bbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){
                   var view = Ext.widget('clientadd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },   
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Id',  dataIndex: 'cli_id',  flex: 1},
            {header: 'Nom', dataIndex: 'cli_nom', flex: 1},
            {header: 'Mail', dataIndex: 'cli_mail', flex: 1},
            {header: 'Nom', dataIndex: 'cli_tel', flex: 1},
            {header: 'Fax', dataIndex: 'cli_fax', flex: 1},
            {header: 'Adr Fact.', dataIndex: 'cli_adr_fact', flex: 1},
            {header: 'Type Id', dataIndex: 'tyc_id', flex: 1},
            {header: 'Type', dataIndex: 'tyc_nom', flex: 1}
        ];

        this.callParent(arguments);
    }
});