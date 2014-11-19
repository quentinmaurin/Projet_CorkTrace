<?php

class Mail{

	private $header;
	private $objet;
	private $message;
	
	//$mail = new Mail();
    //$mail->fonctionMail();
	
	public function __construct(){
	
		$headers ='From: "CorkTrace"<info@corktrace.fr>'."\n";
		$headers .='Reply-To: no-reply'."\n";
		$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit'; 
		
		$this->header = $headers; 
	}
	
	public function envoiMail($mailClient){
	
	
		mail($mailClient , $this->objet , $this->message , $this->header); 
		
		$this->header=  "";
		$this->objet = "";
		$this->message = "";
	}
	
	public function messageSimple($prenom, $nom){
	
		$this->objet = "Test Envoi Mail";
				$message = "Bonjour ".$prenom." ".$nom.", \nJe vous envoie un mail test";
				$message .="Youpi !!!! ";
				
		$this->message = $message;
	}
	
	public function messageCreationClient($prenom, $nom, $mailClient, $mdp){
	
		$this->objet = "Création compte Client UGI";
				$message = "Bonjour ".$prenom." ".$nom.", \nVotre compte Client Urgence-Informatique a été créé.";
				$message .=" Vous pouvez suivre l'avancée des travaux effectués sur vos produits en vous connectant sur notre site http://urgence-informatique.fr avec les identifiants suivants :\n\n";
				$message .="\tEmail : ".$mailClient."\n\tMot de passe : ".$mdp."\n\n";
				$message .="Merci de votre fidélité.\nCordialement\n\nL'équipe d'Urgence-Informatique";
				$message .="\n\n\nCe message a été généré automatiquement, merci de ne pas y répondre.";
		$this->message = $message;
	}
	
	public function messageIntervention($terminer, $nom, $prenom, $detail){
	
				$message = "Bonjour ".$prenom." ".$nom.",\n\n";
				
				if( $terminer == 1){
					$this->objet = "Maintenance Terminée";
					$message .="Nous avons fini la réparation de votre produit. Vous pouvez venir le récuperer dans notre centre.";
				}
				else{
					$this->objet = "Suivi de Maintenance";
					$message .="Votre produit est toujours en cours de réparation.";
				}
		
				$message .="\nVoici les details que l'employé a laissé au sujet de votre produit :\n";
				$message .= $detail;
				$message .="\n\nMerci de votre fidélité.\nCordialement\n\nL'équipe d'Urgence-Informatique";
				$message .="\n\n\nCe message a été généré automatiquement, merci de ne pas y répondre.";
	

		$this->message = $message;
		
	}
	
	
	public function messagePrisEnCharge($prenom, $nom, $date, $detail){
	
		$this->objet = "Prise en charge de votre matériel";
				$message = "Bonjour ".$prenom." ".$nom.", \n\nVotre matériel a été pris en charge par l'un de nos employés.";
				$message .="Vous pouvez suivre l'avancée des travaux effectués sur votre produit en vous connectant sur notre site.\n";
				$message .="Vous serez averti par mail à chaque étape de la maintenance. \nL'intervention débutera le ".$date;
				$message .="\nVoici les details que l'employé a laissé au sujet de votre produit :\n";
				$message .= $detail;
				$message .="\n\nMerci de votre fidélité.\nCordialement\n\nL'équipe d'Urgence-Informatique";
				$message .="\n\n\nCe message a été généré automatiquement, merci de ne pas y répondre.";
		$this->message = $message;
	}
	
	public function messageCreationContrat($nom, $prenom, $dateDebut, $dateFin, $marque, $forfait, $prix, $categorie){
	
		$this->objet = "Création de votre contrat";
				$message = "Bonjour ".$prenom." ".$nom.", \n\nSuite à votre demande, nous avons réalisé votre contrat.";
				$message .=" Vous trouverez ci-dessous le récapitulatif de ce dernier ci dessous :\n";
				$message .="Votre Appareil : ".$categorie." ".$marque;
				$message .="\nVotre forfait : ".$forfait." (".$prix." €/mois)";
				$message .="\nDébut du contrat : ".$dateDebut;
				$message .="\nFin du contrat : ".$dateFin;
				$message .="\nPrix Total du contrat :";
				$message .="\n\nMerci de votre fidélité.\nCordialement\n\nL'équipe d'Urgence-Informatique";
				$message .="\n\n\nCe message a été généré automatiquement, merci de ne pas y répondre.";
		$this->message = $message;
	}
	
	public function messageSignalerIncident($nom, $prenom){
	
		$this->objet = "Enregistrement de votre incident";
				$message = "Bonjour ".$prenom." ".$nom.", \n\nNous avons bien reçu le signalement au sujet de votre incident.";
				$message .="\nNos techniciens vont s'occuper au plus vite de votre problème.\n";
				$message .="Vous recevrez un mail lorsque votre matériel sera pris en charge.";
				
				$message .="\n\nMerci de votre fidélité.\nCordialement\n\nL'équipe d'Urgence-Informatique";
				$message .="\n\n\nCe message a été généré automatiquement, merci de ne pas y répondre.";
		$this->message = $message;
	}
    	

    public function affiche(){
    
        return ("<br><br>".$this->header."<br><br>".$this->objet."<br><br>".$this->message."<br><br>");
    }
	
}

?>