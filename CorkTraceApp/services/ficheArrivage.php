<?php

	require_once("../data/orm/Arrivage.php");
	require_once("../data/orm/ArrivageDetail.php");
	require_once("../data/orm/CommandeFournisseur.php");
	require_once("../data/orm/Fournisseur.php");
	require_once("../data/orm/Produit.php");

	
	$arrivage = new Arrivage();
	$arrivageDetail = new ArrivageDetail();
	$commandeFournisseur = new CommandeFournisseur();
	$fournisseur = new Fournisseur();
	$produit = new Produit();

	$idArrivage = $_GET['id'];

	// Récupération informations table Arrivage
	$condGetRows = array("ARI_ID" => $idArrivage);
	$res = $arrivage->getRows($condGetRows); 
		$responsable =  $res[0]['ari_responsable'];
		$dateRecept  =  $res[0]['ari_date_recept'];
	
	// Récupération informations table ArrivageDetail
	$condGetRows = array("ARI_ID" => $idArrivage);
	$res = $arrivageDetail->getRows($condGetRows); 
		$listDetailArrivage = $res;
		
	// Récupération informations table Commande Fournisseur
	$condGetRows = array("ARI_ID" => $idArrivage);
	$res = $commandeFournisseur->getRows($condGetRows); 
		$idFourni =  $res[0]['fou_id'];
		
		// Récupération informations table  Fournisseur
	$condGetRows = array("FOU_ID" => $idFourni);
	$res = $fournisseur->getRows($condGetRows); 
		$nomFourni =  $res[0]['fou_nom'];
	
	
	
?>

<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Fiche Arrivage</title>
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="../css/style.css" rel="stylesheet"/>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="html2canvas/build/html2canvas.js"></script>
		<script type="text/javascript" src="html2canvas/build/jquery.plugin.html2canvas.js"></script>
	</head>

	<body>
		<div class="navbar no-print">
			<div class="navbar-inner">
				<a class="brand" href="#">Fiche Arrivage</a>
				<button class="btn" onclick="capture();">Edition PDF</button>
			</div>
		</div>
		<div class="container">
			    
	
				<div class="row">
					<div class="span4">
						<img src="../img/logo.png"/>
					</div>
					<div class="span4">
					</div>
					<div class="span4" style="text-align:center;padding-top:40px;">
						<img alt="" src="barcode.php?id=ARI<?php echo $idArrivage;?>&taille=3&font=14">
					</div>
				</div>
				
				<div style="margin-top:100px; text-align:center;">
						<h2>Bon de reception n° ARI<?php echo $idArrivage;?></h2>
				</div>
				
				<br><br><br>
				
				<div class="row-fluid">
					<div class="span6">
						<table class="table table-bordered tableSmall">
							<thead>
								<tr><th colspan="2"style="text-align:center;" class="colorEnteteFact">Informations Arrivage</th></tr>
							</thead>
							<tbody>
								<tr>
									<th>
										Numéro de fournisseur  <br>
										Fournisseur  <br>
										Date d'arrivage  <br>
									</th>
									<td>
										<?php echo $idFourni;?>     <br>
										<?php echo $nomFourni;?>     <br>
										<?php echo date("d/m/Y", strtotime($dateRecept))?>      <br>
									</td>
								</tr>
							</tbody>
						</table>
					</div>	
					<div class="span3">
						
					</div>	
					<div class="span3">
						
					</div>			  
				</div>
				
				<br>
				
				<!-- ====================================================================================================== -->
				
				<table class="table table-bordered tableSmall">
					<thead>
						<tr class="colorEnteteFact">
							<th class="alignCenter" style="width: 10%;">N° de lot</th>
							<th class="alignCenter">Désignation</th>
							<th class="alignCenter" style="width: 10%;">Quantité</th>
							<th class="alignCenter" style="width: 20%;">Code barre</th>

						</tr>
					</thead>
					<tbody>
					<?php
							//$nb_ligne      = 10;
							for($i=0; $i<count($listDetailArrivage) ; $i++){
								//$nb_ligne--;
								$nomProduit = " ";
								// Récupération Nom produit
								$condGetRows = array("PRO_ID" => $listDetailArrivage[$i]['pro_id']);
								$res = $produit->getRows($condGetRows); 
									$nomProduit = $res[0]['pro_nom'];
		
								echo "
									<tr>
										<td>".$listDetailArrivage[$i]['ard_id']."</td>
										<td>".$nomProduit."</td>
										<td class='alignRight'>".$listDetailArrivage[$i]['ard_quantite']."</td>
										<td class='alignCenter'><img src='barcode.php?id=". $listDetailArrivage[$i]['ard_id']."&taille=2&font=0'></td>

									</tr>";
							}
							
							// permet d'avoir toujours 10 lignes dans le tableau (ligne total comprise)
							/*for($i=0; $i<$nb_ligne ; $i++){
								echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
							}*/

						?>
						
					</tbody>
				</table>
				
				<!-- ====================================================================================================== -->
		
				<div class="piedpage">
					Entreprise CorkTrace – Capital : 1 000 000 000 € - Avenue Paul Pascot – 66004 PERPIGNAN <br>
					Tél : 0404040404 / E-mail : contact@corktrace.fr
				</div>
			
		</div>
		
		<form method="POST" enctype="multipart/form-data" action="editPdf.php?mod=&mail=" id="myForm">
			<input type="hidden" name="img_val" id="img_val" value="" />
		</form>

		<script type="text/javascript">
			function capture() {
				$('.container').html2canvas({
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