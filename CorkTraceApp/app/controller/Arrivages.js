Ext.define('CT.controller.Arrivages', {
    extend: 'Ext.app.Controller',

    stores: ['Arrivages', 'CommandeFournisseurDetails', 'ArrivageDetails', 'Mesures'],
	
	models: ['Arrivage', 'CommandeFournisseurDetail', 'ArrivageDetail', 'Mesure'],
	   
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