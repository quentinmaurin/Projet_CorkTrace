<?php

	require_once("../orm/Conformite.php");

	$Conformite = new Conformite();
	$res = $Conformite->getRows(array('CFM_ID'=> $_GET['cfm_id']));
	
	$i= 0;
	$o["conformite"] = "";

	foreach ($res as $value) {
		$o["conformite"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>