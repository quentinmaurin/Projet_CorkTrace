<?php

	require_once("../orm/AssignCommercial.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$clc_id		= isset ($data->{'clc_id'}) ? $data->{'clc_id'} : "undefined";

	if( $cla_id == "undefined")
	{
		die("Valeur manquante");
	}

	$AssignCommercial = new AssignCommercial();
	$cond = array('CLC_ID' => $clc_id);
	$id = $AssignCommercial->deleteRow($cond);

	echo $id;

?>