Ext.define('CT.view.fournisseur.Edit', {
    extend: 'Ext.window.Window',
    alias: 'widget.fournisseuredit',

    title: 'Edit Fournisseur',
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
                        xtype: "combobox",
                        name : 'tyf_id',
                        fieldLabel: 'Choisir type',
                        displayField: 'tyf_nom',
                        valueField: 'tyf_id',
                        store: 'TypeFournisseurs',
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