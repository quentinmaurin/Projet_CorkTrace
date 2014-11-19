<?php

	require_once("../orm/Mesure.php");

	$Mesure = new Mesure();
	$res = $Mesure->getRows(array('CFM_ID'=> $_GET['cfm_id']));
	
	$i= 0;
	$o["mesures"] = "";

	foreach ($res as $value) {
		$o["mesures"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>