Ext.define('CT.controller.Livraisons', {
    extend: 'Ext.app.Controller',

    stores: ['Livraisons', 'CommandeClientDetails', 'LivraisonDetails', 'Mesures'],
	
	models: ['Livraison', 'CommandeClientDetail', 'LivraisonDetail', 'Mesure'],
	   
    views: [
    	'livraison.List',
    	'livraison.Add',
        'livraison.Controle'
    ],
	   
    init: function() {
        this.control({
            'viewport > panel': {
                render: this.onPanelRendered
            }
        });
    },

    onPanelRendered: function() {
    }
});