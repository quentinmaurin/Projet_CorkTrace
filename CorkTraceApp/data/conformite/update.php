<?php

	require_once("../orm/Conformite.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cfm_id			= isset ($data->{'cfm_id'}) ? $data->{'cfm_id'} : "undefined";
	$cfm_tca_fourni	= isset ($data->{'cfm_tca_fourni'}) ? $data->{'cfm_tca_fourni'} : "undefined";
	$cfm_tca_inter 	= isset ($data->{'cfm_tca_inter'}) ? $data->{'cfm_tca_inter'} : "undefined";
	$cfm_gout		= isset ($data->{'cfm_gout'}) ? $data->{'cfm_gout'} : "undefined";
	$cfm_decision	= isset ($data->{'cfm_decision'}) ? $data->{'cfm_decision'} : "undefined";
	$cfm_capilarite	= isset ($data->{'cfm_capilarite'}) ? $data->{'cfm_capilarite'} : "undefined";
	$cfm_humidite	= isset ($data->{'cfm_humidite'}) ? $data->{'cfm_humidite'} : "undefined";
	$cfm_diamcompr	= isset ($data->{'cfm_diamcompr'}) ? $data->{'cfm_diamcompr'} : "undefined";


	if( $cfm_id == "undefined" ||
		$cfm_tca_fourni == "undefined" ||
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

	$cond = array('CFM_ID' => $cfm_id);

	$newValue = array(	'CFM_TCA_FOURNI' 	=>  '"'.$cfm_tca_fourni.'"',
						'CFM_TCA_INTER'		=>	'"'.$cfm_tca_inter.'"',
						'CFM_GOUT'			=>	'"'.$cfm_gout.'"',
						'CFM_DECISION'		=>	'"'.$cfm_decision.'"',
						'CFM_CAPILARITE'	=>	'"'.$cfm_capilarite.'"',
						'CFM_HUMIDITE'		=>	'"'.$cfm_humidite.'"',
						'CFM_DIAMCOMPR'		=>	'"'.$cfm_diamcompr.'"'
	);

	$Conformite->updateRow($newValue, $cond);
?>