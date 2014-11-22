<?php

	require_once("../orm/CommandeClientDetail.php");

	//Vérif des données entrante
	$ccl_id	= isset ($_GET['ccl_id']) ? $_GET['ccl_id'] : "undefined";

	if( $ccl_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$CommandeClientDetail = new CommandeClientDetail();

	$res = $CommandeClientDetail->getListDetails($ccl_id);

	$i= 0;
	$o["commande_detail"] = "";

	foreach ($res as $value) {
		$o["commande_detail"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>