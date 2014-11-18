<?php

	require_once("../orm/Client.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cli_nom		= isset ($data->{'cli_nom'}) ? $data->{'cli_nom'} : "undefined";
	$cli_mail 		= isset ($data->{'cli_mail'}) ? $data->{'cli_mail'} : "undefined";
	$cli_tel 		= isset ($data->{'cli_tel'}) ? $data->{'cli_tel'} : "undefined";
	$cli_fax 		= isset ($data->{'cli_fax'}) ? $data->{'cli_fax'} : "undefined";
	$cli_adr_fact 	= isset ($data->{'cli_adr_fact'}) ? $data->{'cli_adr_fact'} : "undefined";
	$tyc_id 		= isset ($data->{'tyc_id'}) ? $data->{'tyc_id'} : "undefined";

	if( $cli_nom == "undefined" ||
		$cli_mail == "undefined" ||	
		$cli_tel == "undefined" ||		
		$cli_fax == "undefined" ||		
		$cli_adr_fact == "undefined" ||	
		$tyc_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Client = new Client();
	$id = $Client->insertRow('"NULL", "'.$cli_nom.'","'.$cli_mail.'", "'.$cli_tel.'", "'.$cli_fax.'", "'.$cli_adr_fact.'", "'.$tyc_id.'"');

	//echo $id;

	header('Content-Type: application/json');
	echo '{"success": true, "data" : { "cli_id" : '.$id.'}}';

?>