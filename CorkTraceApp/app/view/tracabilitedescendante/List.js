Ext.define('CT.view.tracabilitedescendante.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.tracabilitedescendantelist',

    title: 'Tracabilite descendante',
    layout: "border",

    items: [{
        title : "Liste des lots livrés",
        xtype : "grid",
        region : "center",
        id: 'gridtracabilitedescendantelot',
        store: 'LivraisonDetails',
        columns : [
            {header: 'Client', dataIndex: 'cli_nom', flex: 1},
            {header: 'Produit', dataIndex: 'pro_nom', flex: 1},
            {header: 'Qualité', dataIndex: 'pro_qualite', flex: 1},
            {header: 'Marquage', dataIndex: 'lid_marquage', flex: 1},
            {header: 'Date de livraison', dataIndex: 'liv_dateLiv', flex: 1},
            {header: 'Quantité de livraison', dataIndex: 'lid_quantite', flex: 1},
            {header: 'Numéro de livraison', dataIndex: 'liv_id', flex: 1}
        ]
    },{
        title : "Fournisseur ayant livré le lot",
        xtype : "grid",
        region : "east",
        width: "40%",
        id: 'gridtracabilitedescendanteclient',
        store: 'TracabiliteDescendantes',
        columns : [
            {header: 'Fournisseur', dataIndex: 'fou_nom', flex: 1},
            {header: 'Téléphone', dataIndex: 'fou_tel', flex: 1},
            {header: 'Date Commande', dataIndex: 'cfo_dateCmd', flex: 1},
            {header: 'Date Livraison', dataIndex: 'cfo_dateRecept', flex: 1},
            {header: 'Numéro commande fournisseur', dataIndex: 'cfm_id', flex: 1}
        ]
    }],


    initComponent: function() {

        this.callParent(arguments);
    }
});