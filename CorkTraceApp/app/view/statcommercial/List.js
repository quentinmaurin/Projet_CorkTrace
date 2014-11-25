Ext.define('CT.view.statcommercial.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.statcommerciallist',

    title: 'Statistique commercial',
    layout: "border",

    items: [{
        title : "Commerciaux",
        xtype : "grid",
        region : "center",
        id: 'gridCommList',
        store: 'Commercials',
        columns : [
            {header: 'Nom', dataIndex: 'com_nom', flex: 1},
            {header: 'Prenom', dataIndex: 'com_prenom', flex: 1}
        ]
    },{
        title : "Contrat",
        xtype : "grid",
        region : "east",
        width: "40%",
        id: 'griddetailcommande',
        store: 'StatCommercials',
        columns : [
            {header: 'Date de commande', dataIndex: 'ccl_dateCmd', flex: 1},
            {header: 'Prix négocié', dataIndex: 'ccd_prix', flex: 1},
            {header: 'Quantité négociée', dataIndex: 'ccd_quantite', flex: 1}
        ]
    }],

    initComponent: function() {

        this.callParent(arguments);
    }
});