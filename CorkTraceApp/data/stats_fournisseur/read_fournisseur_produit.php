<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	$i=0;
	
////////////////LONGUEUR MOYENNE PRODUIT//////////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(m.mes_longueur)/count(m.mes_longueur)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f, t_mesure_mes m
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND d.cfm_id=m.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		AND d.pro_id=".$_GET['pro_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="LongueurMoyenneProduit";
		$o[$i]['data']=$value['sum(m.mes_longueur)/count(m.mes_longueur)'];
		$i++;
	}
////////////////DIAMETRE MOYEN PRODUIT//////////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(m.mes_diam)/count(m.mes_diam)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f, t_mesure_mes m
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND d.cfm_id=m.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		AND d.pro_id=".$_GET['pro_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="DiametreMoyenProduit";
		$o[$i]['data']=$value['sum(m.mes_diam)/count(m.mes_diam)'];
		$i++;
	}
////////////////OVALISATION MOYENNE PRODUIT//////////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(m.mes_oval)/count(m.mes_oval)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f, t_mesure_mes m
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND d.cfm_id=m.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		AND d.pro_id=".$_GET['pro_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="OvalisationMoyenneProduit";
		$o[$i]['data']=$value['sum(m.mes_oval)/count(m.mes_oval)'];
		$i++;
	}
////////////////TCA FOURNISSEUR MOYEN PRODUIT//////////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_tca_fourni)/count(f.cfm_tca_fourni)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		AND d.pro_id=".$_GET['pro_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="TCAFournisseurMoyenProduit";
		$o[$i]['data']=$value['sum(f.cfm_tca_fourni)/count(f.cfm_tca_fourni)'];
		$i++;
	}
////////////////TCA INTERNE MOYEN PRODUIT//////////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_tca_inter)/count(f.cfm_tca_inter)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		AND d.pro_id=".$_GET['pro_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="TCAInterneMoyenProduit";
		$o[$i]['data']=$value['sum(f.cfm_tca_inter)/count(f.cfm_tca_inter)'];
		$i++;
	}	

///////////////////////HUMIDITE MOYENNE PRODUIT///////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_humidite)/count(f.cfm_humidite)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		AND d.pro_id=".$_GET['pro_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="HumiditeMoyenneProduit";
		$o[$i]['data']=$value['sum(f.cfm_humidite)/count(f.cfm_humidite)'];
		$i++;
	}
/////////////////////////////DIAMETRE POST COMPRESSION MOYEN PRODUIT/////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_diamcompr)/count(f.cfm_diamcompr)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		AND d.pro_id=".$_GET['pro_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="DiametrePostCompressionMoyenProduit";
		$o[$i]['data']=$value['sum(f.cfm_diamcompr)/count(f.cfm_diamcompr)'];
		$i++;
	}

	
	header('Content-Type: application/json');
	echo json_encode($o);
?>