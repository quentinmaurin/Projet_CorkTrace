<?php

	require_once("../orm/AssignAdress.php");

	//Vérif des données entrante
	$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";

	if( $cli_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$AssignAdress = new AssignAdress();

	$res = $AssignAdress->getDeliveriesAdress($cli_id);

	$i= 0;
	$o["adresse_livraisons"] = "";

	foreach ($res as $value) {
		$o["adresse_livraisons"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>