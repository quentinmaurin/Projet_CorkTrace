<?php

	require_once("../orm/Arrivage.php");
	require_once("../orm/ArrivageDetail.php");
	require_once("../orm/Conformite.php");
	require_once("../orm/CommandeFournisseur.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$ari_id		= isset ($data->{'ari_id'}) ? $data->{'ari_id'} : "undefined";

	if( $ari_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Arrivage = new Arrivage();
	$ArrivageDetail = new ArrivageDetail();
	$Conformite = new Conformite();
	$CommandeFournisseur = new CommandeFournisseur();

	/*Supprime les conformités liées aux détails de l'arrivage à supprimer*/
	$res = $Arrivage->getAllConformite($ari_id);
	foreach($res as $value){
		$cond = array('CFM_ID' => $value['cfm_id']);
		$id = $Conformite->deleteRow($cond);
	}

	$cond = array( "ARI_ID" => $ari_id);

	///Mettre a jour la commande fournisseur (lien commande/arrivage)
	$newValue = array( "ARI_ID" => '-1');	
	$CommandeFournisseur->updateRow($newValue, $cond);
	
	$id = $ArrivageDetail->deleteRow($cond);
	$id = $Arrivage->deleteRow($cond);
?>