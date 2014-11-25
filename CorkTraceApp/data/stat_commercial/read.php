<?php

	require_once("../orm/Db.php");

	$com_id = $_GET['com_id'];
	$db = new Db();

	$query  = "
	SELECT com_nom, ccl_dateCmd, ccd_prix, ccd_quantite 
	FROM t_commercial_com 
	INNER JOIN t_clicom_clc ON t_clicom_clc.com_id=t_commercial_com.com_id 
	INNER JOIN t_cmdclient_ccl ON t_cmdclient_ccl.ccl_id=t_clicom_clc.clc_id 
	INNER JOIN t_cmdclidetail_ccd ON t_cmdclidetail_ccd.ccl_id=t_cmdclient_ccl.ccl_id
	WHERE t_commercial_com.com_id=".$com_id ;

	$response = $db->getResponse($query);

	$i= 0;
	$o["statCom"] = "";

	foreach ($response as $value) {
		$o["statCom"][$i] = $value;
		$i++;
	}

	header('Content-Type: application/json');
	echo json_encode($o);
?>