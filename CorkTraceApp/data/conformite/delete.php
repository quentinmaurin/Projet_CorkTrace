<?php

	require_once("../orm/Conformite.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cfm_id		= isset ($data->{'cfm_id'}) ? $data->{'cfm_id'} : "undefined";

	if( $cfm_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Conformite = new Conformite();
	$cond = array('CFM_ID' => $cfm_id);
	$id = $Conformite->deleteRow($cond);

	echo $id;

?>