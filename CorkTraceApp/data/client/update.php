<?php

	require_once("../orm/Client.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cli_id			= isset ($data->{'cli_id'}) ? $data->{'cli_id'} : "undefined";
	$cli_nom		= isset ($data->{'cli_nom'}) ? $data->{'cli_nom'} : "undefined";
	$cli_mail 		= isset ($data->{'cli_mail'}) ? $data->{'cli_mail'} : "undefined";
	$cli_tel 		= isset ($data->{'cli_tel'}) ? $data->{'cli_tel'} : "undefined";
	$cli_fax 		= isset ($data->{'cli_fax'}) ? $data->{'cli_fax'} : "undefined";
	$cli_adr_fact 	= isset ($data->{'cli_adr_fact'}) ? $data->{'cli_adr_fact'} : "undefined";
	$tyc_id 		= isset ($data->{'tyc_id'}) ? $data->{'tyc_id'} : "undefined";

	if( $cli_id == "undefined" ||
		$cli_nom == "undefined" ||
		$cli_mail == "undefined" ||	
		$cli_tel == "undefined" ||		
		$cli_fax == "undefined" ||		
		$cli_adr_fact == "undefined" ||	
		$tyc_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Client = new Client();

	$cond = array('CLI_ID' => $cli_id);

	$newValue = array(	'CLI_NOM' 		=>  '"'.$cli_nom.'"',
						'CLI_MAIL'		=>	'"'.$cli_mail.'"',
						'CLI_TEL'		=>	'"'.$cli_tel.'"',
						'CLI_FAX'		=>	'"'.$cli_fax.'"',
						'CLI_ADR_FACT'	=>	'"'.$cli_adr_fact.'"',
						'TYC_ID'		=>	'"'.$tyc_id.'"'
	);


	$Client->updateRow($newValue, $cond);
?>