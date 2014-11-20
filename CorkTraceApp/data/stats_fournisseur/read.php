<?php
	
	require_once("../statistiques/stats.php");
	require_once("../orm/db.php");

	$db = new Db();
	
	$res = $db->executeQuery("
		SELECT count(*) 
		FROM t_cmdfourni_cfo c 
		WHERE c.fou_id=".$_GET['fou_id'].";
	");

	echo $res;
	/**
	$i=0;
	
	foreach ($res as $value) {
		$o[$i]['name']="";
		$o[$i]['data']=$value[''];
		$i++;
	}
	**/
	
	header('Content-Type: application/json');
	echo json_encode($o);
?>