Ext.define('CT.view.fournisseur.Add', {
    extend: 'Ext.window.Window',
    alias: 'widget.fournisseuradd',

    title: 'Add Fournisseur',
    layout: 'fit',
    autoShow: true,

    initComponent: function() {

        this.items = [
            {
                xtype: 'form',
                items: [
                    {
                        xtype: 'textfield',
                        name : 'fou_nom',
                        fieldLabel: 'Nom'
                    },{
                        xtype: 'textfield',
                        name : 'fou_adresse',
                        fieldLabel: 'Adresse'
                    },{
                        xtype: 'textfield',
                        name : 'fou_mail',
                        fieldLabel: 'Mail'
                    },{
                        xtype: 'textfield',
                        name : 'fou_tel',
                        fieldLabel: 'Tel'
                    },{
                        xtype: 'textfield',
                        name : 'fou_fax',
                        fieldLabel: 'Fax'
                    },{
                        xtype: 'textfield',
                        name : 'tyf_id',
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