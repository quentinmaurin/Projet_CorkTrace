<?php

	require_once("../orm/Livraison.php");
	require_once("../orm/LivraisonDetail.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$liv_id		= isset ($data->{'liv_id'}) ? $data->{'liv_id'} : "undefined";

	if( $liv_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Livraison = new Livraison();
	$LivraisonDetail = new LivraisonDetail();

	$cond = array( 'LIV_ID' => $liv_id);

	$details = $LivraisonDetail->deleteRow($cond);
	$id = $Livraison->deleteRow($cond);

	echo $id;

?>