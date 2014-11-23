Ext.define('CT.controller.Arrivages', {
    extend: 'Ext.app.Controller',

    stores: ['Arrivages', 'CommandeFournisseurDetails'],
	
	models: ['Arrivage', 'CommandeFournisseurDetail'],
	   
    views: [
    	'arrivage.List',
        'arrivage.Add',
        'arrivage.Controle'
    ],
	   
    init: function() {
        this.control({
        });
    }
});