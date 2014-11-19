<?php

	require_once("../orm/Client.php");

	$Client = new Client();

	$res = $Client->getAll();
	
	$i= 0;
	$o["clients"] = "";

	foreach ($res as $value) {
		$o["clients"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>