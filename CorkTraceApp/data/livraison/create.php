<?php

	require_once("../orm/Livraison.php");
	require_once("../orm/LivraisonDetail.php");
	require_once("../orm/CommandeClient.php");
	require_once("../orm/Conformite.php");
	require_once("../orm/Mesure.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$ccl_id				= isset ($data->{'ccl_id'}) ? $data->{'ccl_id'} : "undefined";
	$liv_responsable 	= isset ($data->{'liv_responsable'}) ? $data->{'liv_responsable'} : "undefined";
	$details 			= isset ($data->{'details'}) ? $data->{'details'} : "undefined";

	if( $ccl_id == "undefined" || $liv_responsable == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Livraison = new Livraison();
	$LivraisonDetail = new LivraisonDetail();
	$CommandeClient = new CommandeClient();
	$Conformite = new Conformite();
	$Mesure = new Mesure();

	$date = date('Y-m-d');

	$recep_id = $Livraison->insertRow(' "NULL", "'.$ccl_id.'", "'.$date.'", "'.$liv_responsable.'" ');

	foreach ($details as $detail) {
		$cfm_id = $Conformite->insertRow(' "NULL", "0", "0", "En attente", "En attente", "0", "0", "0" ');
		for($i=0; $i<8; $i++){
			$Mesure->insertRow(' "NULL", "0", "0", "0", "0", "0", "'.$cfm_id.'" ');
		}
		$LivraisonDetail->insertRow(' "NULL", "'.$recep_id.'", "'.$detail->{'ard_id'}.'", "'.$detail->{'lid_quantite'}.'", "'.$cfm_id.'", "'.$detail->{'ccd_prix'}.'", "'.$detail->{'ccd_marquage'}.'", "'.$detail->{'pro_id'}.'" ');
	}

	header('Content-Type: application/json');
	echo '{"success": true}';
?>