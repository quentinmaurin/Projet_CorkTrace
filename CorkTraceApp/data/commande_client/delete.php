<?php

	require_once("../orm/CommandeClient.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$ccl_id		= isset ($data->{'ccl_id'}) ? $data->{'ccl_id'} : "undefined";

	/*$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";*/

	if( $ccl_id == "undefined")
	{
		die("Valeur manquante");
	}

	$CommandeClient = new CommandeClient();
	$cond = array('CCL_ID' => $ccl_id);
	$id = $CommandeClient->deleteRow($cond);

	echo $id;

?>