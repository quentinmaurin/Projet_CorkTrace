Ext.define('CT.controller.StatFournisseurs', {
    extend: 'Ext.app.Controller',

    stores: ['Fournisseurs'],
	
	models: ['Fournisseur'],
	   
    views: [
    	'statfournisseur.List',
        'statfournisseur.ListLot'
    ],
	   
    init: function() {
        this.control({
        });
    }
});