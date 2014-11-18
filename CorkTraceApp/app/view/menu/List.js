Ext.define('CT.view.menu.List' ,{
    extend: 'Ext.tree.Panel',
    alias: 'widget.menulist',

    title: 'Menu',

    store: 'Menu',

    width: 200,
    height: 150,
    rootVisible: false,
    collapsible : false,
	
    initComponent: function() {

        this.callParent(arguments);
    }
});