<?php
	require_once('html2pdf/html2pdf.class.php');
	require_once('mail.php');
	
	$nomPdf =  $_GET['mod']; // recup module page
	$mail =  $_GET['mail']; // recup mail si rempli
	
	ob_start();
?>

<page align=center>
	<img src="<?php echo $_POST['img_val']; ?>" style="width:90%">
</page>

<?php
	
	$contenu = ob_get_contents();
	ob_end_clean(); 

    // convert to PDF
	$html2pdf = new HTML2PDF('P', 'A4', 'fr');
	$html2pdf->writeHTML($contenu);
	if($nomPdf == "Confirmation"){
		$html2pdf->Output('documentPdf/'.$nomPdf.'.pdf', 'F');
	}
	else if($nomPdf == "Facturation"){
		$html2pdf->Output('documentPdf/'.$nomPdf.'.pdf', 'F');
		
	}else if($nomPdf == ""){
	$html2pdf->Output($nomPdf.'.pdf');
	}
	
	//
	if($nomPdf == "Confirmation"){

		$module = "confirmClient";
		$pdf    = "documentPdf/".$nomPdf.".pdf";
		
		$retourMail = envoiMail($mail, $pdf, $module);
		if($retourMail == "OK"){
			echo '<SCRIPT>javascript:window.close()</SCRIPT>';
		}
	}
	
	if($nomPdf == "Facturation"){

		$module = "factureClient";
		$pdf    = "documentPdf/".$nomPdf.".pdf";
		
		$retourMail = envoiMail($mail, $pdf, $module);
		echo $retourMail;
		if($retourMail == "OK"){
			echo '<SCRIPT>javascript:window.close()</SCRIPT>';
		}
	}
?>