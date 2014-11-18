<?php

require_once("Db.php");
require_once("Table.php");

final class Mesure extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_mesure_mes";
        $this->fields = array(
                "MES_ID"       => "MES_ID",
                "MES_LONGUEUR" => "MES_LONGUEUR",
                "MES_DIAM"     => "MES_DIAM",
                "MES_OVAL"     => "MES_OVAL",
                "CFM_ID"       => "CFM_ID"
        );
	}
	
}

?>
