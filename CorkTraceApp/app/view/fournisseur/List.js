Ext.define('CT.view.fournisseur.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.fournisseurlist',

    title: 'Tous les fournisseurs',

    store: 'Fournisseurs',
	
    initComponent: function() {

        this.columns = [
            {header: 'Id',  dataIndex: 'fou_id',  flex: 1},
            {header: 'Nom', dataIndex: 'fou_nom', flex: 1},
            {header: 'Adresse', dataIndex: 'fou_adresse', flex: 1},
            {header: 'Mail', dataIndex: 'fou_mail', flex: 1}
        ];

        this.callParent(arguments);
    }
});