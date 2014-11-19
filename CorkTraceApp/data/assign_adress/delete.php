<?php

	require_once("../orm/AssignAdress.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cla_id		= isset ($data->{'cla_id'}) ? $data->{'cla_id'} : "undefined";

	/*$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";*/

	if( $cla_id == "undefined")
	{
		die("Valeur manquante");
	}

	$AssignAdress = new AssignAdress();
	$cond = array('CLA_ID' => $cla_id);
	$id = $AssignAdress->deleteRow($cond);

	echo $id;

?>