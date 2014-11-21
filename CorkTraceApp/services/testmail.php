<?php

	require_once("Mail.php");

	echo "Envoi mail";

	$mail = new Mail();
	$mail->messageSimple('Jacques', 'SPARROT');
	$mail->envoiMail('loic.trichaud@gmail.com');


?>