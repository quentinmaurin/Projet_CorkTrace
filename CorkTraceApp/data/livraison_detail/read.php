<?php

	require_once("../orm/LivraisonDetail.php");

	$LivraisonDetail = new LivraisonDetail();
	$res = $LivraisonDetail->getAll();

	$i= 0;
	$o["livraisons_details"] = "";

	foreach ($res as $value) {
		$o["livraisons_details"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>