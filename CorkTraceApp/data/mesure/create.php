<?php

	require_once("../orm/Mesure.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$mes_longueur	= isset ($data->{'mes_longueur'}) ? $data->{'mes_longueur'} : "undefined";
	$mes_diam 		= isset ($data->{'mes_diam'}) ? $data->{'mes_diam'} : "undefined";
	$mes_oval 		= isset ($data->{'mes_oval'}) ? $data->{'mes_oval'} : "undefined";
	$cfm_id			= isset ($data->{'cfm_id'}) ? $data->{'cfm_id'} : "undefined";

	if( $mes_longueur == "undefined" ||
		$mes_diam  == "undefined" ||	
		$mes_oval == "undefined" ||		
		$cfm_id	 == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Mesure= new Mesure();
	$id = $Mesure->insertRow('"NULL", "'.$mes_longueur.'","'.$mes_diam.'", "'.$mes_oval.'", "'.$cfm_id.'"');

	//echo $id;

	header('Content-Type: application/json');
	echo '{"success": true, "data" : { "mes_id" : '.$id.'}}';

?>