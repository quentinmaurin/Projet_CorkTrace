Ext.define('CT.view.assigncommercial.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.assigncommercialadd',

    title: 'Add Commercial',
    layout: 'fit',
    autoShow: true,

    initComponent: function() {
        
        this.items = [
            {
                xtype: 'form',
                id : 'form_assign_commercial',
                items: [
                   {
                        xtype: "combobox",
                        name : 'com_id',
                        fieldLabel: 'Choisir commercial',
                        displayField: 'com_nom',
                        valueField: 'com_id',
                        store: 'Commercials',
                        queryMode: 'local',
                        hiddenName: 'com_nom'
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