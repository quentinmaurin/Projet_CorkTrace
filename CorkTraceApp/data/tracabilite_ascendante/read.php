<?php

	require_once("../orm/Db.php");

	$ard_id = $_GET['ard_id'];
	$db = new Db();

	$query  = "
	SELECT *
	FROM t_arrivagedetail_ard
	INNER JOIN  t_livrdetail_lid ON t_livrdetail_lid.ard_id = t_arrivagedetail_ard.ard_id
	INNER JOIN t_livraison_liv ON t_livraison_liv.liv_id = t_livrdetail_lid.liv_id
	INNER JOIN t_cmdclient_ccl ON t_cmdclient_ccl.ccl_id = t_livraison_liv.ccl_id
	INNER JOIN t_clicom_clc ON t_clicom_clc.clc_id = t_cmdclient_ccl.clc_id
	INNER JOIN t_client_cli ON t_client_cli.cli_id = t_clicom_clc.cli_id
	WHERE t_arrivagedetail_ard.ard_id = ".$ard_id;

	$response = $db->getResponse($query);

	$i= 0;
	$o["tracabilite_ascendante"] = "";

	foreach ($response as $value) {
		$o["tracabilite_ascendante"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>