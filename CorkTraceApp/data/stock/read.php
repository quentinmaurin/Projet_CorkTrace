<?php

	require_once("../orm/Stock.php");

	$Stock = new Stock();
	$res = $Stock->getAll();
	
	$i= 0;
	$o["stocks"] = "";

	foreach ($res as $value) {
		$o["stocks"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>