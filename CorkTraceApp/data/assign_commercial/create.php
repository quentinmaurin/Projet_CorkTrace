<?php

	require_once("../orm/AssignCommercial.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cli_id		= isset ($data->{'cli_id'}) ? $data->{'cli_id'} : "undefined";
	$com_id 	= isset ($data->{'com_id'}) ? $data->{'com_id'} : "undefined";

	if( $cli_id == "undefined" || $com_id == "undefined")
	{
		die("Valeurs manquantes");
	}
	
	$AssignCommercial = new AssignCommercial();
	$id = $AssignCommercial->insertRow('"NULL", "'.$cli_id.'","'.$com_id.'"');

	header('Content-Type: application/json');
	echo '{"success": true, "data" : { "clc_id" : '.$id.'}}';

?>