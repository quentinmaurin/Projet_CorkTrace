<?php

	require_once("Mail.php");

	echo "Envoi mail";

	$mail = new Mail();
	$mail->messageSimple('TRICHAUD', 'Loic');
	$mail->envoiMail('loic.trichaud@gmail.com');


?>