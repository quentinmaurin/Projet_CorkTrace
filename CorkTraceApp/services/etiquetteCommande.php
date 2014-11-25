<?php

	require_once("../data/orm/Produit.php");
	require_once("../data/orm/CommandeClient.php");
	require_once("../data/orm/CommandeClientDetail.php");
	require_once("../data/orm/AssignCommercial.php");
	require_once("../data/orm/Client.php");

	$produit = new Produit();
	$commandeClient = new CommandeClient();
	$commandeClientDetail = new CommandeClientDetail();
	$assignCommercial = new AssignCommercial();
	$client = new Client();

	$idCommande = $_GET['id'];
	
	// Récupération informations table CommandeClient
	$condGetRows = array("CCL_ID" => $idCommande);
	$res = $commandeClient->getRows($condGetRows); 
		$idClientComm = $res[0]['clc_id'];
		$dateCmd      = $res[0]['ccl_dateCmd'];
		$dateLivr     = $res[0]['ccl_dateLiv'];
		$adrLivr      = $res[0]['cla_id'];
		$idDelPaiemt  = $res[0]['dpy_id'];

	// Récupération informations table CommandeClientDetail
	$condGetRows = array("CCL_ID" => $idCommande);
	$res = $commandeClientDetail->getListDetails($idCommande); 
	$detailCommande = $res;
	
	
	// Récupération id Assignement client/commercial 
	$condGetRows = array("CLC_ID" => $idClientComm);
	$res = $assignCommercial->getRows($condGetRows); 
		$idClient     = $res[0]['cli_id'];
		$idCommercial = $res[0]['com_id'];
		
	// Récupération Nom Client 
	$condGetRows = array("CLI_ID" => $idClient);
	$res = $client->getRows($condGetRows); 
		$nomClient = $res[0]['cli_nom'];
		$telClient = $res[0]['cli_tel'];
		$faxClient = $res[0]['cli_fax'];
		$adrFactClient = $res[0]['cli_adr_fact'];
	
?>

<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Edition Etiquette</title>
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="../css/style.css" rel="stylesheet"/>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="html2canvas/build/html2canvas.js"></script>
		<script type="text/javascript" src="html2canvas/build/jquery.plugin.html2canvas.js"></script>
	</head>

	<body>
		<div class="navbar no-print">
			<div class="navbar-inner">
				<a class="brand" href="#">Edition Etiquettes</a>
				<!--<button class="btn" onclick="capture();">Edition</button>-->
			</div>
		</div>
		
		
		<div class="container">
				
				<?php
					for($i=0; $i<count($detailCommande) ; $i++){
						$nbEtiquette = 0;
						$quantite = $detailCommande[$i]['ccd_quantite'];
						$nbCarton = $quantite / 5000;
						$entiere = intval($nbCarton);
						$decimal = $nbCarton - $entiere;
						$quantitecarton = 0;
						
						if($decimal == 0){
							$nbEtiquette = $entiere;
						}else{
							$nbEtiquette = $entiere + 1;
						}
						
						echo "
						<div class='rouge' style='color:red; font-size:20px;margin-top:15px;border-top: 2px solid;padding-top: 13px;'>
							".$detailCommande[$i]['pro_nom']." &nbsp;&nbsp;&nbsp;  Quantité: $quantite  &nbsp;&nbsp;&nbsp;   Nbre étiquettes : $nbEtiquette 
						</div> 
						<br>";
			
						for($j=0; $j < $nbEtiquette ; $j++){
						if($quantite >= 5000) {
							$quantitecarton = 5000;
							$quantite = $quantite - 5000;
						}else{
							$quantitecarton = $quantite;
						}
							echo "
							<div class='codebar'>
								<div class='row-fluid'>
									<div class='span4'>
										<img src='barcode.php?id=".$idCommande."&taille=3&font=0'>
									</div>
									<div class='span8'>
										<h4>Commande n°".$idCommande." </h4>
										<b>".$detailCommande[$i]['pro_nom']."</b> <i class='marquage'>Quantité : $quantitecarton </i> <br>
										Client : <b>$nomClient</b>
									</div>
								</div>
							</div>
							";
						}
						echo "<br><br><br>";
						
					}	
			
				?>

		</div>
		
		<form method="POST" enctype="multipart/form-data" action="editPdf.php?mod=&mail=" id="myForm">
			<input type="hidden" name="img_val" id="img_val" value="" />
		</form>

		<script type="text/javascript">
			function capture() {
				$('.codebar').html2canvas({
					onrendered: function (canvas) {
						//Set hidden field's value to image data (base-64 string)
						$('#img_val').val(canvas.toDataURL("image/jpeg"));
						//Submit the form manually
						document.getElementById("myForm").submit();
					}
				});
			}
		</script>

	</body>
	
</html>