Ext.define('CT.view.tracabiliteascendante.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.tracabiliteascendantelist',

    title: 'Tracabilite ascendante',
    layout: "border",

    items: [{
        title : "Liste des lots",
        xtype : "grid",
        region : "center",
        id: 'gridtracabiliteascendantelot',
        store: 'ArrivageDetails',
        columns : [
            {header: 'Ard Id',  dataIndex: 'ard_id',  flex: 1},
            {header: 'Ari Id', dataIndex: 'ari_id', flex: 1},
            {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
            {header: 'Cfm Id', dataIndex: 'cfm_id', flex: 1},
            {header: 'Ard qte', dataIndex: 'ard_quantite', flex: 1}
        ]
    },{
        title : "Liste des  clients ayant ce lot",
        xtype : "grid",
        region : "east",
        width: "50%",
        id: 'gridtracabiliteascendanteclient',
        store: 'TracabiliteAscendantes',
        columns : [
            {header: 'Cli Id',  dataIndex: 'cli_id',  flex: 1},
            {header: 'Cli Nom', dataIndex: 'cli_nom', flex: 1}
        ]
    }],


    initComponent: function() {

        this.callParent(arguments);
    }
});