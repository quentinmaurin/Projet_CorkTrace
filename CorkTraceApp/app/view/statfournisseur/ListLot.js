Ext.define('CT.view.statfournisseur.ListLot', {
    extend: 'Ext.window.Window',
    alias: 'widget.statfournisseurlistlot',

    title: 'Stat par lot',
    layout: 'border',
    autoShow: true,
    width:"100%",
    height:"100%",
    id:"window_statfournisseur_lot",
    layout: {
        type: 'hbox',
        align: 'stretch'
    },

    initComponent: function() {
        
        this.items = [{
            xtype: 'panel',
            title: 'Lot du fournisseur',
            flex: 1
        },{
            xtype: 'panel',
            title: 'Caractéristique du lot',
            flex: 1
        },{
            xtype: 'panel',
            title: 'Stat par lot',
            flex: 2
        }];

        this.callParent(arguments);
    }
});