<?php

	require_once("../orm/ArrivageDetail.php");

	$ArrivageDetail = new ArrivageDetail();

	$res = $ArrivageDetail->getAll();
	
	$i= 0;
	$o["arrivages_details"] = "";

	foreach ($res as $value) {
		$o["arrivages_details"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>