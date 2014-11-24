<?php

	require_once('valeurs_auto.php');
	
	$tab_arrivage = valeurs_arrivage(38);

	$tab_return["data"]["cfm_tca_fourni"] = $tab_arrivage[3];
	$tab_return["data"]["cfm_tca_inter"] = $tab_arrivage[4];
	$tab_return["data"]["cfm_gout"] = ($tab_arrivage[5])?"oui":"non";
	$tab_return["data"]["cfm_humidite"] = $tab_arrivage[1];
	$tab_return["data"]["cfm_diamcompr"] = $tab_arrivage[2];
	$tab_return["data"]["cfm_capilarite"] = 0;

	$detail = "";
	$i=0;
	$tab = $tab_arrivage[0];
	foreach( $tab_arrivage[0] as $value){

		$detail["mes_longueur"]= $value[0];
		$detail["mes_diam"]  = $value[1];
		$detail["mes_oval"]  = $value[2];

		$tab_return["details"][$i] = $detail;
		$i++;

	}

	echo (json_encode($tab_return));

?>