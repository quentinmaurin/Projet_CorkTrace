<?php

	require_once("../orm/Arrivage.php");
	require_once("../orm/ArrivageDetail.php");
	require_once("../orm/CommandeFournisseur.php");
	require_once("../orm/Conformite.php");
	require_once("../orm/Mesure.php");

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
	$Conformite = new Conformite();
	$Mesure = new Mesure();

	$date = date('Y-m-d');

	$recep_id = $Arrivage->insertRow("'NULL', '0', '".$date."', '".$ari_responsable."'");

	$newValue = array( "ARI_ID" => $recep_id);
	$cond = array( "CFO_ID" => $cfo_id);
	$CommandeFournisseur->updateRow($newValue, $cond);

	foreach ($details as $detail) {
		$cfm_id = $Conformite->insertRow("'NULL', '0', '0', 'En attente', 'En attente', '0', '0', '0'");
		for($i=0; $i<16; $i++){
			$Mesure->insertRow(" 'NULL', '0', '0', '0', '0', '".$cfm_id."' ");
		}
		$ArrivageDetail->insertRow("'NULL', ".$recep_id.", ".$detail->{'pro_id'}.", '".$cfm_id."', ".$detail->{'ard_quantite'});
	}

	header('Content-Type: application/json');
	echo '{"success": true}';
?>