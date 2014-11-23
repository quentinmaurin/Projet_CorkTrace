<?php

	require_once("../orm/Livraison.php");
	require_once("../orm/LivraisonDetail.php");
	require_once("../orm/Conformite.php");
	require_once("../orm/Mesure.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$liv_id		= isset ($data->{'liv_id'}) ? $data->{'liv_id'} : "undefined";

	if( $liv_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Livraison = new Livraison();
	$LivraisonDetail = new LivraisonDetail();
	$Conformite = new Conformite();
	$Mesure = new Mesure();

	/*Supprime les conformités liées aux détails de la livraison à supprimer*/
	$res = $Livraison->getAllConformite($liv_id);
	foreach($res as $value){
		$cond = array('CFM_ID' => $value['cfm_id']);
		$Conformite->deleteRow($cond);
		$Mesure->deleteRow($cond);
	}

	$cond = array( 'LIV_ID' => $liv_id);

	$details = $LivraisonDetail->deleteRow($cond);
	$id = $Livraison->deleteRow($cond);

	echo $id;

?>