Ext.define('CT.view.statfournisseur.List' ,{
    extend: 'Ext.panel.Panel',
    alias: 'widget.statfournisseurlist',

    title: 'Stat fournisseur',
    layout: "border",

    items:[{

        xtype:"grid",
        region : "center",
        id: 'gridstatfournisseurlist',
        title: "Liste des fournisseurs",
        store:'Fournisseurs',
        columns : [
            {header: 'Fou Id',  dataIndex: 'fou_id',  flex: 1},
            {header: 'Fou Nom', dataIndex: 'fou_nom', flex: 1}
        ],
        listeners : {
            'itemdblclick': function( grid, record, item, index, e, eOpts ){

                console.log("dbl click");
                var view = Ext.widget('statfournisseurlistlot');
            },
            'itemclick': function( grid, record, item, index, e, eOpts ){
                
                console.log("click");

                Ext.getCmp('graph_fou_repartition_conformite').getStore().getProxy().extraParams = {
                    fou_id: record.get("fou_id")
                };

                Ext.getCmp('graph_fou_repartition_conformite').getStore().load();


                Ext.getCmp('graph_fou_proba_conformite').getStore().getProxy().extraParams = {
                    fou_id: record.get("fou_id")
                };

                Ext.getCmp('graph_fou_proba_conformite').getStore().load();

            }
        }

    },{
        xtype: "panel",
        region: "east",
        width: "70%",
        title: "stat",
        layout:"border",
        items : [{
            xtype:"panel",
            region:"center",
            title:"Détails de non conformité"
        },{
            xtype:"panel",
            region:"north",
            height:"30%",
            layout:"border",
            items:[{
                xtype:"panel",
                region:"center",
                title:"Répartition conformité",
                layout:"fit",
                items:[{
                    xtype:"chart",
                    width: "100%",
                    height: "100%",
                    animate: true,
                    id : "graph_fou_repartition_conformite",
                    store: 'FournisseurRepartitionConformites',
                    theme: 'Base:gradients',
                    series: [{
                        type: 'pie',
                        angleField: 'data',
                        showInLegend: true,
                        tips: {
                            trackMouse: true,
                            width: 140,
                            height: 28,
                            renderer: function(storeItem, item) {
                                // calculate and display percentage on hover
                                var total = 0;
                                store.each(function(rec) {
                                    total += rec.get('data');
                                });
                                this.setTitle(storeItem.get('name') + ': ' + Math.round(storeItem.get('data') / total * 100) + '%');
                            }
                        },
                        highlight: {
                            segment: {
                                margin: 20
                            }
                        },
                        label: {
                            field: 'name',
                            display: 'rotate',
                            contrast: true,
                            font: '7px Arial'
                        }
                    }]
                }]
            },{
                xtype:"panel",
                region:"west",
                width:"30%",
                title:"Infos générale"
            },{
                xtype:"panel",
                region:"east",
                width:"35%",
                title:"Proba de conformité",
                layout:"fit",
                items:[{
                    xtype:"chart",
                    width: "100%",
                    height: "100%",
                    animate: true,
                    id : "graph_fou_proba_conformite",
                    store: 'FournisseurProbaConformites',
                    theme: 'Base:gradients',
                    legend: {
                        position: 'right'
                    },
                    series: [{
                        type: 'pie',
                        angleField: 'data',
                        showInLegend: true,
                        tips: {
                            trackMouse: true,
                            width: 140,
                            height: 28,
                            renderer: function(storeItem, item) {
                                // calculate and display percentage on hover
                                var total = 0;
                                store.each(function(rec) {
                                    total += rec.get('data');
                                });
                                this.setTitle(storeItem.get('name') + ': ' + Math.round(storeItem.get('data') / total * 100) + '%');
                            }
                        },
                        highlight: {
                            segment: {
                                margin: 20
                            }
                        },
                        label: {
                            field: 'name',
                            display: 'rotate',
                            contrast: true,
                            font: '7px Arial'
                        }
                    }]
                }]
            }]
        }]
    }],

    initComponent: function() {

        this.callParent(arguments);
    }
});