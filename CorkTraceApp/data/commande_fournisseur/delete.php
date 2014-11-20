<?php

	require_once("../orm/CommandeFournisseur.php");
	require_once("../orm/CommandeFournisseurDetail.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cfo_id		= isset ($data->{'cfo_id'}) ? $data->{'cfo_id'} : "undefined";

	/*$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";*/

	if( $cfo_id == "undefined")
	{
		die("Valeur manquante");
	}

	$CommandeFournisseur = new CommandeFournisseur();
	$CommandeFournisseurDetail = new CommandeFournisseurDetail();

	$cond = array( 'CFO_ID' => $cfo_id);

	$details = $CommandeFournisseurDetail->deleteRow($cond);
	$id = $CommandeFournisseur->deleteRow($cond);

	echo $id;

?>