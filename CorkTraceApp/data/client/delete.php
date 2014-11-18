<?php

	require_once("../orm/Client.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cli_id		= isset ($data->{'cli_id'}) ? $data->{'cli_id'} : "undefined";

	/*$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";*/

	if( $cli_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Client = new Client();
	$cond = array('CLI_ID' => $cli_id);
	$id = $Client->deleteRow($cond);

	echo $id;

?>