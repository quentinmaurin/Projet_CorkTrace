<?php
	// PHPMailer
	// tuto : http://www.dewep.net/Blog/Article-15/Envoyer-un-E-Mail-avec-PHPMailer
	
	require_once('phpmailer/class.phpmailer.php');
	require_once('phpmailer/class.smtp.php');
	
	$mail = $_GET['mail'];
	$pdf = $_GET['pdf'];
	$module = $_GET['module'];
		
	echo "$mail<br>$pdf<br>$module";

	$mail = new PHPMailer();
	
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
	$mail->Subject = 'Corktrace';

	// Contenu mail
	$mail->Body = "<p><b>E-Mail</b> <h2>GROS TEST d'envoi de MAIL !!!!!!!!!!!!</h2> </p>

	";
	
	// Destinataire
	$mail->AddAddress($mail);
	
	// Image
	//$mail->AddEmbeddedImage('../img/logo.png','mon_logo', 'logo.png');
	
	// piece jointe PDF
	$mail->AddAttachment('facture.pdf');
	
	//envoi mail
	if(!$mail->Send()) {
		echo "<br>Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "<br>Message sent!";
	}


?>