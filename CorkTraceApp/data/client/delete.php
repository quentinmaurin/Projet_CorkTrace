<?php

	require_once("../orm/Client.php");

	//Vérif des données entrante
	$cli_id	= isset ($_POST['cli_id']) ? $_POST['cli_id'] : "undefined";

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