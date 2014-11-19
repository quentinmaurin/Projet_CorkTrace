<?php

$cli_id = $_GET['cli_id'];

if( $cli_id == 1 ){

	$o["adresse_livraisons"][0]["cla_id"] = 1;
	$o["adresse_livraisons"][0]["cli_id"] = 2;
	$o["adresse_livraisons"][0]["adr_id"] = 3;

}else if( $cli_id == 2 ){

	$o["adresse_livraisons"][0]["cla_id"] = 3;
	$o["adresse_livraisons"][0]["cli_id"] = 3;
	$o["adresse_livraisons"][0]["adr_id"] = 3;

}else{

	$o["adresse_livraisons"][0]["cla_id"] = 1;
	$o["adresse_livraisons"][0]["cli_id"] = 1;
	$o["adresse_livraisons"][0]["adr_id"] = 1;
	$o["adresse_livraisons"][1]["cla_id"] = 2;
	$o["adresse_livraisons"][1]["cli_id"] = 2;
	$o["adresse_livraisons"][1]["adr_id"] = 2;
}



header('Content-Type: application/json');
echo json_encode($o);


?>