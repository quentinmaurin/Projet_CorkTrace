<?php

	require_once("../data/orm/Produit.php");
	require_once("../data/orm/CommandeClient.php");
	require_once("../data/orm/CommandeClientDetail.php");

	$produit = new Produit();
	$commandeClient = new CommandeClient();
	$commandeClientDetail = new CommandeClientDetail();

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
	
	
	// Récupération Nom produit
	/*$condGetRows = array("PRO_ID" => $idProduit);
	$res = $produit->getRows($condGetRows); 
		$nomProduit     = $res[0]['pro_nom'];
		$tailleProduit  = $res[0]['pro_taille'];
		$qualitéProduit = $res[0]['pro_qualite'];*/
	
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
				<button class="btn" onclick="capture();">Edition</button>
			</div>
		</div>
		
		
		<div class="container">
		
				<!--<div class="row" style="margin-top:100px;">
					<div class="span12" style="text-align:center;">
						<div class="codebar">
							<h4><?php //echo $nomProduit;?></h4>
							<img class="" alt="" src="barcode.php?id=<?php //echo $idProduit;?>&taille=3&font=14">
						</div>
					</div>
				</div>-->
				
				<?php
					for($i=0; $i<count($detailCommande) ; $i++){
						$quantite = $detailCommande[$i]['ccd_quantite'];
						$nbCarton = $quantite / 5000;
						echo "Produit $i : $quantite  - $nbCarton <br>";
					}	
					for($i=0; $i<count($detailCommande) ; $i++){
								
						
						/*$detailCommande[$i]['ccd_marquage']
						$detailCommande[$i]['pro_qualite']
						$detailCommande[$i]['pro_id']
						$detailCommande[$i]['pro_nom']

						echo "
						<div class='codebar'>
							<h4><?php echo $nomProduit;?></h4>
							<img src='barcode.php?id=<?php echo $idProduit;?>&taille=3&font=14'>
						</div>
						";*/
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