<?php

	require_once("../orm/Mesure.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$mes_id		= isset ($data->{'mes_id'}) ? $data->{'mes_id'} : "undefined";

	if( $mes_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Mesure = new Mesure();
	$cond = array('MES_ID' => $mes_id);
	$id = $Mesure->deleteRow($cond);

	echo $id;

?>