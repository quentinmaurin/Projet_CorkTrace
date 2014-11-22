<?php

	require_once("../orm/CommandeFournisseur.php");
	require_once("../orm/CommandeFournisseurDetail.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$fou_id			= isset ($data->{'fou_id'}) ? $data->{'fou_id'} : "undefined";
	$cfo_datecmd 	= isset ($data->{'cfo_datecmd'}) ? $data->{'cfo_datecmd'} : "undefined";
	$details 		= isset ($data->{'details'}) ? $data->{'details'} : "undefined";

	if( $fou_id == "undefined" ||
		$cfo_datecmd == "undefined" ||	
		$details == "undefined")
	{
		die("Valeurs manquantes");
	}

	$CommandeFournisseur = new CommandeFournisseur();
	$CommandeFournisseurDetail = new CommandeFournisseurDetail();

	$dateRecep = date_create($cfo_datecmd);
	$dateRecep = date_format($dateRecep, 'Y-m-d');

	$dateCommande = date('Y-m-d');

	$com_id = $CommandeFournisseur->insertRow("'NULL', '".$dateCommande."', '".$dateRecep."', '".$fou_id."', -1 ");

	foreach ($details as $detail) {
		$CommandeFournisseurDetail->insertRow("'NULL', ".$com_id.", ".$detail->{'pro_id'}.", ".$detail->{'cfd_quantite'}.", ".$detail->{'cfd_prix'});
	}

	header('Content-Type: application/json');
	echo '{"success": true}';
?>