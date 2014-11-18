<?php

	require_once("../orm/Fournisseur.php");

	$Fournisseur = new Fournisseur();
	$res = $Fournisseur->getAll();
	
	$i= 0;
	$o["fournisseurs"] = "";

	foreach ($res as $value) {
		$o["fournisseurs"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>