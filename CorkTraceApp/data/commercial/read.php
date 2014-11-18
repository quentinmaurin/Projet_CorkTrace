<?php

	require_once("../orm/Commercial.php");
	
	$Commercial = new Commercial();
	$res = $Commercial->getAll();
	
	$i= 0;
	$o["commerciaux"] = "";

	foreach ($res as $value) {
		$o["commerciaux"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>