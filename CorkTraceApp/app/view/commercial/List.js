Ext.define('CT.view.commercial.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.commerciallist',

    title: 'All Commercial',
    id: 'commerciallist',
    store: 'Commercials',
	
    tbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){
                   var view = Ext.widget('commercialadd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },   
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Id',  dataIndex: 'com_id',  flex: 1},
            {header: 'Nom', dataIndex: 'com_nom', flex: 1},
            {header: 'Prenom', dataIndex: 'com_prenom', flex: 1},
            {header: 'Adresse', dataIndex: 'com_adresse', flex: 1},
            {header: 'Mail', dataIndex: 'com_mail', flex: 1},
            {header: 'Tel', dataIndex: 'com_tel', flex: 1},
            {header: 'Fax', dataIndex: 'com_fax', flex: 1}
        ];

        this.callParent(arguments);
    }
});