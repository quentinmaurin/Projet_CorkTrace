Ext.define('CT.controller.Livraisons', {
    extend: 'Ext.app.Controller',

    stores: ['Livraisons', 'CommandeClientDetails'],
	
	models: ['Livraison', 'CommandeClientDetail'],
	   
    views: [
    	'livraison.List',
    	'livraison.Add'
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