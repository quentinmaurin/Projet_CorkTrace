<?php


	$o["adresses"][0]["adr_id"] = 1;
	$o["adresses"][0]["adr_adresse"] = "tototo";
	$o["adresses"][1]["adr_id"] = 2;
	$o["adresses"][1]["adr_adresse"] = "tatata";


header('Content-Type: application/json');
echo json_encode($o);


?>