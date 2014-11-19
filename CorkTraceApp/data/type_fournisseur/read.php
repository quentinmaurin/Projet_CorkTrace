<?php

	require_once("../orm/TypeFourni.php");

	$TypeFourni = new TypeFourni();
	$res = $TypeFourni->getAll();
	
	$i= 0;
	$o["type_fournisseurs"] = "";

	foreach ($res as $value) {
		$o["type_fournisseurs"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>