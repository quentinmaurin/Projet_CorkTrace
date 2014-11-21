<?php

	require_once("../data/orm/CommandeClient.php");
	require_once("../data/orm/CommandeClientDetail.php");
	require_once("../data/orm/Produit.php");

	
	
	$commandeClient = new CommandeClient();
	$commandeClientDetail = new CommandeClientDetail();
	$produit = new Produit();

	
	$id_commande = 1234;

	// Récupération informations table CommandeClient
	$condGetRows = array("CCL_ID" => $id_commande);
	$res = $commandeClient->getRows($condGetRows); 
		$idClientComm = $res[0]['clc_id'];
		$dateCmd      = $res[0]['ccl_dateCmd'];
		$dateLivr     = $res[0]['ccl_dateLiv'];
		$adrLivr      = $res[0]['cla_id'];
		$idDelPaiemt  = $res[0]['dpy_id'];

	// Récupération informations table CommandeClientDetail
	$condGetRows = array("CCL_ID" => $id_commande);
	$res = $commandeClientDetail->getListDetails($id_commande); 
	$detailCommande = $res;
		
		

	
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
				<ul class="nav pull-right">
					<li><a href="index.php">Retour</a></li>
				</ul>
			</div>
		</div>
		
		
		<div class="container">
		
				<div class="row" style="margin-top:100px;">
					<div class="span3" style="text-align:center;">
					</div>
					
					<div class="span6 codebar" style="text-align:center; ">
					
						<img class="codebarreConformite" alt="" src="barcode.php?id=<?php echo $id_commande;?>&taille=4">
						
					</div>
					
					<div class="span3" style="text-align:center;">
					</div>
				</div>

		</div>
		
		<form method="POST" enctype="multipart/form-data" action="editPdf.php" id="myForm">
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