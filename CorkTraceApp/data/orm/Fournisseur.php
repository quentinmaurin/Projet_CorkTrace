<?php

require_once("Db.php");
require_once("Table.php");

final class Fournisseur extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_fournisseur_fou";
        $this->fields = array(
                "fou_id"      => "fou_id",
                "fou_nom"     => "fou_nom",
                "fou_adresse" => "fou_adresse",
                "fou_mail"    => "fou_mail",
				"fou_tel"     => "fou_tel",
				"fou_fax"     => "fou_fax",
				"tyf_id"      => "tyf_id"
        );
	}
	
}

?>
