<?php

	require_once("../orm/CommandeFournisseurDetail.php");

	//Vérif des données entrante
	$cfo_id	= isset ($_GET['cfo_id']) ? $_GET['cfo_id'] : "undefined";

	if( $cfo_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$CommandeFournisseurDetail = new CommandeFournisseurDetail();

	$res = $CommandeFournisseurDetail->getAllDetailByCommande($cfo_id);

	$i= 0;
	$o["commande_detail"] = "";

	foreach ($res as $value) {
		$o["commande_detail"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>