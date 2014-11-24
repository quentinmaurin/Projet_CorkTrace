<?php

	require_once('valeurs_auto.php');

	$data = json_decode($_POST['data']);
	$hauteur = isset ($data->{'hauteur'}) ? $data->{'hauteur'} : "undefined";

	if( $hauteur == "undefined" ){

		die("Valeurs manquantes");
	}

	$tab_livraison = valeurs_commande($hauteur);

	$tab_return["data"]["cfm_tca_fourni"] = $tab_livraison[3];
	$tab_return["data"]["cfm_capilarite"] = $tab_livraison[4];
	$tab_return["data"]["cfm_gout"] = ($tab_livraison[5])?"oui":"non";
	$tab_return["data"]["cfm_humidite"] = $tab_livraison[1];
	$tab_return["data"]["cfm_diamcompr"] = $tab_livraison[2];
	$tab_return["data"]["cfm_tca_inter"] = 0;

	$detail = "";
	$i=0;
	$tab = $tab_livraison[0];
	foreach( $tab_livraison[0] as $value){

		$detail["mes_longueur"]= $value[0];
		$detail["mes_diam"]  = $value[1];
		$detail["mes_diam2"]  = $value[2];

		$tab_return["details"][$i] = $detail;
		$i++;

	}

	echo (json_encode($tab_return));

?>