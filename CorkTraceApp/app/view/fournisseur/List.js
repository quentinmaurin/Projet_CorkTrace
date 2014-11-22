Ext.define('CT.view.fournisseur.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.fournisseurlist',

    title: 'Tous les fournisseurs',
    id: 'fournisseurlist',
    store: 'Fournisseurs',
	
    tbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){
                   var view = Ext.widget('fournisseuradd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete',
            listeners : {
                'click' : function(){

                    var row = Ext.getCmp('fournisseurlist').getSelectionModel().getSelection()[0];
                    Ext.getCmp('fournisseurlist').getStore().remove(row);
                    Ext.getCmp('fournisseurlist').getStore().sync();
                }
            }
        },
        {
            xtype: 'button', text: 'Modifier',
            listeners : {
                'click' : function(){

                        var row = Ext.getCmp('fournisseurlist').getSelectionModel().getSelection()[0];
                        var view = Ext.widget('fournisseuredit');
                        view.down('form').loadRecord(row);
                }
            }
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