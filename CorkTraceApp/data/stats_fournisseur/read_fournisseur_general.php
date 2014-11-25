<?php
	
	require_once("../orm/db.php");

	$db = new Db();
	$i=0;
	
////////////////TOTAL DES COMMANDES//////////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT count(*) 
		FROM t_cmdfourni_cfo c 
		WHERE c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="TotalCommandes";
		$o[$i]['data']=$value['count(*)'];
		$i++;
	}
////////////////////TOTAL DES ARRIVAGES//////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT count(*) 
		FROM t_cmdfourni_cfo c, t_arrivage_ari a
		WHERE c.ari_id=a.ari_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="TotalArrivages";
		$o[$i]['data']=$value['count(*)'];
		$i++;
	}
/////////////////////DELAI LIVRAISON MOYEN/////////////////////////////////////////////////////	

	$res = $db->executeQuery("
		SELECT sum(datediff(c.cfo_dateRecept,c.cfo_dateCmd))/count(a.ari_id)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a
		WHERE c.ari_id=a.ari_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="DelaiLivraisonMoyen";
		$o[$i]['data']=$value['sum(datediff(c.cfo_dateRecept,c.cfo_dateCmd))/count(a.ari_id)'];
		$i++;
	}
//////////////////////////VOLUME TOTAL DES ARRIVAGES////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(d.ard_quantite)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="VolumeTotalArrivages";
		$o[$i]['data']=$value['sum(d.ard_quantite)'];
		$i++;
	}
///////////////////////VOLUME MOYEN D'UN ARRIVAGE///////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(d.ard_quantite)/count(c.ari_id)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="VolumeMoyenArrivage";
		$o[$i]['data']=$value['sum(d.ard_quantite)/count(c.ari_id)'];
		$i++;
	}	
//////////////////////OVALISATION GENERALE MOYENNE////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(m.mes_oval)/count(m.mes_oval)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f, t_mesure_mes m
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND d.cfm_id=m.cfm_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="OvalisationMoyenne";
		$o[$i]['data']=$value['sum(m.mes_oval)/count(m.mes_oval)'];
		$i++;
	}
//////////////////////TCA FOURNISSEUR MOYEN////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_tca_fourni)/count(f.cfm_tca_fourni)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="TCAFournisseurMoyen";
		$o[$i]['data']=$value['sum(f.cfm_tca_fourni)/count(f.cfm_tca_fourni)'];
		$i++;
	}
/////////////////////TCA INTERNE MOYEN/////////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_tca_inter)/count(f.cfm_tca_inter)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="TCAInterneMoyen";
		$o[$i]['data']=$value['sum(f.cfm_tca_inter)/count(f.cfm_tca_inter)'];
		$i++;
	}
///////////////////////HUMIDITE MOYENNE GENERALE///////////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_humidite)/count(f.cfm_humidite)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="HumiditeMoyenneGenerale";
		$o[$i]['data']=$value['sum(f.cfm_humidite)/count(f.cfm_humidite)'];
		$i++;
	}
/////////////////////////////DIAMETRE POST COMPRESSION GENERAL MOYEN/////////////////////////////////////////////	
	$res = $db->executeQuery("
		SELECT sum(f.cfm_diamcompr)/count(f.cfm_diamcompr)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id'].";
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="DiametrePostCompressionGeneralMoyen";
		$o[$i]['data']=$value['sum(f.cfm_diamcompr)/count(f.cfm_diamcompr)'];
		$i++;
	}
//////////////////////////////////////////////////////////////////////////	

	
	header('Content-Type: application/json');
	echo json_encode($o);
?>