<?php

	require_once("../orm/Commercial.php");

	//Vérif des données entrante
	$com_id			= isset ($_POST['com_id']) ? $_POST['com_id'] : "undefined";
	$com_nom		= isset ($_POST['com_nom']) ? $_POST['com_nom'] : "undefined";
	$com_prenom		= isset ($_POST['com_prenom']) ? $_POST['com_prenom'] : "undefined";
	$com_adresse 	= isset ($_POST['com_adresse']) ? $_POST['com_adresse'] : "undefined";
	$com_mail 		= isset ($_POST['com_mail']) ? $_POST['com_mail'] : "undefined";
	$com_tel 		= isset ($_POST['com_tel']) ? $_POST['com_tel'] : "undefined";
	$com_fax 		= isset ($_POST['com_fax']) ? $_POST['com_fax'] : "undefined";

	/*$com_id			= isset ($_GET['com_id']) ? $_GET['com_id'] : "undefined";
	$com_nom		= isset ($_GET['com_nom']) ? $_GET['com_nom'] : "undefined";
	$com_prenom		= isset ($_GET['com_prenom']) ? $_GET['com_prenom'] : "undefined";
	$com_adresse 	= isset ($_GET['com_adresse']) ? $_GET['com_adresse'] : "undefined";
	$com_mail 		= isset ($_GET['com_mail']) ? $_GET['com_mail'] : "undefined";
	$com_tel 		= isset ($_GET['com_tel']) ? $_GET['com_tel'] : "undefined";
	$com_fax 		= isset ($_GET['com_fax']) ? $_GET['com_fax'] : "undefined";*/

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