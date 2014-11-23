<?php

	require_once("../orm/Mesure.php");
	require_once("../orm/ArrivageDetail.php");
	require_once("../orm/LivraisonDetail.php");

	$ari_id	= isset ($_GET["ari_id"]) ? $_GET["ari_id"] : "undefined";
	$cfm_id	= isset ($_GET["cfm_id"]) ? $_GET["cfm_id"] : "undefined";
	$liv_id	= isset ($_GET["liv_id"]) ? $_GET["liv_id"] : "undefined";

	$Mesure = new Mesure();
	$ArrivageDetail = new ArrivageDetail();
	$LivraisonDetail = new LivraisonDetail();

	//Demande les mesures de conformite d'une conformité en particulière
	if($ari_id == "undefined" and $cfm_id != "undefined" and $liv_id == "undefined"){	
		$cond = array("CFM_ID" => $cfm_id);
		$res = $Mesure->getRows($cond);
	}
	//Demande les mesures de conformité d'un arrivage en particulier
	else if($ari_id != "undefined" and $cfm_id == "undefined" and $liv_id == "undefined"){	
		$cond = array("ARI_ID" => $ari_id);
		$resArrivage = $ArrivageDetail->getRows($cond);
		$res = [];
		foreach ($resArrivage as $value) {
			$cond = array("CFM_ID" => $value["cfm_id"]);
			$res += $Mesure->getRows($cond);
		}
	}
	//Demande les mesures de conformité d'une livraison en particulière
	else if($ari_id == "undefined" and $cfm_id == "undefined" and $liv_id != "undefined"){	
		$cond = array("LIV_ID" => $liv_id);
		$resLivraison = $LivraisonDetail->getRows($cond);
		$res = [];
		foreach ($resLivraison as $value) {
			$cond = array("CFM_ID" => $value["cfm_id"]);
			$res += $Mesure->getRows($cond);
		}
	}
	else{
		die("Param incorrect");
	}
	
	$i= 0;
	$o["mesures"] = "";

	foreach ($res as $value) {
		$o["mesures"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>