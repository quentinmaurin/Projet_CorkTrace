<?php

	require_once("../orm/ArrivageDetail.php");

	$ari_id	= isset ($_GET["ari_id"]) ? $_GET["ari_id"] : "undefined";
	$ArrivageDetail = new ArrivageDetail();

	if($ari_id == "undefined"){

		$res = $ArrivageDetail->getAll();

	}else{

		$res = $ArrivageDetail->getAllByArrivage($ari_id);
	}

	
	$i= 0;
	$o["arrivages_details"] = "";

	foreach ($res as $value) {
		$o["arrivages_details"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>