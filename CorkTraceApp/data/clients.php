<?php

    $o["clients"] = "";
    $i = 0;

    while ($i < 4){

        $row["cli_id"] = $i;
        $row["cli_nom"] = "toto".$i;
        $row["cli_mail"] = "adrien".$i;
        $row["cli_tel"] = $i;
        $row["cli_fax"] = "adrien".$i;
        $row["cli_adr_fact"] = "adr".$i;
        $row["tyc_id"] = 1;
    

        $o["clients"][$i] = $row;
        $i++;
    }
    header("Content-Type: application/json");
    echo json_encode($o);
    
?>
