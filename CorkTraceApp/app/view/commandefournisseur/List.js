Ext.define('CT.view.commandefournisseur.List' ,{
    extend: 'Ext.grid.Panel',
    alias: 'widget.commandefournisseurlist',

    title: 'Toutes les commandes fournisseur',
    id: 'commandefournisseurlist',
    store: 'CommandeFournisseurs',
	
    bbar: [
        '->',
        { xtype: 'button', text: 'Ajouter', handler: function(){

            var view = Ext.widget('commandefournisseuradd');
        } },
        {
            xtype: 'button', text: 'Supprimer', action: 'delete'
        },
        {
            xtype: 'button', text: 'Visualiser PDF', action: 'visualiserPDF', href:"services/facturation.php",
            listeners : {
                'click' : function(){
                    console.log("test");
                    var row = Ext.getCmp('commandefournisseurlist').getSelectionModel().getSelection()[0];
                    var cfo_id = row.get("cfo_id");
                    console.log(cfo_id);
                    this.href = "services/facturation.php?id="+cfo_id;
                    this.el.dom.href = this.getHref();
                    console.log(this.href);
                }
            }
        },
        '->'
    ],

    initComponent: function() {

        this.columns = [
            {header: 'Cfo Id',  dataIndex: 'cfo_id',  flex: 1},
            {header: 'Date Cmd', dataIndex: 'cfo_dateCmd', flex: 1},
            {header: 'Date recept', dataIndex: 'cfo_dateRecept', flex: 1},
            {header: 'Fou Id', dataIndex: 'fou_id', flex: 1},
            {header: 'Ari Id', dataIndex: 'ari', flex: 1}
        ];

        this.callParent(arguments);
    }
});