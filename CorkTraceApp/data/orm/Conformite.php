<?php

require_once("Db.php");
require_once("Table.php");

final class Conformite extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_conformite_cfm";
        $this->fields = array(
                "CFM_ID"         => "CFM_ID",
                "CFM_TCA_FOURNI" => "CFM_TCA_FOURNI",
                "CFM_TCA_INTER"  => "CFM_TCA_INTER",
                "CFM_GOUT"       => "CFM_GOUT",
				"CFM_DECISION"   => "CFM_DECISION",
				"CFM_CAPILARITE" => "CFM_CAPILARITE",
				"CFM_HUMIDITE"   => "CFM_HUMIDITE",
                "CFM_DIAMCOMPR"  => "CFM_DIAMCOMPR"
                
        );
	}
	
}

?>
