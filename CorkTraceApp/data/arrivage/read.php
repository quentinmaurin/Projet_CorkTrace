<?php

	require_once("../orm/Arrivage.php");

	$Arrivage = new Arrivage();
	$res = $Arrivage->getAll();

	$i= 0;
	$o["arrivages"] = "";

	foreach ($res as $value) {
		$o["arrivages"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>