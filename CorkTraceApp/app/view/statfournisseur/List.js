Ext.define('CT.view.statfournisseur.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.statfournisseurlist',

    title: 'Stat fournisseur',
    layout: "border",

    items:[{

        xtype:"grid",
        region : "center",
        id: 'gridstatfournisseurlist',
        title: "Liste des fournisseurs",
        store:'Fournisseurs',
        columns : [
            {header: 'Fou Id',  dataIndex: 'fou_id',  flex: 1},
            {header: 'Fou Nom', dataIndex: 'fou_nom', flex: 1}
        ],
        listeners : {
            'itemdblclick': function( grid, record, item, index, e, eOpts ){

                console.log("dbl click");
                var view = Ext.widget('statfournisseurlistlot');
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