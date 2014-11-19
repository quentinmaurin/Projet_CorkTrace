Ext.define('CT.view.stock.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.stocklist',

    title: 'All Stock',
    id: 'stocklist',
    store: 'Stocks',

    initComponent: function() {

        this.columns = [
            {header: 'Stock Id',  dataIndex: 'stk_id',  flex: 1},
            {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
            {header: 'Pro Nom', dataIndex: 'pro_nom', flex: 1},
            {header: 'Pro Taille', dataIndex: 'pro_taille', flex: 1},
            {header: 'Pro qualite', dataIndex: 'pro_qualite', flex: 1},
            {header: 'Qte', dataIndex: 'stk_stock', flex: 1}
        ];

        this.callParent(arguments);
    }
});