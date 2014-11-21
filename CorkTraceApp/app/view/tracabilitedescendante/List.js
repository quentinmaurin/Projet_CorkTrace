Ext.define('CT.view.tracabilitedescendante.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.tracabilitedescendantelist',

    title: 'Tracabilite descendante',
    layout: "border",

    items: [{
        title : "Liste des lots",
        xtype : "grid",
        region : "center",
        id: 'gridtracabilitedescendantelot',
        store: 'LivraisonDetails',
        columns : [
            {header: 'Lid Id',  dataIndex: 'lid_id',  flex: 1},
            {header: 'Ard Id', dataIndex: 'ard_id', flex: 1},
            {header: 'Lid Qte', dataIndex: 'lid_quantite', flex: 1}
        ]
    },{
        title : "Liste des fournisseurs",
        xtype : "grid",
        region : "east",
        width: "50%",
        id: 'gridtracabilitedescendanteclient',
        store: 'TracabiliteDescendantes',
        columns : [
            {header: 'Fou Id', dataIndex: 'fou_id', flex: 1},
            {header: 'Fou Nom', dataIndex: 'fou_nom', flex: 1},
            {header: 'Tel', dataIndex: 'fou_tel', flex: 1},
            {header: 'Fou mail', dataIndex: 'fou_mail', flex: 1},
            {header: 'Ard id', dataIndex: 'ard_id', flex: 1}
        ]
    }],


    initComponent: function() {

        this.callParent(arguments);
    }
});