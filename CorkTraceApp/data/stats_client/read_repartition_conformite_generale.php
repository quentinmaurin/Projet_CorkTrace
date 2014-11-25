<?php
	
	require_once("../orm/db.php");

	$db = new Db();
	
	$res = $db->executeQuery("
		SELECT f.cfm_decision,sum(d.lid_quantite)
		FROM t_cmdclient_ccl c, t_livraison_liv l, t_livrdetail_lid d, t_conformite_cfm f
		WHERE c.ccl_id=l.ccl_id
		AND l.liv_id=d.liv_id
		AND d.cfm_id=f.cfm_id
		AND c.clc_id=".$_GET['cli_id']."
        GROUP BY f.cfm_decision;
	");

	$i=0;
	foreach ($res as $value) {
		$o[$i]['name']=$value['cfm_decision'];
		$o[$i]['data']=$value['sum(d.ard_quantite)'];
		$i++;
	}
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>