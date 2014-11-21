Ext.define('CT.controller.TracabiliteAscendantes', {
    extend: 'Ext.app.Controller',

    stores: ['ArrivageDetails'],
	
	models: ['ArrivageDetail'],
	   
    views: [
    	'tracabiliteascendante.List'
    ],
	   
    init: function() {
        this.control({
        });
    }
});