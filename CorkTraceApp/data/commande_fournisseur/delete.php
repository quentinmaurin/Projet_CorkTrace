<?php

	require_once("../orm/CommandeFournisseur.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cfo_id		= isset ($data->{'cfo_id'}) ? $data->{'cfo_id'} : "undefined";

	/*$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";*/

	if( $cfo_id == "undefined")
	{
		die("Valeur manquante");
	}

	$CommandeFournisseur = new CommandeFournisseur();
	$cond = array('CFO_ID' => $cfo_id);
	$id = $CommandeFournisseur->deleteRow($cond);

	echo $id;

?>