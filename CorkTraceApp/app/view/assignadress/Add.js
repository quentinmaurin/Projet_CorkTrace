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
                        xtype: "textfield",
                        name : 'adr_adresse',
                        fieldLabel: 'Choisir adresse',
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