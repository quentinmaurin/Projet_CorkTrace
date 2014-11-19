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
    public function getAll(){

        $query = "SELECT t_client_cli.cli_id,t_client_cli.cli_nom, t_client_cli.cli_mail, t_client_cli.cli_tel, t_client_cli.cli_fax, t_client_cli.cli_adr_fact, t_client_cli.tyc_id, t_typecli_tyc.tyc_nom 
                  FROM t_client_cli 
                  INNER JOIN t_typecli_tyc ON t_client_cli.tyc_id=t_typecli_tyc.tyc_id";

        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
}

?>
