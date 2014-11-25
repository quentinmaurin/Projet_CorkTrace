<?php

	require_once("../orm/Db.php");

	$lid_id = $_GET['lid_id'];
	$db = new Db();

	$query  = "
	SELECT *
	FROM t_livrdetail_lid
	INNER JOIN  t_arrivagedetail_ard ON t_arrivagedetail_ard.ard_id = t_livrdetail_lid.ard_id
	INNER JOIN t_cmdfourni_cfo ON t_cmdfourni_cfo.ari_id = t_arrivagedetail_ard.ari_id
	INNER JOIN t_fournisseur_fou ON t_fournisseur_fou.fou_id = t_cmdfourni_cfo.fou_id
	WHERE t_livrdetail_lid.lid_id = ".$lid_id;

	$response = $db->getResponse($query);

	$i= 0;
	$o["tracabilite_descendante"] = "";

	foreach ($response as $value) {
		$o["tracabilite_descendante"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>