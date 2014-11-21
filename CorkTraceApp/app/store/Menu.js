Ext.define('CT.store.Menu', {
    extend: 'Ext.data.TreeStore',
	
    root: {
        expanded: true,
        children: [
            { text: "Fichiers de base", expanded: true, children: [
                    { text: "Client", leaf: true },
                    { text: "Fournisseur", leaf: true},
                    { text: "Commercial", leaf: true}
            ] },
            { text: "Stock", leaf: true },
            { text: "Commande fournisseur", leaf: true },
            { text: "Arrivage", leaf: true },
            { text: "Commande client", leaf: true },
            { text: "Livraison", leaf: true },
            { text: "Traçabilité", expanded: true, children: [
                    { text: "Ascendante", leaf: true },
                    { text: "Descendante", leaf: true}
            ] },
            { text: "Statistiques", expanded: true, children: [
                    { text: "Stats Fournisseur", leaf: true },
                    { text: "Fournisseur/Produit", leaf: true},
                    { text: "Stats Client", leaf: true},
                    { text: "Client/Produit", leaf: true}
            ] }
        ]
    }
});