Ext.define('CT.controller.StatFournisseurs', {
    extend: 'Ext.app.Controller',

    stores: ['Fournisseurs', 'FournisseurRepartitionConformites', 'FournisseurProbaConformites'],
	
	models: ['Fournisseur', 'PieChart'],
	   
    views: [
    	'statfournisseur.List',
        'statfournisseur.ListLot'
    ],
	   
    init: function() {
        this.control({
        });
    }
});