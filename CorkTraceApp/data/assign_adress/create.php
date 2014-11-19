<?php

	require_once("../orm/AssignAdress.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cli_id		= isset ($data->{'cli_id'}) ? $data->{'cli_id'} : "undefined";
	$adr_id 	= isset ($data->{'adr_id'}) ? $data->{'adr_id'} : "undefined";

	if( $cli_id == "undefined" || $adr_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$AssignAdress = new AssignAdress();
	$id = $AssignAdress->insertRow('"NULL", "'.$cli_id.'","'.$adr_id.'"');

	//echo $id;

	header('Content-Type: application/json');
	echo '{"success": true, "data" : { "cla_id" : '.$id.'}}';

?>