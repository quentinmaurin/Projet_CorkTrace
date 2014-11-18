<?php

require_once("Db.php");
require_once("Table.php");

final class DelaiPaiement extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_delaipaye_dpy";
        $this->fields = array(
                "DPY_ID"   => "DPY_ID",
                "DPY_JOUR" => "DPY_JOUR"
        );
	}
	
}

?>
