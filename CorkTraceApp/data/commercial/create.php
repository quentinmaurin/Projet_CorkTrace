<?php

	require_once("../orm/Commercial.php");

	//Vérif des données entrante
	
	
	$com_nom		= isset ($_POST['com_nom']) ? $_POST['com_nom'] : "undefined";
	$com_prenom		= isset ($_POST['com_prenom']) ? $_POST['com_prenom'] : "undefined";
	$com_adresse 	= isset ($_POST['com_adresse']) ? $_POST['com_adresse'] : "undefined";
	$com_mail 		= isset ($_POST['com_mail']) ? $_POST['com_mail'] : "undefined";
	$com_tel 		= isset ($_POST['com_tel']) ? $_POST['com_tel'] : "undefined";
	$com_fax 		= isset ($_POST['com_fax']) ? $_POST['com_fax'] : "undefined";

	/*$com_nom		= isset ($_GET['com_nom']) ? $_GET['com_nom'] : "undefined";
	$com_prenom		= isset ($_GET['com_prenom']) ? $_GET['com_prenom'] : "undefined";
	$com_adresse 	= isset ($_GET['com_adresse']) ? $_GET['com_adresse'] : "undefined";
	$com_mail 		= isset ($_GET['com_mail']) ? $_GET['com_mail'] : "undefined";
	$com_tel 		= isset ($_GET['com_tel']) ? $_GET['com_tel'] : "undefined";
	$com_fax 		= isset ($_GET['com_fax']) ? $_GET['com_fax'] : "undefined";*/

	echo "coucou".$com_nom." ".$com_prenom	;
	echo '<br>';
	echo $com_adresse;echo '<br>';
	echo $com_mail 	;echo '<br>';
	echo $com_tel 	;echo '<br>';
	echo $com_fax 	;echo '<br>';
	

	if( $com_nom == "undefined" ||
		$com_prenom == "undefined" ||
		$com_adresse == "undefined" ||		
		$com_mail == "undefined" ||	
		$com_tel == "undefined" ||		
		$com_fax == "undefined" )
	{
		die("Valeurs manquantes");
	}

	$Commercial = new Commercial();
	$id = $Commercial->insertRow('"NULL", "'.$com_nom.'","'.$com_prenom.'", "'.$com_adresse.'", "'.$com_mail.'", "'.$com_tel.'", "'.$com_fax.'"');

	echo $id;

?>