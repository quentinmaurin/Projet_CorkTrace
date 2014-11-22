Ext.define('CT.controller.Commercials', {
    extend: 'Ext.app.Controller',

    stores: ['Commercials'],
	
	models: ['Commercial'],
	   
    views: [
    	'commercial.List',
		'commercial.Edit',
		'commercial.Add'
    ],
	   
    init: function() {
        this.control({
            'viewport > panel': {
                render: this.onPanelRendered
            },
	        'commercialedit button[action=save]': {
	        	click: this.updateCommercial
	        },
	        'commercialadd button[action=save]': {
	        	click: this.createCommercial
	        }
        });
    },

    onPanelRendered: function() {
    },
	
    updateCommercial: function(button) {
		
		var win = button.up('window'),
	    form = win.down('form'),
	    record = form.getRecord(),
	    values = form.getValues();

	    record.set(values);
	    win.close();
		
	  	// synchronize the store after editing the record
	    this.getCommercialsStore().sync();
    },

    createCommercial: function(button) {
		
		var win = button.up('window');
	    form = win.down('form');
	    record = form.getRecord(),
	    values = form.getValues();

	    var commercialInstance = Ext.create('CT.model.Commercial', {

		    com_id : -1,
		    com_nom : values['com_nom'],
		    com_prenom : values['com_prenom'],
		    com_adresse : values['com_adresse'],
		    com_mail : values['com_mail'],
		    com_tel : values['com_tel'],
		    com_fax : values['com_fax']
		});

	    this.getCommercialsStore().add(commercialInstance);
	    win.close();
		
	  	// synchronize the store after editing the record
	    this.getCommercialsStore().sync();
    }

});