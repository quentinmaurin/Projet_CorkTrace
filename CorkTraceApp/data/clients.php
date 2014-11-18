<?php

    $o["clients"] = "";
    $i = 0;
	
	$row["id"] = 1;
	$row["name"] = "toto";
	$row["email"] = "adrien";
	
    while ($i < 4){

        $o["clients"][$i] = $row;
        $i++;
    }
    header("Content-Type: application/json");
    echo json_encode($o);
    
?>
