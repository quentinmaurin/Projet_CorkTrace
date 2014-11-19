<?php

	require_once("../orm/Conformite.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cfm_tca_fourni	= isset ($data->{'cfm_tca_fourni'}) ? $data->{'cfm_tca_fourni'} : "undefined";
	$cfm_tca_inter 	= isset ($data->{'cfm_tca_inter'}) ? $data->{'cfm_tca_inter'} : "undefined";
	$cfm_gout		= isset ($data->{'cfm_gout'}) ? $data->{'cfm_gout'} : "undefined";
	$cfm_decision	= isset ($data->{'cfm_decision'}) ? $data->{'cfm_decision'} : "undefined";
	$cfm_capilarite	= isset ($data->{'cfm_capilarite'}) ? $data->{'cfm_capilarite'} : "undefined";
	$cfm_humidite	= isset ($data->{'cfm_humidite'}) ? $data->{'cfm_humidite'} : "undefined";
	$cfm_diamcompr	= isset ($data->{'cfm_diamcompr'}) ? $data->{'cfm_diamcompr'} : "undefined";


	if( $cfm_tca_fourni == "undefined" ||
		$cfm_tca_inter  == "undefined" ||	
		$cfm_gout == "undefined" ||		
		$cfm_decision == "undefined" ||
		$cfm_capilarite == "undefined" ||
		$cfm_humidite == "undefined" ||
		$cfm_diamcompr == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Conformite= new Conformite();
	$id = $Conformite->insertRow('"NULL", "'.$cfm_tca_fourni.'","'.$cfm_tca_inter.'", "'.$cfm_gout.'", "'.$cfm_decision.'", "'.$cfm_capilarite.'", "'.$cfm_humidite.'", "'.$cfm_diamcompr.'"');

	//echo $id;

	header('Content-Type: application/json');
	echo '{"success": true, "data" : { "cfm_id" : '.$id.'}}';

?>