<?php

	require_once("../orm/Adress.php");

	$Adress = new Adress();

	$res = $AssignAdress->getAll();

	$i= 0;
	$o["adresses"] = "";

	foreach ($res as $value) {
		$o["adresses"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>