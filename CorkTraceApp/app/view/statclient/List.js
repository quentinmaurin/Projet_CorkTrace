Ext.define('CT.view.statclient.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.statclientlist',

    title: 'Stat Client',
    layout: "border",

    items:[{

        xtype:"grid",
        region : "center",
        id: 'gridstatclientlist',
        title: "Liste des clients",
        store:'Clients',
        columns : [
            {header: 'Cli Id',  dataIndex: 'cli_id',  flex: 1},
            {header: 'Cli Nom', dataIndex: 'cli_nom', flex: 1}
        ],
        listeners : {
            'itemdblclick': function( grid, record, item, index, e, eOpts ){

                console.log("dbl click");
                var view = Ext.widget('statclientlistlot');
            },
            'itemclick': function( grid, record, item, index, e, eOpts ){
                
                console.log("click");

            }
        }

    },{
        xtype: "panel",
        region: "east",
        width: "60%",
        title: "stat"
    }],

    initComponent: function() {

        this.callParent(arguments);
    }
});