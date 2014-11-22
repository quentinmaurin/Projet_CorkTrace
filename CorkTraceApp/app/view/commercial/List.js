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
            xtype: 'button', text: 'Supprimer', action: 'delete',
            listeners : {
                'click' : function(){
  
                    var row = Ext.getCmp('commerciallist').getSelectionModel().getSelection()[0];
                    Ext.getCmp('commerciallist').getStore().remove(row);
                    Ext.getCmp('commerciallist').getStore().sync();
                }
            }
        },
        {
            xtype: 'button', text: 'Modifier',
            listeners : {
                'click' : function(){

                        var row = Ext.getCmp('commerciallist').getSelectionModel().getSelection()[0];
                        var view = Ext.widget('commercialedit');
                        view.down('form').loadRecord(row);
                }
            }
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