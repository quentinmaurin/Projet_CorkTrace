Ext.define('CT.store.Menu', {
    extend: 'Ext.data.TreeStore',
	
    root: {
        expanded: true,
        children: [
            { text: "Client", leaf: true },
            { text: "Fournisseur", leaf: true },
            { text: "Commande client", leaf: true },
            { text: "Commande fournisseur", leaf: true }
        ]
    }
});