Ext.define('CT.view.tracabiliteascendante.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.tracabiliteascendantelist',

    title: 'Tracabilite ascendante',
    layout: "border",

    items: [{
        title : "Liste des lots reçus",
        xtype : "grid",
        region : "center",
        id: 'gridtracabiliteascendantelot',
        store: 'ArrivageDetails',
        columns : [
            {header: 'Fournisseur', dataIndex: 'fou_nom', flex: 1},
            {header: 'Produit', dataIndex: 'pro_nom', flex: 1},
            {header: 'Qualité', dataIndex: 'pro_qualite', flex: 1},
            {header: 'Date réception', dataIndex: 'cfo_dateRecept', flex: 1},
            {header: 'Quantite arrivage', dataIndex: 'ard_quantite', flex: 1},
            {header: "Numéro d'arrivage", dataIndex: 'ari_id', flex: 1}
        ]
    },{
        title : "Liste des clients ayant été livré avec ce lot",
        xtype : "grid",
        region : "east",
        width: "40%",
        id: 'gridtracabiliteascendanteclient',
        store: 'TracabiliteAscendantes',
        columns : [
            {header: 'Client', dataIndex: 'cli_nom', flex: 1},
            {header: 'Téléphone', dataIndex: 'cli_tel', flex: 1},
            {header: 'Date de livraison', dataIndex: 'liv_dateLiv', flex: 1},
            {header: 'Quantité de livraison', dataIndex: 'lid_quantite', flex: 1},
            {header: 'Numéro de livraison', dataIndex: 'liv_id', flex: 1}
        ]
    }],


    initComponent: function() {

        this.callParent(arguments);
    }
});