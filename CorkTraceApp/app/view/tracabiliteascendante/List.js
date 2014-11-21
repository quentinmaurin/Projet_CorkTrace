Ext.define('CT.view.tracabiliteascendante.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.tracabiliteascendantelist',

    title: 'Tracabilite ascendante',
    id: 'tracabiliteascendantelist',
	
    layout: "border",

    items: [{
        title : "Liste des lots",
        xtype : "grid",
        region : "center",
        id: 'gridtracabiliteascendantelist',
        store: 'ArrivageDetails',
        columns : [
            {header: 'Ard Id',  dataIndex: 'ard_id',  flex: 1},
            {header: 'Ari Id', dataIndex: 'ari_id', flex: 1},
            {header: 'Pro Id', dataIndex: 'pro_id', flex: 1},
            {header: 'Cfm Id', dataIndex: 'cfm_id', flex: 1},
            {header: 'Ard qte', dataIndex: 'ard_quantite', flex: 1}
        ]
    },{
        xtype :"panel",
        title: "Liste des clients ayant recus le lot",
        region : "east",
        width : "50%"
    }],


    initComponent: function() {

        this.callParent(arguments);
    }
});