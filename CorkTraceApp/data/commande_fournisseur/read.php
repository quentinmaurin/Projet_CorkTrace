<?php

	require_once("../orm/CommandeFournisseur.php");

	$CommandeFournisseur = new CommandeFournisseur();
	$res = $CommandeFournisseur->getAll();

	$i= 0;
	$o["commandes_fournisseurs"] = "";

	foreach ($res as $value) {
		$o["commandes_fournisseurs"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>