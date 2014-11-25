<?php
	
	require_once("../conformite/testConformite.php");
	require_once("../orm/db.php");

//////////////////////////CRITERES ACCEPTATION EN DUR////////////////////////////////////////////////////	
	$lgMax = 10;
	$lgMin = 8;
	$nbToleranceLg = 2;
	$dmMax = 50;
	$dmMin = 49;
	$nbToleranceDm = 2;
	$nbToleranceHmMin = 10;
	$ovMax = 0.7;
	$nbToleranceOv = 5;
	$goutAcceptation = "CORRECT";
	$toleranceTcaInt = 1;
	$toleranceTcaFou = 1;
	$hmMax = 4;
	$hmMin = 8;
	$toleranceDiamComprMin = 5;
	$dmCprMin=90;

//////////////////////////////////////////////////////////////////////////////
	
	$db = new Db();
	
	$confo = $db->executeQuery("
		SELECT p.pro_nom,f.*,sum(d.lid_quantite)
		FROM t_cmdclient_ccl c, t_livraison_liv l, t_livrdetail_lid d, t_conformite_cfm f, t_produit_pro p
		WHERE c.ccl_id=l.ccl_id
		AND l.liv_id=d.liv_id
		AND d.cfm_id=f.cfm_id
		AND c.clc_id=".$_GET['cli_id']."
        AND f.cfm_decision='Non Conforme'
        AND d.pro_id=p.pro_id
        GROUP BY p.pro_nom;
	");

	$i=0;
	$o;
	foreach ($confo as $value) {
		$o[$i]['pro_nom']=$value['pro_nom'];
		$o[$i]['volumeLot']=$value['sum(d.lid_quantite)'];
		$o[$i]['cfm_tca_fourni']=$value['cfm_tca_fourni'];
		$o[$i]['cfm_tca_inter']=$value['cfm_tca_inter'];
		$o[$i]['cfm_gout']=$value['cfm_gout'];
		$o[$i]['cfm_capilarite']=$value['cfm_capilarite'];
		$mesures = $db->executeQuery("
			SELECT m.*
			FROM t_cmdclient_ccl c, t_livraison_liv l, t_livrdetail_lid d, t_conformite_cfm f, t_mesure_mes m
			WHERE c.ccl_id=l.ccl_id
			AND l.liv_id=d.liv_id
			AND d.cfm_id=f.cfm_id
			AND c.clc_id=".$_GET['cli_id']."
			AND m.cfm_id=".$value['cfm_id'].";
		");
		$j=0;
		foreach ($mesures as $mes) {
			$mesuresLg[$j]=$mes['mes_longueur'];
			$mesuresDm[$j]=$mes['mes_diam'];
			$mesuresOv[$j]=$mes['mes_oval'];
			$mesuresHm[$j]=$mes['mes_humidite'];
			$mesuresDmCpr[$j]=$mes['mes_compression'];
			$j++;
		}
		$o[$i]['MesuresLg']=$mesuresLg;
		$o[$i]['MesuresDm']=$mesuresDm;
		$o[$i]['MesuresOv']=$mesuresOv;
		$o[$i]['MesuresHm']=$mesuresHm;
		$o[$i]['MesuresDmCpr']=$mesuresDmCpr;
		$i++;
	}
	
	$k=0;
	while($k<$i){
		$sourcesNC[$k]['NomProduit']= $o[$k]['pro_nom'];
		$sourcesNC[$k]['VolumeLot']= $o[$k]['volumeLot'];
		$sourcesNC[$k]['DetailNC']= sourcesNonConformite(
								   $o[$k]['MesuresLg'],$lgMax,$lgMin,$nbToleranceLg,
								   $o[$k]['MesuresDm'],$dmMax,$dmMin,$nbToleranceDm,
								   $o[$k]['MesuresOv'],$ovMax,$nbToleranceOv,
								   $o[$k]['cfm_gout'],$goutAcceptation,
								   $o[$k]['cfm_tca_fourni'],$toleranceTcaFou,
								   $o[$k]['cfm_tca_inter'],$toleranceTcaInt,
								   $o[$k]['cfm_capilarite'],
								   $o[$k]['MesuresHm'],$hmMax,$hmMin,$nbToleranceHmMin,
								   $o[$k]['MesuresDmCpr'],$dmCprMin,$toleranceDiamComprMin);
		$k++;
	}
	
	header('Content-Type: application/json');
	echo json_encode($sourcesNC);
?>