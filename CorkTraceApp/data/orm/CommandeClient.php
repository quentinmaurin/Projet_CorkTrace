<?php

require_once("Db.php");
require_once("Table.php");

final class CommandeClient extends Table{
	
	public function __construct(){
        $this->db = new Db();
	    $this->name = "t_cmdclient_ccl";
        $this->fields = array(
            "CCL_ID" => "CCL_ID",
            "CCL_DATECMD" => "CCL_DATECMD",            
            "CCL_DATELIV" => "CCL_DATELIV",
            "CLC_ID" => "CLC_ID",
            "DPY_ID" => "DPY_ID",
            "CCL_DATECONFIRM" => "CCL_DATECONFIRM",
            "CCL_CONFIRM" => "CCL_CONFIRM",
            "CLA_ID" => "CLA_ID"
        );
	}
}

?>
