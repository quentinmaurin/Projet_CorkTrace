<?php

require_once("Db.php");
require_once("Table.php");

final class DelaiPaiement extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_delaipaye_dpy";
        $this->fields = array(
                "dpy_id"   => "dpy_id",
                "dpy_jour" => "dpy_jour"
        );
	}
	
}

?>
