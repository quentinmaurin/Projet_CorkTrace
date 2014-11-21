<?php
	require_once('html2pdf/html2pdf.class.php');
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
	$html2pdf->Output('facture.pdf');
  
?>