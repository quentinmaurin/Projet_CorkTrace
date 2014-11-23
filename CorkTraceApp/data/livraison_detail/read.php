<?php

	require_once("../orm/LivraisonDetail.php");

	$liv_id	= isset ($_GET["liv_id"]) ? $_GET["liv_id"] : "undefined";
	$LivraisonDetail = new LivraisonDetail();

	if($liv_id == "undefined"){

		$res = $LivraisonDetail->getAll();

	}else{

		$res = $LivraisonDetail->getAllByLivraison($liv_id);
	}	

	$i= 0;
	$o["livraisons_details"] = "";

	foreach ($res as $value) {
		$o["livraisons_details"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>