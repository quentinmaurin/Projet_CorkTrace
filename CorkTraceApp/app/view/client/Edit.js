Ext.define('CT.view.client.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.clientedit',

    title: 'Edit Client',
    layout: 'fit',
    autoShow: true,

    initComponent: function() {
        
        this.items = [
            {
                xtype: 'form',
                items: [
                    {
                        xtype: 'textfield',
                        name : 'cli_nom',
                        fieldLabel: 'Nom'
                    },{
                        xtype: 'textfield',
                        name : 'cli_mail',
                        fieldLabel: 'Mail'
                    },{
                        xtype: 'textfield',
                        name : 'cli_tel',
                        fieldLabel: 'Tel'
                    },{
                        xtype: 'textfield',
                        name : 'cli_fax',
                        fieldLabel: 'Fax'
                    },{
                        xtype: 'textfield',
                        name : 'cli_adr_fact',
                        fieldLabel: 'Adr fact' 
                    },{
                        xtype: "combobox",
                        name : 'tyc_id',
                        fieldLabel: 'Choisir type',
                        displayField: 'tyc_nom',
                        valueField: 'tyc_id',
                        store: 'TypeClients',
                        queryMode: 'local'
                    }
                ]
            }
        ];

        this.buttons = [
            {
                text: 'Save',
                action: 'save'
            },
            {
                text: 'Cancel',
                scope: this,
                handler: this.close
            }
        ];

        this.callParent(arguments);
    }
});