<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	$i=0;
	
	$res = $db->executeQuery("
		SELECT d.ard_quantite
		FROM t_cmdfourni_cfo c, t_arrivage_ari a, t_arrivagedetail_ard d
		WHERE c.ari_id=a.ari_id
		AND a.ari_id=d.ari_id
		AND c.fou_id=".$_GET['fou_id']."
		GROUP BY a.ari_id 
        ORDER BY c.cfo_dateRecept;
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="VolumeArrivage";
		$o[$i]['data']=$value['ard_quantite'];
		$i++;
	}	
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>