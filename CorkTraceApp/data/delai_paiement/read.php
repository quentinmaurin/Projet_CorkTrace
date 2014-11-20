<?php

	require_once("../orm/DelaiPaiement.php");

	$DelaiPaiement = new DelaiPaiement();

	$res = $DelaiPaiement->getAll();
	
	$i= 0;
	$o["delai_paiement"] = "";

	foreach ($res as $value) {
		$o["delai_paiement"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>