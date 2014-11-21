<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	$i=0;
	
	$res = $db->executeQuery("
		SELECT count(f.cfm_decision) 
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f 
		WHERE c.ari_id=a.ari_id 
		AND a.ari_id=d.ari_id 
		AND d.cfm_id=f.cfm_id 
		AND f.cfm_decision='accepte' 
		GROUP BY d.ari_id
		ORDER BY c.cfo_dateRecept;
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="";
		$o[$i]['data']=$value['count(f.cfm_decision)'];
		$i++;
	}
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>