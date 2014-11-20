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

            Ext.create('Ext.window.Window', {
                title: 'Saisir cmd id',
                layout: 'fit',
                id : "window_cmd_id",
                items: {
                    xtype: 'form',
                    id : "form_cmd_id",
                    defaults : {
                        margins : "10 10 10 10",
                        labelWidth : 150
                    },
                    items:[{
                        xtype:"textfield",
                        name: "cmd_id",
                        fieldLabel : "Cmd id"
                    }],
                    buttons: [{
                        text: 'Annuler',
                        handler: function() {
                            Ext.getCmp("window_cmd_id").close();
                        }
                    }, {
                        text: 'Receptionner',
                        scope: this,
                        handler: function() {
           
                            var values = Ext.getCmp("form_cmd_id").getForm().getValues();
                            Ext.getCmp("window_cmd_id").close();
                            var view = Ext.widget('arrivageadd');
                            Ext.getCmp("form_add_arrivage").getForm().findField("cmd_id").setValue(values.cmd_id);
                        }
                    }]
                }
            }).show();

       
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