Ext.define('CT.view.client.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.clientlist',

    title: 'All Client',

    store: 'Clients',
	
    initComponent: function() {

        this.columns = [
            {header: 'Name',  dataIndex: 'name',  flex: 1},
            {header: 'Email', dataIndex: 'email', flex: 1}
        ];

        this.callParent(arguments);
    }
});