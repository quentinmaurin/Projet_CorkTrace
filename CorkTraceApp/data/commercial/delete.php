<?php

	require_once("../orm/Commercial.php");

	//Vérif des données entrante
	$com_id	= isset ($_POST['com_id']) ? $_POST['com_id'] : "undefined";

	//$com_id	= isset ($_GET['com_id']) ? $_GET['com_id'] : "undefined";

	if( $com_id == "undefined")
	{
		die("Valeur manquante");
	}

	$Commercial = new Commercial();
	$cond = array('COM_ID' => $com_id);
	$id = $Commercial->deleteRow($cond);

	echo $id;

?>