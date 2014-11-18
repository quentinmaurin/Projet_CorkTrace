<?php

	require_once("../orm/Fournisseur.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$fou_id			= isset ($data->{'fou_id'}) ? $data->{'fou_id'} : "undefined";
	$fou_nom		= isset ($data->{'fou_nom'}) ? $data->{'fou_nom'} : "undefined";
	$fou_adresse 	= isset ($data->{'fou_adresse'}) ? $data->{'fou_adresse'} : "undefined";
	$fou_mail 		= isset ($data->{'fou_mail'}) ? $data->{'fou_mail'} : "undefined";
	$fou_tel 		= isset ($data->{'fou_tel'}) ? $data->{'fou_tel'} : "undefined";
	$fou_fax 		= isset ($data->{'fou_fax'}) ? $data->{'fou_fax'} : "undefined";
	$tyf_id 		= isset ($data->{'tyf_id'}) ? $data->{'tyf_id'} : "undefined";

	if( $fou_nom	 == "undefined" ||
		$fou_adresse == "undefined" ||	
		$fou_mail 	 == "undefined" ||		
		$fou_tel 	 == "undefined" ||		
		$fou_fax 	 == "undefined" ||	
		$tyf_id 	 == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Fournisseur = new Fournisseur();
	$id = $Fournisseur->insertRow('"NULL", "'.$fou_nom.'","'.$fou_adresse.'", "'.$fou_mail.'", "'.$fou_tel.'", "'.$fou_fax.'", "'.$tyf_id.'"');

	//echo $id;

	header('Content-Type: application/json');
	echo '{"success": true, "data" : { "fou_id" : '.$id.'}}';

?>