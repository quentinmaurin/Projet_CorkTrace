<?php

	require_once("../orm/AssignAdress.php");
	require_once("../orm/Adress.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$cli_id		= isset ($data->{'cli_id'}) ? $data->{'cli_id'} : "undefined";
	$adr_adresse 	= isset ($data->{'adr_adresse'}) ? $data->{'adr_adresse'} : "undefined";

	if( $cli_id == "undefined" || $adr_adresse == "undefined")
	{
		die("Valeurs manquantes");
	}

	$Adress = new Adress();

	$cond = array('ADR_ADRESSE' => '"'.$adr_adresse.'"');
	$adress = $Adress->getRows($cond);

	$id_adress = 0;
	foreach ($adress as $value) {
		$id_adress = $value['adr_id'];
	}

	if($id_adress == 0){
		$id_adress = $Adress->insertRow('"NULL", "'.$adr_adresse.'"');
	}
	
	$AssignAdress = new AssignAdress();
	$id = $AssignAdress->insertRow('"NULL", "'.$cli_id.'","'.$id_adress.'"');

	header('Content-Type: application/json');
	echo '{"success": true, "data" : { "cla_id" : '.$id.', "adr_id" : '.$id_adress.'}}';

?>