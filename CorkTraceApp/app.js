Ext.application({
    requires: ['Ext.container.Viewport'],
    name: 'CT',

    appFolder: 'app',
	
    controllers: [
           'Clients',
           'Menu',
           'Fournisseurs',
           'Commercials',
           'Stocks'
    ],

    launch: function() {
        Ext.create('Ext.container.Viewport', {
			renderTo:"app",
			name: "viewport",
			layout: "border",
			items:[{
				region:"north",
				title: "CorkTrace"
			},{
				xtype: "panel",
				region: "west",
				width: "20%",
				layout: "fit",
				items: [{ xtype: 'menulist' }]
			},{
				xtype: "panel",
				region: "center",
				layout:"fit",
				id:"feedviewer",
				items:[{
					xtype:"panel",
					html: "<center><h1>Application</h1><p><img src='./img/logo.png' width=200 /></p></center>"
				}]
			}]
        });
    }
});