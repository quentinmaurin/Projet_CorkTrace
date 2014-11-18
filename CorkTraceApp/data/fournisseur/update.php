<?php

	require_once("../orm/Fournisseur.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$fou_id			= isset ($data->{'fou_id'}) ? $data->{'fou_id'} : "undefined";
	$fou_nom		= isset ($data->{'fou_nom'}) ? $data->{'fou_nom'} : "undefined";
	$fou_adresse 	= isset ($data->{'fou_adresse'}) ? $data->{'fou_adresse'} : "undefined";
	$fou_mail 		= isset ($data->{'fou_mail'}) ? $data->{'fou_mail'} : "undefined";
	$fou_tel 		= isset ($data->{'fou_tel'}) ? $data->{'fou_tel'} : "undefined";
	$fou_fax 		= isset ($data->{'fou_fax'}) ? $data->{'fou_fax'} : "undefined";
	$tyf_id 		= isset ($data->{'tyf_id'}) ? $data->{'tyf_id'} : "undefined";

	if( $fou_id		 	== "undefined" ||
		$fou_nom	  	== "undefined" ||
		$fou_adresse	== "undefined" ||	
		$fou_mail 	  	== "undefined" ||		
		$fou_tel 	  	== "undefined" ||		
		$fou_fax 		== "undefined" ||	
		$tyf_id 		== "undefined")
	{
		die("Valeurs manquantes");
	}

	$Fournisseur = new Fournisseur();

	$cond = array('FOU_ID' => $fou_id);

	$newValue = array(	'FOU_NOM' 		=>  '"'.$fou_nom.'"',
						'FOU_ADRESSE'	=>	'"'.$fou_adresse.'"',
						'FOU_MAIL'		=>	'"'.$fou_mail.'"',
						'FOU_TEL'		=>	'"'.$fou_tel.'"',
						'FOU_FAX'		=>	'"'.$fou_fax.'"',
						'TYF_ID'		=>	'"'.$tyf_id.'"'
	);


	$Fournisseur->updateRow($newValue, $cond);
?>