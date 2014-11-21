Ext.define('CT.controller.Stocks', {
    extend: 'Ext.app.Controller',

    stores: ['Stocks'],
	
	models: ['Stock'],
	   
    views: [
    	'stock.List'
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