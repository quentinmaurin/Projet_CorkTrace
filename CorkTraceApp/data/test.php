<?php

	echo"<h1>Test</h1>";
	
    require_once("orm/Adress.php");
    require_once("orm/Arrivage.php");
    require_once("orm/ArrivageDetail.php");
    require_once("orm/AssignCommercial.php");
    require_once("orm/Client.php");
    require_once("orm/CommandeClient.php");
    require_once("orm/CommandeClientDetail.php");
    require_once("orm/CommandeFournisseur.php");
    require_once("orm/CommandeFournisseurDetail.php");
    require_once("orm/Commercial.php");

    $Client = new Commercial();

    var_dump($Client->getAll());
    $Client->deconnect();


?>
