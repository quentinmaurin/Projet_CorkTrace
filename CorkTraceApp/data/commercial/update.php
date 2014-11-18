<?php

	require_once("../orm/Commercial.php");
	
	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$com_id			= isset ($data->{'com_id'}) ? $data->{'com_id'} : "undefined";
	$com_nom		= isset ($data->{'com_nom'}) ? $data->{'com_nom'} : "undefined";
	$com_prenom		= isset ($data->{'com_prenom'}) ? $data->{'com_prenom'} : "undefined";
	$com_adresse 	= isset ($data->{'com_adresse'}) ? $data->{'com_adresse'} : "undefined";
	$com_mail 		= isset ($data->{'com_mail'}) ? $data->{'com_mail'} : "undefined";
	$com_tel 		= isset ($data->{'com_tel'}) ? $data->{'com_tel'} : "undefined";
	$com_fax 		= isset ($data->{'com_fax'}) ? $data->{'com_fax'} : "undefined";


	if( $com_id == "undefined" ||
		$com_nom == "undefined" ||
		$com_prenom == "undefined" ||
		$com_adresse == "undefined" ||		
		$com_mail == "undefined" ||	
		$com_tel == "undefined" ||		
		$com_fax == "undefined" )
	{
		die("Valeurs manquantes");
	}

	$Commercial = new Commercial();

	$cond = array('COM_ID' => $com_id);

	$newValue = array(	'COM_NOM' 		=>  '"'.$com_nom.'"',
						'COM_PRENOM' 	=>  '"'.$com_prenom.'"',
						'COM_ADRESSE'	=>	'"'.$com_adresse.'"',
						'COM_MAIL'		=>	'"'.$com_mail.'"',
						'COM_TEL'		=>	'"'.$com_tel.'"',
						'COM_FAX'		=>	'"'.$com_fax.'"'
	);


	$Commercial->updateRow($newValue, $cond);
?>