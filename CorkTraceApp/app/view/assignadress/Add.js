Ext.define('CT.view.assignadress.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.assignadressadd',

    title: 'Add Adress',
    layout: 'fit',
    autoShow: true,

    initComponent: function() {
        
        this.items = [
            {
                xtype: 'form',
                items: [
                    {
                        xtype: 'textfield',
                        name : 'cli_id',
                        fieldLabel: 'Client'
                    },{
                        xtype: "combobox",
                        name : 'adr_id',
                        fieldLabel: 'Choisir adresse',
                        displayField: 'adr_adresse',
                        valueField: 'adr_id',
                        store: 'Adresses',
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