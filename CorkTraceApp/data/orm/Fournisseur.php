<?php

require_once("Db.php");
require_once("Table.php");

final class Fournisseur extends Table{
	
	public function __construct(){

        $this->db = new Db();
		$this->name = "t_fournisseur_fou";
        $this->fields = array(
                "FOU_ID"      => "FOU_ID",
                "FOU_NOM"     => "FOU_NOM",
                "FOU_ADRESSE" => "FOU_ADRESSE",
                "FOU_MAIL"    => "FOU_MAIL",
				"FOU_TEL"     => "FOU_TEL",
				"FOU_FAX"     => "FOU_FAX",
				"TYF_ID"      => "TYF_ID"
        );
	}
	public function getAll(){

        $query = "SELECT t_fournisseur_fou.fou_id, t_fournisseur_fou.fou_nom, t_fournisseur_fou.fou_adresse, t_fournisseur_fou.fou_mail, t_fournisseur_fou.fou_tel, t_fournisseur_fou.fou_fax, t_fournisseur_fou.tyf_id, t_typefou_tyf.tyf_nom
				  FROM t_fournisseur_fou 
				  INNER JOIN t_typefou_tyf ON t_fournisseur_fou.tyf_id=t_typefou_tyf.tyf_id";

        $allRows = $this->db->getResponse($query);
        
        return $allRows;
    }
	
}

?>
