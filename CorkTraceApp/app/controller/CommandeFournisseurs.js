Ext.define('CT.controller.CommandeFournisseurs', {
    extend: 'Ext.app.Controller',

    stores: ['CommandeFournisseurs'],
	
	models: ['CommandeFournisseur'],
	   
    views: [
    	'commandefournisseur.List',
    ],
	   
    init: function() {
        this.control({
        });
    }
});