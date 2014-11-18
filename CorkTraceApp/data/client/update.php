<?php

	require_once("../orm/Client.php");

	//Vérif des données entrante
	$cli_id			= isset ($_POST['cli_id']) ? $_POST['cli_id'] : "undefined";
	$cli_nom		= isset ($_POST['cli_nom']) ? $_POST['cli_nom'] : "undefined";
	$cli_mail 		= isset ($_POST['cli_mail']) ? $_POST['cli_mail'] : "undefined";
	$cli_tel 		= isset ($_POST['cli_tel']) ? $_POST['cli_tel'] : "undefined";
	$cli_fax 		= isset ($_POST['cli_fax']) ? $_POST['cli_fax'] : "undefined";
	$cli_adr_fact 	= isset ($_POST['cli_adr_fact']) ? $_POST['cli_adr_fact'] : "undefined";
	$tyc_id 		= isset ($_POST['tyc_id']) ? $_POST['tyc_id'] : "undefined";

	/*$cli_id			= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";
	$cli_nom		= isset ($_GET['cli_nom']) ? $_GET['cli_nom'] : "undefined";
	$cli_mail 		= isset ($_GET['cli_mail']) ? $_GET['cli_mail'] : "undefined";
	$cli_tel 		= isset ($_GET['cli_tel']) ? $_GET['cli_tel'] : "undefined";
	$cli_fax 		= isset ($_GET['cli_fax']) ? $_GET['cli_fax'] : "undefined";
	$cli_adr_fact 	= isset ($_GET['cli_adr_fact']) ? $_GET['cli_adr_fact'] : "undefined";
	$tyc_id 		= isset ($_GET['tyc_id']) ? $_GET['tyc_id'] : "undefined";*/

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