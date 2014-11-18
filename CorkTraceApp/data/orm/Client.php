<?php

require_once("Db.php");
require_once("Table.php");

final class Client extends Table{
	
	public function __construct(){
        $this->db = new Db();
		$this->name = "t_client_cli";
        $this->fields = array(
                "CLI_ID" => "CLI_ID",
                "CLI_NOM" => "CLI_NOM",
                "CLI_MAIL" => "CLI_MAIL",
                "CLI_TEL" => "CLI_TEL",
                "CLI_FAX" => "CLI_FAX",
                "CLI_ADR_FACT" => "CLI_ADR_FACT",
                "TYC_ID" => "TYC_ID"
        );
	}
}

?>
