Ext.define('CT.controller.Arrivages', {
    extend: 'Ext.app.Controller',

    stores: ['Arrivages', 'CommandeFournisseurDetails'],
	
	models: ['Arrivage', 'CommandeFournisseurDetail'],
	   
    views: [
    	'arrivage.List',
        'arrivage.Add'
    ],
	   
    init: function() {
        this.control({
        });
    }
});