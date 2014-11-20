Ext.define('CT.view.arrivage.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.arrivagelist',

    title: 'Tous les arrivages',
    id: 'arrivagelist',
    store: 'Arrivages',
	
    bbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){
            console.log("test");
            //var view = Ext.widget('arrivageadd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },   
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Ari Id',  dataIndex: 'ari_id',  flex: 1},
            {header: 'Num Ari', dataIndex: 'ari_num_arrivage', flex: 1},
            {header: 'Date recept', dataIndex: 'ari_date_recept', flex: 1},
            {header: 'Responsable', dataIndex: 'ari_responsable', flex: 1}
        ];

        this.callParent(arguments);
    }
});