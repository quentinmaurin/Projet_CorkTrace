Ext.define('CT.store.Fournisseurs', {
    extend: 'Ext.data.Store',
	model: 'CT.model.Fournisseur',

    proxy: {
        type: 'ajax',
        api: {
            read: 'data/fournisseurs.json',
            update: 'data/updateFournisseurs.php'
        },
        reader: {
            type: 'json',
            root: 'fournisseurs'
        }
    },
    autoLoad: true
});