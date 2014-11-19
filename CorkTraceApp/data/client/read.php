<?php

	require_once("../orm/Client.php");
	require_once("../orm/AssignAdress.php");

	$Client = new Client();
	$AssignAdress = new AssignAdress();

	$res = $Client->getAll();
	
	$i= 0;
	$o["clients"] = "";

	foreach ($res as $value) {
		$o["clients"][$i] = $value;

		$resAdress = $AssignAdress->getDeliveriesAdress($value["cli_id"]);
		$o["clients"][$i]["adresses_livraison"] = $resAdress;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>