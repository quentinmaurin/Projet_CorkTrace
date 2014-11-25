<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	
	$res = $db->executeQuery("
		SELECT f.cfm_decision, sum(d.ard_quantite)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
        AND (cfm_decision='Conforme'
			OR cfm_decision='Non Conforme'
			OR cfm_decision='Exception')
		GROUP BY f.cfm_decision;
	");

	foreach ($res as $value) {
		if($value['cfm_decision']=='Non Conforme'){
			$o['QteNonConforme']=$value['sum(d.ard_quantite)'];
		}else{
			$o['QteConforme']=$value['sum(d.ard_quantite)'];
		}
	}
	
	$res = $db->executeQuery("
		SELECT f.cfm_id, f.cfm_decision 
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f 
		WHERE c.ari_id=a.ari_id 
		AND a.ari_id=d.ari_id 
		AND d.cfm_id=f.cfm_id 
		AND c.fou_id=".$_GET['fou_id']."
		GROUP BY f.cfm_id
		ORDER BY c.cfo_dateRecept;
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