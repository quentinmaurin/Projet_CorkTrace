<?php

	require_once("../orm/Commercial.php");
	
	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$com_id	= isset ($data->{'com_nom'}) ? $data->{'com_nom'} : "undefined";


	if( $com_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Commercial = new Commercial();
	$cond = array('COM_ID' => $com_id);
	$id = $Commercial->deleteRow($cond);

	echo $id;

?>