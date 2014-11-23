<?php

	require_once("../data/orm/CommandeClient.php");
	require_once("../data/orm/CommandeClientDetail.php");
	require_once("../data/orm/DelaiPaiement.php");
	require_once("../data/orm/Client.php");
	require_once("../data/orm/Commercial.php");
	require_once("../data/orm/AssignCommercial.php");
	require_once("../data/orm/Produit.php");
	require_once("../data/orm/AssignAdress.php");
	require_once("../data/orm/Adress.php");
	
	
	$commandeClient = new CommandeClient();
	$commandeClientDetail = new CommandeClientDetail();
	$delaiPaiement = new DelaiPaiement();
	$produit = new Produit();
	$client = new Client();
	$commercial = new Commercial();
	$assignCommercial = new AssignCommercial();
	$assignAdress = new AssignAdress();
	$adress = new Adress();
	
	$id_commande = $_GET['id'];
	$nomPdf = "Confirmation";
	

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
		
		
	// Récupération delai jour paiement
	$condGetRows = array("DPY_ID" => $idDelPaiemt);
	$res = $delaiPaiement->getRows($condGetRows); 
		$nbJours =  $res[0]['dpy_jour'];

	// Récupération id Assignement client/commercial 
	$condGetRows = array("CLC_ID" => $idClientComm);
	$res = $assignCommercial->getRows($condGetRows); 
		$idClient     = $res[0]['cli_id'];
		$idCommercial = $res[0]['com_id'];

	// Récupération Nom Client 
	$condGetRows = array("CLI_ID" => $idClient);
	$res = $client->getRows($condGetRows); 
		$nomClient = $res[0]['cli_nom'];
		$mailClient = $res[0]['cli_mail'];
		$telClient = $res[0]['cli_tel'];
		$faxClient = $res[0]['cli_fax'];
		$adrFactClient = $res[0]['cli_adr_fact'];
		
	// Récupération Nom Commercial 
	$condGetRows = array("COM_ID" => $idCommercial);
	$res = $commercial->getRows($condGetRows); 
		$nomCommercial = $res[0]['com_prenom']." ".$res[0]['com_nom'];
	
	// Récupération id assignement adresse CLient 
	$condGetRows = array("CLA_ID" => $adrLivr);
	$res = $assignAdress->getRows($condGetRows); 
		$id_adresse = $res[0]['adr_id'];
		
	// Récupération id adresse CLient 
	$condGetRows = array("ADR_ID" => $id_adresse);
	$res = $adress->getRows($condGetRows); 
		$nom_adresse = $res[0]['adr_adresse'];
	
?>

<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Confirmation de commande</title>
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="../css/style.css" rel="stylesheet"/>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="html2canvas/build/html2canvas.js"></script>
		<script type="text/javascript" src="html2canvas/build/jquery.plugin.html2canvas.js"></script>
	</head>

	<body onload="capture();">
		<div class="navbar no-print">
			<!--<div class="navbar-inner">
				<a class="brand" href="#">Confirmation de commande Client</a>
				<button class="btn" onclick="capture();">Edition PDF</button>
				<ul class="nav pull-right">
					<li><a href="index.php">Retour</a></li>
				</ul>
			</div>-->
		</div>
		<div class="envoi" style="">
			<div class="load" style="width:100px;height:100px;margin: 0 auto;"> 
				&nbsp;
			</div> 
			Envoi de la confirmation au client ...
		</div>
		<div class="container">
			    
	
				<div class="row">
					<div class="span3"><img src="../img/logo.png"/></div>
					<div class="span6" style="text-align:center;padding-top:40px;">
						
						<!--<img alt="" src="barcode.php?id=<?php //echo $id_commande;?>&taille=3&font=14">-->
						
					</div>
					<div class="span3">
					<br><b>CorkTrace</b><br>
					Avenue Paul Pascot<br>
					BP 90443<br>
					66004 PERPIGNAN<br>
					</div>
				</div>
				<div class="row" style="margin-top:100px;">
					<div class="span12" style="text-align:center;">
						<h2>Confirmation de votre commande N° <?php echo $id_commande;?></h2>
					</div>
				</div>
				<br><br><br>
					
						<p>Bonjour,</p>
						<p>Vous avez passé une commande chez CorkTrace et nous vous en remercions. Votre commande a bien été enregistrée.</p>
						<p>Retrouvez ci-dessous le récapitulatif de votre 
							commande <b>N° <?php echo $id_commande;?></b> que vous avez passée le <b><?php echo date("d/m/Y", strtotime($dateCmd))?></b>.
						</p>
				<br><br>
				<div class="row-fluid">
					<div class="span6">
						<table class="table table-bordered tableSmall">
							<thead>
								<tr><th colspan="2"style="text-align:center;" class="colorEnteteFact">Informations</th></tr>
							</thead>
							<tbody>
								<tr>
									<th>
										N° de commande    <br>
										Numéro de client  <br>
										Date de commande  <br>
										Mode de paiement  <br>
										Date de livraison <br>
									</th>
									<td>
										<?php echo $id_commande;?>  <br>
										<?php echo $idClient;?>     <br>
										<?php echo date("d/m/Y", strtotime($dateCmd))?>      <br>
										A réception de facture (sous <?php echo $nbJours;?> jours)<br>
										<?php echo date("d/m/Y", strtotime($dateLivr)); ?> (estimation)  <br>
									</td>
								</tr>
							</tbody>
						</table>
					</div>	
					<div class="span3">
						<table class="table table-bordered tableSmall">
							<thead>
								<tr><th colspan="2"style="text-align:center;" class="colorEnteteFact">Facturation</th></tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<b><?php echo $nomClient;?> </b><br>
										<?php echo $adrFactClient;?><br>
										Tel : <?php echo $telClient;?><br>
										Fax : <?php echo $faxClient;?><br>
										
									</td>
								</tr>
							</tbody>
						</table>
					</div>	
					<div class="span3">
						<table class="table table-bordered tableSmall">
							<thead>
								<tr><th colspan="2"style="text-align:center;" class="colorEnteteFact">Livraison</th></tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<b><?php echo $nomClient;?> </b><br>
										<?php echo $nom_adresse;?><br>
										Tel : <?php echo $telClient;?><br>
										Fax : <?php echo $faxClient;?><br>
									</td>
								</tr>
							</tbody>
						</table>
					</div>			  
				</div>
				
				<br>
				
				<!-- ====================================================================================================== -->
				
				<table class="table table-bordered tableSmall">
					<thead>
						<tr class="colorEnteteFact">
							<th class="alignCenter">Désignation</th>
							<th class="alignCenter">Référence</th>
							<th class="alignCenter">PU (HT)</th>
							<th class="alignCenter">Quantité</th>
							<th class="alignCenter">Total (HT)</th>
						</tr>
					</thead>
					<tbody>
					<?php
							$totalQuantite = 0;
							$totalPU       = 0;
							$totalMontant  = 0;
							$totalMontantTTC  = 0;
							$totalTVA      = 0;
							$tva           = 0;
							$nb_ligne      = 10;
							$taux_tva      = 20;
							for($i=0; $i<count($detailCommande) ; $i++){
							
								$nb_ligne--;
								$montantHT = 0;
								$montantHT = $detailCommande[$i]['ccd_prix'] * $detailCommande[$i]['ccd_quantite'];
								$tva = $montantHT * $taux_tva/100;
								$montantTtc = $montantHT + $tva;
								
								$totalQuantite = $totalQuantite + $detailCommande[$i]['ccd_quantite'];
								$totalPU       = $totalPU       + $detailCommande[$i]['ccd_prix'];
								$totalMontant  = $totalMontant  + $montantHT;
								

								$totalMontantTTC = $totalMontantTTC + $montantTtc;
						
								echo "
									<tr>
										<td>".$detailCommande[$i]['pro_nom']."</td>
										<td class='alignRight'>".$detailCommande[$i]['pro_id']."</td>
										<td class='alignRight'>".$detailCommande[$i]['ccd_prix']." €</td>
										<td class='alignRight'>".$detailCommande[$i]['ccd_quantite']."</td>
										<td class='alignRight'>".$montantHT." €</td>
									</tr>";
							}
							
							// permet d'avoir toujours 10 lignes dans le tableau (ligne total comprise)
							for($i=0; $i<$nb_ligne-1 ; $i++){
								echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
							}
							
						?>
						
					</tbody>
				</table>
				<table class="table ">
					<tbody>
						<tr>
							<td class='alignRight noborder' > <b>Total (HT)</b> </td>
							<td class='alignRight noborder'> <b><?php echo $totalMontant;?> €</b></td>
						</tr>
						<tr>
							<td class='alignRight noborder'> <i>Dont TVA à 20%</i> </td>
							<td class='alignRight noborder'> <i><?php echo ($totalMontant*20/100);?> €</i></td>
						</tr>
						<tr class="colorEnteteFact">
							<td class='alignRight noborder'> <b>Total de votre commande (TTC)</b></td>
							<td class='alignRight noborder'> <b><?php echo $totalMontantTTC;?> €</b></td>
						</tr>
					</tbody>
				</table>
				
				<!-- ====================================================================================================== -->
		
				<div class="piedpage">
					Entreprise CorkTrace – Capital : 1 000 000 000 € - Avenue Paul Pascot – 66004 PERPIGNAN <br>
					Tél : 0404040404 / E-mail : contact@corktrace.fr
				</div>
			
		</div>
		
		<form method="POST" enctype="multipart/form-data" action="editPdf.php?mod=<?php echo $nomPdf;?>&mail=<?php echo $mailClient;?>" id="myForm">
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