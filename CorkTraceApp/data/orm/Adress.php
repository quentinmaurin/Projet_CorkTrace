<?php

require_once("Db.php");
require_once("Table.php");

final class Adress extends Table{
    public function __construct(){
        $this->db = new Db();
        $this->name = "t_adresse_adr";
        $this->fields = array(
            "ADR_ID" => "ADR_ID",
            "ADR_ADRESSE" => "ADR_ADRESSE"
        );
	}
}

?>
