<?php

	require_once("../data/orm/CommandeClient.php");
	require_once("../data/orm/CommandeClientDetail.php");
	require_once("../data/orm/AssignCommercial.php");
	require_once("../data/orm/Commercial.php");
	require_once("../data/orm/Client.php");
	require_once("../data/orm/Produit.php");

	$commandeClient = new CommandeClient();
	$commandeClientDetail = new CommandeClientDetail();
	$assignCommercial = new AssignCommercial();
	$commercial = new Commercial();
	$client = new Client();
	$produit = new Produit();

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
	
	// Récupération Nom Commercial 
	$condGetRows = array("COM_ID" => $idCommercial);
	$res = $commercial->getRows($condGetRows); 
		$nomCommercial = $res[0]['com_prenom']." ".$res[0]['com_nom'];
	
	
?>

<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Fiche Commande Client</title>
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="../css/style.css" rel="stylesheet"/>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="html2canvas/build/html2canvas.js"></script>
		<script type="text/javascript" src="html2canvas/build/jquery.plugin.html2canvas.js"></script>
	</head>

	<body>
		<div class="navbar no-print">
			<div class="navbar-inner">
				<a class="brand" href="#">Fiche Commande Client</a>
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
						<img alt="" src="barcode.php?id=<?php echo $idCommande;?>&taille=3&font=14">
					</div>
				</div>
				
				<div style="margin-top:100px; text-align:center;">
						<h2>Commande client n° <?php echo $idCommande;?></h2>
				</div>
				
				<br><br><br>
				
				<div class="row-fluid">
					<div class="span6">
						<table class="table table-bordered tableSmall">
							<thead>
								<tr><th colspan="2"style="text-align:center;" class="colorEnteteFact">Informations Commande</th></tr>
							</thead>
							<tbody>
								<tr>
									<th>
										Numéro de client  <br>
										Client  <br>
										Date de commande  <br>
										Commercial 
									</th>
									<td>
										<?php echo $idClient;?>     <br>
										<?php echo $nomClient;?>     <br>
										<?php echo date("d/m/Y", strtotime($dateCmd));?>      <br>
										<?php echo $nomCommercial;?>      <br>
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
							<th class="alignCenter">Marquage</th>
							<th class="alignCenter">Qualité</th>
							<th class="alignCenter" style="width: 10%;">Prix</th>
							<th class="alignCenter" style="width: 10%;">Quantité</th>
							<th class="alignCenter" style="width: 20%;">Code barre</th>

						</tr>
					</thead>
					<tbody>
					<?php
							//$nb_ligne      = 10;
							for($i=0; $i<count($detailCommande) ; $i++){
								//$nb_ligne--;
								
								echo "
									<tr>
										<td class='alignCenter'>".$detailCommande[$i]['ccd_id']."</td>
										<td>".$detailCommande[$i]['pro_nom']."</td>
										<td><i class='marquage'>".$detailCommande[$i]['ccd_marquage']."</i></td>
										<td><i class='marquage'>".$detailCommande[$i]['pro_qualite']."</i></td>
										<td class='alignRight'>".$detailCommande[$i]['ccd_prix']." €</td>
										<td class='alignRight'>".$detailCommande[$i]['ccd_quantite']."</td>
										<td class='alignCenter'><img src='barcode.php?id=". $detailCommande[$i]['ccd_id']."&taille=2&font=0'></td>

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