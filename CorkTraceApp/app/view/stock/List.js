Ext.define('CT.view.stock.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.stocklist',

    title: 'All Stock',
    id: 'stocklist',
    store: 'Stocks',

    initComponent: function() {

        this.columns = [
            {header: 'Id',  dataIndex: 'stk_id',  flex: 1},
            {header: 'Qte', dataIndex: 'stk_stock', flex: 1},
            {header: 'Pro Id', dataIndex: 'pro_id', flex: 1}
        ];

        this.callParent(arguments);
    }
});