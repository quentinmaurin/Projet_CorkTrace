<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	$i=0;
	
	$res = $db->executeQuery("
		SELECT f.cfm_tca_fourni
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d, t_conformite_cfm f
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND d.cfm_id=f.cfm_id
		AND c.fou_id=".$_GET['fou_id']."
		GROUP BY a.ari_id 
        ORDER BY c.cfo_dateRecept;
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="TCAFournisseur";
		$o[$i]['data']=$value['cfm_tca_fourni'];
		$i++;
	}
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>