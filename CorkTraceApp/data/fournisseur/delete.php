<?php

	require_once("../orm/Fournisseur.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$fou_id	= isset ($data->{'fou_id'}) ? $data->{'fou_id'} : "undefined";

	/*$fou_id	= isset ($_GET['fou_id']) ? $_GET['fou_id'] : "undefined";*/

	if( $fou_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Fournisseur = new Fournisseur();
	$cond = array('FOU_ID' => $fou_id);
	$id = $Fournisseur->deleteRow($cond);

	echo $id;

?>