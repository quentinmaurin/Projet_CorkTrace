<?php
	// PHPMailer
	// tuto : http://www.dewep.net/Blog/Article-15/Envoyer-un-E-Mail-avec-PHPMailer
	
	require_once('phpmailer/class.phpmailer.php');
	require_once('phpmailer/class.smtp.php');
	
	/*$adrMail = $_GET['mail'];
	$pdf    = $_GET['pdf'];
	$module = $_GET['module'];
	*/
	
	function envoiMail($adrMail, $pdf, $module){
	
		$mail = new PHPMailer();
		$envoi = true;
		
		// authentification SMTP
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host       = "smtp.gmail.com";     
		$mail->Port       = 465;                  
		$mail->Username   = "mnebob66@gmail.com"; 
		$mail->Password   = "mnebob66+";        
		
		// format HTML 
		$mail->IsHTML(true);

		// Encodage
		$mail->CharSet = "utf-8";

		// Expéditeur
		$mail->SetFrom('info@corktrace.fr', 'CorkTrace');

		// Objet
		if($module=="confirmClient"){
			$mail->Subject = 'Confirmation de commande';
		}else if($module=="factureClient"){
				$mail->Subject = 'Facture de votre commande';
			}else{
				$mail->Subject = 'Corktrace';
			}
		
		// image
		$mail->AddEmbeddedImage('../img/logosmall.png','mon_logo', 'logo.png');

		// Contenu mail
		$mail->Body = "Bonjour,<br><br>";
		
		if($module=="confirmClient"){
			$mail->Body .= 
			"<p>
				Vous trouverez ci-joint au format PDF <b>la confirmation de votre commande</b>.
				<br><br>";
		}
		
		if($module=="factureClient"){
			$mail->Body .= 
			"<p>
				Vous trouverez ci-joint au format PDF <b>la facture de votre commande</b>.
				<br><br>";	
		}
		
		$mail->Body .= "Merci de votre intérêt pour CorkTrace.<br>
						Cordialement,<br><br>
						<table>
							<tr>
								<td align=center>
									<img src='cid:mon_logo' alt='Logo'/><br><br>
								</td>
								<td>
									<b>Gérard Mensoif</b><br>
									Service client CorkTrace<br>
									Tel : 04 68 65 45 43<br>
									Mail : gerard.mensoif@corktrace.fr<br>
								</td>
							</tr>
						</table>
						
					</p>";
		
		// Destinataire
		$mail->AddAddress($adrMail);
		
		// piece jointe PDF
		if (! file_exists($pdf)) {
			echo "Le fichier <b>$pdf</b> n'existe pas.";
			$envoi = false;
		}
		else{
			$mail->AddAttachment($pdf);
		}
		
		
		//envoi mail
		if($envoi == true){
			if(!$mail->Send()) {
				echo "<br>Mailer Error: " . $mail->ErrorInfo;
				return "ERROR";
			} else {
				echo "<br>Message sent!";
				return "OK";
			}
		}
	}


?>