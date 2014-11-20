<?php

	require_once("../orm/AssignCommercial.php");

	//Vérif des données entrante
	$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";

	if( $cli_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$AssignCommercial = new AssignCommercial();

	$res = $AssignCommercial->getCommercialByClient($cli_id);

	$i= 0;
	$o["assign_commerciaux"] = "";

	foreach ($res as $value) {
		$o["assign_commerciaux"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>