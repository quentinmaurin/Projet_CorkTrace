<?php

	require_once("../orm/Livraison.php");

	$Livraison = new Livraison();
	$res = $Livraison->getAll();

	$i= 0;
	$o["livraisons"] = "";

	foreach ($res as $value) {
		$o["livraisons"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>