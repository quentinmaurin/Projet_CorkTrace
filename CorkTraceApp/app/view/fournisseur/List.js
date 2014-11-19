Ext.define('CT.view.fournisseur.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.fournisseurlist',

    title: 'Tous les fournisseurs',
    id: 'fournisseurlist',
    store: 'Fournisseurs',
	
    bbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){
                   var view = Ext.widget('fournisseuradd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },   
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Id',  dataIndex: 'fou_id',  flex: 1},
            {header: 'Nom', dataIndex: 'fou_nom', flex: 1},
            {header: 'Adresse', dataIndex: 'fou_adresse', flex: 1},
            {header: 'Mail', dataIndex: 'fou_mail', flex: 1},
            {header: 'Tel', dataIndex: 'fou_tel', flex: 1},
            {header: 'Fax', dataIndex: 'fou_fax', flex: 1},
            {header: 'Type Id', dataIndex: 'tyf_id', flex: 1},
            {header: 'Type', dataIndex: 'tyf_nom', flex: 1}
        ];

        this.callParent(arguments);
    }
});