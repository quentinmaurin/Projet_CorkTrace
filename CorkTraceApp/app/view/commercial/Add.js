Ext.define('CT.view.commercial.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.commercialadd',

    title: 'Add Commercial',
    layout: 'fit',
    autoShow: true,

    initComponent: function() {
        
        this.items = [
            {
                xtype: 'form',
                items: [
                    {
                        xtype: 'textfield',
                        name : 'com_nom',
                        fieldLabel: 'Nom'
                    },{
                        xtype: 'textfield',
                        name : 'com_prenom',
                        fieldLabel: 'Prenom'
                    },{
                        xtype: 'textfield',
                        name : 'com_adresse',
                        fieldLabel: 'Adresse'
                    },{
                        xtype: 'textfield',
                        name : 'com_mail',
                        fieldLabel: 'Mail'
                    },{
                        xtype: 'textfield',
                        name : 'com_tel',
                        fieldLabel: 'Tel' 
                    },{
                        xtype: 'textfield',
                        name : 'com_fax',
                        fieldLabel: 'Fax' 
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