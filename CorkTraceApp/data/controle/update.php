<?php

	require_once("../orm/Conformite.php");
	require_once("../orm/Mesure.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cfm_id	= isset ($data->{'cfm_id'}) ? $data->{'cfm_id'} : "undefined";
	$cfm_tca_fourni	= isset ($data->{'cfm_tca_fourni'}) ? $data->{'cfm_tca_fourni'} : "undefined";
	$cfm_tca_inter	= isset ($data->{'cfm_tca_inter'}) ? $data->{'cfm_tca_inter'} : "undefined";
	$cfm_gout 		= isset ($data->{'cfm_gout'}) ? $data->{'cfm_gout'} : "undefined";
	$cfm_capilarite = isset ($data->{'cfm_capilarite'}) ? $data->{'cfm_capilarite'} : "undefined";
	$cfm_humidite 	= isset ($data->{'cfm_humidite'}) ? $data->{'cfm_humidite'} : "undefined";
	$cfm_diamcompr 	= isset ($data->{'cfm_diamcompr'}) ? $data->{'cfm_diamcompr'} : "undefined";
	$cfm_decision 	= isset ($data->{'cfm_decision'}) ? $data->{'cfm_decision'} : "undefined";
	$details 		= isset ($data->{'details'}) ? $data->{'details'} : "undefined";
	
	/*
	echo $cfm_id."<br>";
	echo "fourni : ".$cfm_tca_fourni."<br>";
	echo "inter : ".$cfm_tca_inter."<br>";
	echo "gout : ".$cfm_gout."<br>";
	echo "capilarite : ".$cfm_capilarite."<br>";
	echo "humidite : ".$cfm_humidite."<br>";
	echo "diam compr : ".$cfm_diamcompr."<br>";
	echo "deicsion : ".$cfm_decision."<br>";
	*/

	if( $cfm_id == "undefined" ||
		$cfm_tca_fourni == "undefined" ||
		$cfm_tca_inter == "undefined" ||
		$cfm_gout == "undefined" ||	
		$cfm_capilarite == "undefined" ||		
		$cfm_humidite == "undefined" ||		
		$cfm_diamcompr == "undefined" ||
		$cfm_decision == "undefined"
	)
	{
		die("Valeurs manquantes");
	}

	$Conformite = new Conformite();
	$cond = array('CFM_ID' => $cfm_id);
	$newValue = array(
		'CFM_TCA_FOURNI' 	=>  '"'.$cfm_tca_fourni.'"',
		'CFM_TCA_INTER'		=>	'"'.$cfm_tca_inter.'"',
		'CFM_GOUT'			=>	'"'.$cfm_gout.'"',
		'CFM_CAPILARITE'	=>	'"'.$cfm_capilarite.'"',
		'CFM_HUMIDITE'		=>	'"'.$cfm_humidite.'"',
		'CFM_DIAMCOMPR'	=>	'"'.$cfm_diamcompr.'"',
		'CFM_DECISION'		=>	'"'.$cfm_decision.'"'
	);
	$Conformite->updateRow($newValue, $cond);

	$Mesure = new Mesure();
	foreach ($details as $detail) {

		$cond = array('MES_ID' => $detail->{'mes_id'});
		$newValue = array(
			'MES_LONGUEUR'		=>	'"'.$detail->{'mes_longueur'}.'"',
			'MES_DIAM'			=>	'"'.$detail->{'mes_diam'}.'"',
			'MES_OVAL'	=>	'"'.$detail->{'mes_oval'}.'"'
		);

		$Mesure->updateRow($newValue, $cond);
	}

	echo '{ "success": true}';
?>