<?php

require_once("Db.php");
require_once("Table.php");

final class CommandeFournisseur extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_cmdfourni_cfo";
        $this->fields = array(
            "CFO_ID" => "CFO_ID",
            "CFO_DATECMD" => "CFO_DATECMD",
            "CFO_DATERECEPT" => "CFO_DATERECEPT",
            "FOU_ID" => "FOU_ID",
            "ARI_ID" => "ARI_ID"
        );
	}
}

?>
