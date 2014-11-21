<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	$i=0;
	
	$res = $db->executeQuery("
		SELECT datediff(c.cfo_dateRecept,c.cfo_dateCmd)
		FROM t_cmdfourni_cfo c, t_arrivage_ari a
		WHERE c.ari_id=a.ari_id
		AND c.fou_id=".$_GET['fou_id']."
		GROUP BY a.ari_id 
        ORDER BY c.cfo_dateRecept;
	");
	
	foreach ($res as $value) {
		$o[$i]['name']="DelaiLivraison";
		$o[$i]['data']=$value['datediff(c.cfo_dateRecept,c.cfo_dateCmd)'];
		$i++;
	}
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>