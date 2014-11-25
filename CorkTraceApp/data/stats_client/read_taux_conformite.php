<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	
	$res = $db->executeQuery("
		SELECT f.cfm_decision,sum(d.lid_quantite)
		FROM t_cmdclient_ccl c, t_livraison_liv l, t_livrdetail_lid d, t_conformite_cfm f
		WHERE c.ccl_id=l.ccl_id
		AND l.liv_id=d.liv_id
		AND d.cfm_id=f.cfm_id
		AND c.clc_id=".$_GET['cli_id']."
		AND (cfm_decision='Conforme'
			OR cfm_decision='Non Conforme'
			OR cfm_decision='Exception')
        GROUP BY f.cfm_decision;
	
	");

	foreach ($res as $value) {
		if($value['cfm_decision']=='Non Conforme'){
			$o['QteNonConforme']=$value['sum(d.lid_quantite)'];
		}else{
			$o['QteConforme']=$value['sum(d.lid_quantite)'];
		}
	}
	
	$res = $db->executeQuery("
		SELECT f.cfm_id, f.cfm_decision 
		FROM t_cmdclient_ccl c, t_livraison_liv l, t_livrdetail_lid d, t_conformite_cfm f
		WHERE c.ccl_id=l.ccl_id
		AND l.liv_id=d.liv_id
		AND d.cfm_id=f.cfm_id
		AND c.clc_id=".$_GET['cli_id']."
		GROUP BY f.cfm_id
		ORDER BY c.ccl_dateLiv;
	");
	
	$i=0;
	foreach ($res as $value) {
		if($value['cfm_decision']=='Conforme'){
			$d[$i]=1;
		}else{
			$d[$i]=0;
		}
		$i++;
	}
	
	$o['Pente']=pente_courbe_regression($d);
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>