Ext.define('CT.view.commandefournisseur.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.commandefournisseurlist',

    title: 'Toutes les commandes fournisseur',
    id: 'commandefournisseurlist',
    store: 'CommandeFournisseurs',
	
    bbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){

            var view = Ext.widget('commandefournisseuradd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },   
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Cfo Id',  dataIndex: 'cfo_id',  flex: 1},
            {header: 'Date Cmd', dataIndex: 'cfo_dateCmd', flex: 1},
            {header: 'Date recept', dataIndex: 'cfo_dateRecept', flex: 1},
            {header: 'Fou Id', dataIndex: 'fou_id', flex: 1},
            {header: 'Ari Id', dataIndex: 'ari', flex: 1}
        ];

        this.callParent(arguments);
    }
});