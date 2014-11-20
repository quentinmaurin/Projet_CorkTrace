<?php

	require_once("../orm/Arrivage.php");
	require_once("../orm/ArrivageDetail.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$ari_id		= isset ($data->{'ari_id'}) ? $data->{'ari_id'} : "undefined";

	/*$cli_id	= isset ($_GET['cli_id']) ? $_GET['cli_id'] : "undefined";*/

	if( $ari_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Arrivage = new Arrivage();
	$ArrivageDetail = new ArrivageDetail();

	$cond = array('ARI_ID' => $ari_id);
	
	$id = $ArrivageDetail->deleteRow($cond);
	$id = $Arrivage->deleteRow($cond);

	echo $id;

?>