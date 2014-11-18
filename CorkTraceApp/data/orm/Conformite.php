<?php

require_once("Db.php");
require_once("Table.php");

final class Conformite extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_conformite_cfm";
        $this->fields = array(
                "cfm_id"         => "cfm_id",
                "cfm_tca_fourni" => "cfm_tca_fourni",
                "cfm_tca_inter"  => "cfm_tca_inter",
                "cfm_gout"       => "cfm_gout",
				"cfm_decision"   => "cfm_decision"
        );
	}
	
}

?>
