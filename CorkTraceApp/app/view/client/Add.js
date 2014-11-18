Ext.define('CT.view.client.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.clientadd',

    title: 'Add Client',
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
                        xtype: 'textfield',
                        name : 'tyc_id',
                        fieldLabel: 'Type' 
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