Ext.define('CT.view.client.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.clientlist',

    title: 'All Client',

    layout : 'border',

    items:[{

        title : "Les clients",
        xtype : "grid",
        region : "center",
        id: 'gridclientlist',
        store: 'Clients',
        tbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){
                   var view = Ext.widget('clientadd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },{
            xtype: 'button', text: 'Modifier', action: 'edit' 
        }, 
        '->'
        ],
        columns : [
            {header: 'Id',  dataIndex: 'cli_id',  flex: 1},
            {header: 'Nom', dataIndex: 'cli_nom', flex: 1},
            {header: 'Mail', dataIndex: 'cli_mail', flex: 1},
            {header: 'Nom', dataIndex: 'cli_tel', flex: 1},
            {header: 'Fax', dataIndex: 'cli_fax', flex: 1},
            {header: 'Adr Fact.', dataIndex: 'cli_adr_fact', flex: 1},
            {header: 'Type Id', dataIndex: 'tyc_id', flex: 1},
            {header: 'Type', dataIndex: 'tyc_nom', flex: 1}
        ]
    },{
        title : "Adresses de livraisons",
        xtype : "grid",
        region : "center",
        id: 'gridadresseslivraisonslist',
        store: 'AssigneAdresses',
        columns : [
            {header: 'Cla Id',  dataIndex: 'cla_id',  flex: 1},
            {header: 'Cli Id', dataIndex: 'cli_id', flex: 1},
            {header: 'Adr Id', dataIndex: 'adr_id', flex: 1},
            {header: 'Adresse', dataIndex: 'adr_adresse', flex: 1}
        ],
        region : "east",
        width : "30%",
        tbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){

                var view = Ext.widget('assignadressadd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },
        '->'
        ],
    }],
 

    initComponent: function() {

        this.callParent(arguments);
    }
});