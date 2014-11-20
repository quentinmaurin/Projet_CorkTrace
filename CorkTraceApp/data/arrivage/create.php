<?php

	require_once("../orm/Arrivage.php");
	require_once("../orm/ArrivageDetail.php");
	require_once("../orm/CommandeFournisseur.php");


	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cfo_id				= isset ($data->{'cfo_id'}) ? $data->{'cfo_id'} : "undefined";
	$ari_responsable 	= isset ($data->{'ari_responsable'}) ? $data->{'ari_responsable'} : "undefined";
	$details 			= isset ($data->{'details'}) ? $data->{'details'} : "undefined";

	if( $cfo_id == "undefined" || $ari_responsable == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Arrivage = new Arrivage();
	$ArrivageDetail = new ArrivageDetail();
	$CommandeFournisseur = new CommandeFournisseur();

	$date = date('Y-m-d');

	$recep_id = $Arrivage->insertRow("'NULL', '0', '".$date."', '".$ari_responsable."'");
	
	$newValue = array( "ARI_NUM_ARRIVAGE" => date('Y').$recep_id);
	$cond = array( "ARI_ID" => $recep_id);
	$Arrivage->updateRow($newValue, $cond);

	$newValue = array( "ARI_ID" => $recep_id);
	$cond = array( "CFO_ID" => $cfo_id);
	$CommandeFournisseur->updateRow($newValue, $cond);

	foreach ($details as $detail) {
		//$ArrivageDetail->insertRow("'NULL', ".$recep_id.", ".$detail->{'pro_id'}.", ".$detail->{'cfm_id'}.", ".$detail->{'ard_quantite'});
		$ArrivageDetail->insertRow("'NULL', ".$recep_id.", ".$detail->{'pro_id'}.", '1', ".$detail->{'ard_quantite'});
	}

	header('Content-Type: application/json');
	echo '{"success": true}';
?>