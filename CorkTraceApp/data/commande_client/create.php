<?php

	require_once("../orm/CommandeClient.php");
	require_once("../orm/CommandeClientDetail.php");

	$data = json_decode($_POST['data']);

	//Vérif des données entrante
	$clc_id			= isset ($data->{'clc_id'}) ? $data->{'clc_id'} : "undefined";
	$ccl_dateLiv 	= isset ($data->{'ccl_dateLiv'}) ? $data->{'ccl_dateLiv'} : "undefined";
	$dpy_id 		= isset ($data->{'dpy_id'}) ? $data->{'dpy_id'} : "undefined";
	$cla_id 		= isset ($data->{'cla_id'}) ? $data->{'cla_id'} : "undefined";
	$details 		= isset ($data->{'details'}) ? $data->{'details'} : "undefined";

	if( $clc_id == "undefined" ||
		$ccl_dateLiv == "undefined" ||
		$cla_id == "undefined" ||		
		$dpy_id == "undefined")
	{
		die("Valeurs manquantes");
	}

	$CommandeClient = new CommandeClient();
	$CommandeClientDetail = new CommandeClientDetail();

	$ccl_dateLiv = date_create($ccl_dateLiv);
	$ccl_dateLiv = date_format($ccl_dateLiv, 'Y-m-d');

	$date = date('Y-m-d');

	$com_id = $CommandeClient->insertRow("'NULL', '".$date."', '".$ccl_dateLiv."', '".$clc_id."', '".$dpy_id."', '".$date."', 'FALSE',  '".$cla_id."' ");

	foreach ($details as $detail) {
		$CommandeClientDetail->insertRow("'NULL', ".$com_id.", ".$detail->{'pro_id'}.", ".$detail->{'ccd_prix'}.", ".$detail->{'ccd_quantite'}.", ".$detail->{'ccd_marquage'});
	}

	header('Content-Type: application/json');
	echo '{"success": true}';
?>