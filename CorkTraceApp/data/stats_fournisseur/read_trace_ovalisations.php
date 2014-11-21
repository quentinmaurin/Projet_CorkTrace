<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	$i=0;
	
	$res = $db->executeQuery("
		SELECT m.mes_oval
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f, t_mesure_mes m
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND d.cfm_id=m.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		GROUP BY a.ari_id 
        ORDER BY c.cfo_dateRecept;
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="Ovalisation";
		$o[$i]['data']=$value['mes_oval'];
		$i++;
	}	
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>