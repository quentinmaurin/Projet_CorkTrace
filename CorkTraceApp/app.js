Ext.application({
    requires: ['Ext.container.Viewport'],
    name: 'CT',

    appFolder: 'app',
	
    controllers: [
           'Clients'
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
				title: "Menu",
				width: "20%",
				layout: "fit",
				items: []
			},{
				xtype: "panel",
				region: "center",
				layout:"fit",
				id:"feedviewer",
				items:[{
					xtype: 'clientlist'
				}]
			}]
        });
    }
});