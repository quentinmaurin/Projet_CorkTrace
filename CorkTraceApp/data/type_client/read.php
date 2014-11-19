<?php

	require_once("../orm/TypeClient.php");

	$TypeClient = new TypeClient();
	$res = $TypeClient->getAll();
	
	$i= 0;
	$o["type_clients"] = "";

	foreach ($res as $value) {
		$o["type_clients"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>