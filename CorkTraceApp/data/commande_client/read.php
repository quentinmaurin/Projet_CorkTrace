<?php

	require_once("../orm/CommandeClient.php");

	$CommandeClient = new CommandeClient();
	$res = $CommandeClient->getAll();

	$i= 0;
	$o["commandes_clients"] = "";

	foreach ($res as $value) {
		$o["commandes_clients"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>