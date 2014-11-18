<?php

	require_once("../orm/Client.php");

	//Vérif des données entrante
	$cli_nom		= isset ($_POST['cli_nom']) ? $_POST['cli_nom'] : "undefined";
	$cli_mail 		= isset ($_POST['cli_mail']) ? $_POST['cli_mail'] : "undefined";
	$cli_tel 		= isset ($_POST['cli_tel']) ? $_POST['cli_tel'] : "undefined";
	$cli_fax 		= isset ($_POST['cli_fax']) ? $_POST['cli_fax'] : "undefined";
	$cli_adr_fact 	= isset ($_POST['cli_adr_fact']) ? $_POST['cli_adr_fact'] : "undefined";
	$tyc_id 		= isset ($_POST['tyc_id']) ? $_POST['tyc_id'] : "undefined";

	/*$cli_nom		= isset ($_GET['cli_nom']) ? $_GET['cli_nom'] : "undefined";
	$cli_mail 		= isset ($_GET['cli_mail']) ? $_GET['cli_mail'] : "undefined";
	$cli_tel 		= isset ($_GET['cli_tel']) ? $_GET['cli_tel'] : "undefined";
	$cli_fax 		= isset ($_GET['cli_fax']) ? $_GET['cli_fax'] : "undefined";
	$cli_adr_fact 	= isset ($_GET['cli_adr_fact']) ? $_GET['cli_adr_fact'] : "undefined";
	$tyc_id 		= isset ($_GET['tyc_id']) ? $_GET['tyc_id'] : "undefined";*/

	echo $cli_nom	;
	echo '<br>';
	echo $cli_mail 	;echo '<br>';
	echo $cli_tel 	;echo '<br>';
	echo $cli_fax 	;echo '<br>';
	echo $cli_adr_fact;echo '<br>';
	echo $tyc_id ;

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

	echo $id;

?>