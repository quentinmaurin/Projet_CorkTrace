<?php

require_once("Db.php");
require_once("Table.php");

final class Mesure extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_mesure_mes";
        $this->fields = array(
                "mes_id"         => "mes_id",
                "mes_longueur"   => "mes_longueur",
                "mes_diam1"      => "mes_diam1",
                "mes_diam2"      => "mes_diam2",
                "mes_humidite"   => "mes_humidite",
                "mes_diamcomp"   => "mes_diamcomp",
                "mes_capilarite" => "mes_capilarite",
                "cfm_id"         => "cfm_id"
        );
	}
	
}

?>
