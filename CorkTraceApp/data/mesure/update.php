<?php

	require_once("../orm/Mesure.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$mes_id			= isset ($data->{'mes_id'}) ? $data->{'mes_id'} : "undefined";
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

	$cond = array('MES_ID' => $mes_id);

	$newValue = array(	'MES_LONGUEUR' 	=>  '"'.$mes_longueur.'"',
						'MES_DIAM'		=>	'"'.$mes_diam.'"',
						'MES_OVAL'		=>	'"'.$mes_oval.'"',
						'CFM_ID'		=>	'"'.$cfm_id.'"'
	);


	$Mesure->updateRow($newValue, $cond);
?>