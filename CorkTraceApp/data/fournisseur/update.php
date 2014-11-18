<?php

	require_once("../orm/Fournisseur.php");

	//Vérif des données entrante
	$fou_id			= isset ($_POST['fou_id']) ? $_POST['fou_id'] : "undefined";
	$fou_nom		= isset ($_POST['fou_nom']) ? $_POST['fou_nom'] : "undefined";
	$fou_adresse 	= isset ($_POST['fou_adresse']) ? $_POST['fou_adresse'] : "undefined";
	$fou_mail 		= isset ($_POST['fou_mail']) ? $_POST['fou_mail'] : "undefined";
	$fou_tel 		= isset ($_POST['fou_tel']) ? $_POST['fou_tel'] : "undefined";
	$fou_fax 		= isset ($_POST['fou_fax']) ? $_POST['fou_fax'] : "undefined";
	$tyf_id 		= isset ($_POST['tyf_id']) ? $_POST['tyf_id'] : "undefined";

	/*
	$fou_id			= isset ($_GET['fou_id']) ? $_GET['fou_id'] : "undefined";
	$fou_nom		= isset ($_GET['fou_nom']) ? $_GET['fou_nom'] : "undefined";
	$fou_adresse 	= isset ($_GET['fou_adresse']) ? $_GET['fou_adresse'] : "undefined";
	$fou_mail 		= isset ($_GET['fou_mail']) ? $_GET['fou_mail'] : "undefined";
	$fou_tel 		= isset ($_GET['fou_tel']) ? $_GET['fou_tel'] : "undefined";
	$fou_fax 		= isset ($_GET['fou_fax']) ? $_GET['fou_fax'] : "undefined";
	$tyf_id 		= isset ($_GET['tyf_id']) ? $_GET['tyf_id'] : "undefined";
	*/

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