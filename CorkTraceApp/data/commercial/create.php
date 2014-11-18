<?php

	require_once("../orm/Commercial.php");
	
	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$com_nom		= isset ($data->{'com_nom'}) ? $data->{'com_nom'} : "undefined";
	$com_prenom		= isset ($data->{'com_prenom'}) ? $data->{'com_prenom'} : "undefined";
	$com_adresse 	= isset ($data->{'com_adresse'}) ? $data->{'com_adresse'} : "undefined";
	$com_mail 		= isset ($data->{'com_mail'}) ? $data->{'com_mail'} : "undefined";
	$com_tel 		= isset ($data->{'com_tel'}) ? $data->{'com_tel'} : "undefined";
	$com_fax 		= isset ($data->{'com_fax'}) ? $data->{'com_fax'} : "undefined";

	/*echo "coucou".$com_nom." ".$com_prenom	;
	echo '<br>';
	echo $com_adresse;echo '<br>';
	echo $com_mail 	;echo '<br>';
	echo $com_tel 	;echo '<br>';
	echo $com_fax 	;echo '<br>';*/
	

	if( $com_nom == "undefined" ||
		$com_prenom == "undefined" ||
		$com_adresse == "undefined" ||		
		$com_mail == "undefined" ||	
		$com_tel == "undefined" ||		
		$com_fax == "undefined" )
	{
		die("Valeurs manquantes");
	}

	$Commercial = new Commercial();
	$id = $Commercial->insertRow('"NULL", "'.$com_nom.'","'.$com_prenom.'", "'.$com_adresse.'", "'.$com_mail.'", "'.$com_tel.'", "'.$com_fax.'"');

	echo $id;

?>