<?php

	require_once("../orm/Produit.php");

	$Produit = new Produit();

	$res = $Produit->getAll();
	
	$i= 0;
	$o["produits"] = "";

	foreach ($res as $value) {
		$o["produits"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>