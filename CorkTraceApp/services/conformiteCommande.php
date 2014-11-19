<?php

	require_once("../data/orm/CommandeClient.php");
	require_once("../data/orm/CommandeClientDetail.php");
	require_once("../data/orm/Conformite.php");
	require_once("../data/orm/Mesure.php");
	require_once("../data/orm/Produit.php");
	require_once("../data/orm/Client.php");
	require_once("../data/orm/Commercial.php");
	require_once("../data/orm/AssignCommercial.php");
	require_once("../data/orm/AssignAdress.php");
	require_once("../data/orm/Adress.php");
	
	
	$commandeClient = new CommandeClient();
	$commandeClientDetail = new CommandeClientDetail();
	$conformite = new Conformite();
	$mesure = new Mesure();
	$produit = new Produit();
	$client = new Client();
	$commercial = new Commercial();
	$assignCommercial = new AssignCommercial();
	$assignAdress = new AssignAdress();
	$adress = new Adress();
	
	
	$id_commande = 1234;

	
	// Récupération informations table CommandeClient
	$condGetRows = array("CCL_ID" => $id_commande);
	$res = $commandeClient->getRows($condGetRows); 
		$idClientComm = $res[0]['clc_id'];
		$dateLivr     = $res[0]['ccl_dateLiv'];
		$adrLivr      = $res[0]['cla_id'];

	// Récupération informations table CommandeClientDetail
	$condGetRows = array("CCL_ID" => $id_commande);
	$res = $commandeClientDetail->getRows($condGetRows); 
		$idCommandeDetail = $res[0]['ccd_id'];
		$idProduit        = $res[0]['pro_id'];
		$idConformite     = $res[0]['cfm_id'];
		$quantite         = $res[0]['ccd_quantite'];
		
		
	// Récupération informations table Conformité
	$condGetRows = array("CFM_ID" => $idConformite);
	$res = $conformite->getRows($condGetRows); 
		$tca_fourni  = $res[0]['cfm_tca_fourni'];
		$tca_interne = $res[0]['cfm_tca_inter'];
		$gout        = $res[0]['cfm_gout'];
		$decision    = $res[0]['cfm_decision'];
		$capilarite  = $res[0]['cfm_capilarite'];
		$humidite    = $res[0]['cfm_humidite'];
		$diamCompr   = $res[0]['cfm_diamcompr'];
	
	// Récupération informations table Mesure
	$condGetRows = array("CFM_ID" => $idConformite);
	$res = $mesure->getRows($condGetRows); 
	$mesures = $res;
		
	// Récupération Nom produit + taille
	$condGetRows = array("PRO_ID" => $idProduit);
	$res = $produit->getRows($condGetRows); 
		$nomProduit = $res[0]['pro_nom'];
		$tailleProduit = $res[0]['pro_taille'];
	
	// Récupération id Assignement client/commercial 
	$condGetRows = array("CLC_ID" => $idClientComm);
	$res = $assignCommercial->getRows($condGetRows); 
		$idClient     = $res[0]['cli_id'];
		$idCommercial = $res[0]['com_id'];

	// Récupération Nom Client 
	$condGetRows = array("CLI_ID" => $idClient);
	$res = $client->getRows($condGetRows); 
		$nomClient = $res[0]['cli_nom'];
		
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
		<title>Résultat de conformité COMMANDE</title>
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="../css/style.css" rel="stylesheet"/>
	</head>

	<body>
		<div class="container">
		    
			<div class="row">
				<div class="span3"><img src="../img/logo.png"/></div>
				<div class="span9" style="text-align:center;"><h1>Résultat de conformité COMMANDE</h1></div>
			</div>
			
			<br/>
			
		<!-- ====================================================================================================== -->	
		<legend>Informations :</legend>
			<div class="row">
				<div class="span6">
					<table class="table table-bordered">
						<tr>
							<th>N° de commande</th>
							<td><?php echo $id_commande;?></td>
						</tr>
						<tr>
							<th>Produit </th>
							<td><?php echo $idProduit." - ".$nomProduit;?></td>
						</tr>
						<tr>
							<th>Taille Bouchon </th>
							<td><?php echo $tailleProduit;?> mm</td>
						</tr>
						<tr>
							<th>Quantité</th>
							<td><?php echo $quantite;?></td>
						</tr>
						<tr>
							<th>Date livraison</th>
							<td><?php echo $dateLivr;?></td>
						</tr>
						<tr>
							<th>Client</th>
							<td><?php echo $nomClient." (n° ".$idClient.")";?></td>
						</tr>
						<tr>
							<th>Commercial</th>
							<td><?php echo $nomCommercial." (n° ".$idCommercial.")";?></td>
						</tr>
						<tr>
							<th>Adresse de livraison</th>
							<td><?php echo $nom_adresse?></td>
						</tr>
					</table>
				</div>
				<div class="span6">
				</div>
			</div>
			
			<!-- ====================================================================================================== -->
			
			<legend>Détails de l’échantillonage :</legend>	
			<table class="table table-bordered echantillon">
				<thead>
				<tr>
					<th>Bouchons</th>
					<th>Hauteur</th>
					<th>Diamètre</th>
					<th>Ovalisation</th>
				</tr>
				</thead>
				<tbody>
					<?php
					
					$rebusHauteur = 0;
					$rebusDiam    = 0;
					$rebusOval    = 0;
					$spanRougeH = 0;
					$spanRougeD = 0;
					$spanRougeO = 0;
						
						for($i=0; $i<count($mesures) ; $i++){
						
							if($mesures[$i]['mes_longueur'] >= $tailleProduit-0.5 && $mesures[$i]['mes_longueur'] <= $tailleProduit+0.5 ){
								$spanRougeH = 0;
							}else{
								$rebusHauteur++;
								$spanRougeH = 1;	
							}
							
							if($mesures[$i]['mes_diam'] >= 24-0.5 && $mesures[$i]['mes_diam'] <= 24+0.5 ){
								$spanRougeD = 0;
							}else{
								$rebusDiam++;
								$spanRougeD = 1;	
							}
							
							if($mesures[$i]['mes_oval'] <= 0.7 ){
								$spanRougeO = 0;
							}else{
								$rebusOval++;
								$spanRougeO = 1;	
							}
				
							echo "
								<tr>
									<td>".$mesures[$i]['mes_id']."</td>
									<td><span class='".(($spanRougeH==1)?'rouge':'')."'>".$mesures[$i]['mes_longueur']."</span></td>
									<td><span class='".(($spanRougeD==1)?'rouge':'')."'>".$mesures[$i]['mes_diam']."</span></td>
									<td><span class='".(($spanRougeO==1)?'rouge':'')."'>".$mesures[$i]['mes_oval']."</span></td>
								</tr>";
						}

						echo "
							<tr>
								<td><b>Rebus</b></td>
								<td><span class='".(($rebusHauteur>2)?'rouge':'')."'>".$rebusHauteur."</span></td>
								<td><span class='".(($rebusDiam>2)?'rouge':'')."'>".$rebusDiam."</span></td>
								<td><span class='".(($rebusOval>2)?'rouge':'')."'>".$rebusOval."</span></td>
							</tr>";
					?>

				</tbody>
			</table>
			
			<?php
				$cocheVerte = "<img src='../img/cocheverte.png' class='img_coche'/>";
				$cocheRouge = "<img src='../img/cocherouge.png' class='img_coche'/>";
			?>
			
			<br/>
			
			<!-- ====================================================================================================== -->
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="celluleCenter">Paramètres</th>
						<th class="celluleCenter">Détails et valeurs</th>
						<th class="celluleCenter">Validation</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Dimensions</td>
						<td>
							Hauteur : <?php echo "<span class='".(($rebusHauteur>2)?'rouge':'')."'>".$rebusHauteur."</span>" ?> – 
							diamètre : <?php echo "<span class='".(($rebusDiam>2)?'rouge':'')."'>".$rebusDiam."</span>";?> – 
							ovalisation : <?php echo "<span class='".(($rebusOval>2)?'rouge':'')."'>".$rebusOval."</span>" ?>
						</td>
						<td class="celluleCenter">
							<?php
								if($rebusHauteur>2 || $rebusDiam>2 || $rebusOval>2){
									echo $cocheRouge;
								}else{
									echo $cocheVerte;
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Humidité</td>
						<td><?php echo $humidite;?> %</td>
						<td class="celluleCenter">
							<?php
								if($humidite>=4 && $humidite<=8){
									echo $cocheVerte;
								}else{
									echo $cocheRouge;
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Compression</td>
						<td><?php echo $diamCompr;?> %</td>
						<td class="celluleCenter">
							<?php
								if($diamCompr>=90){
									echo $cocheVerte;
								}else{
									echo $cocheRouge;
								}
							?>
						</td>
					</tr>
					<tr>
						<td>TCA prestataire</td>
						<td><?php echo $tca_fourni;?> ng/L</td>
						<td class="celluleCenter">
							<?php
								if($tca_fourni<2){
									echo $cocheVerte;
								}else{
									echo $cocheRouge;
								}
							?>
						</td>
					</tr>
					<tr>
						<td>TCA interne</td>
						<td><?php echo $tca_interne;?> ng/L</td>
						<td class="celluleCenter">
							<?php
								if($tca_interne<2){
									echo $cocheVerte;
								}else{
									echo $cocheRouge;
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Goût correct</td>
						<td><?php echo $gout;?></td>
						<td class="celluleCenter">
							<?php
								if($gout=="oui"){
									echo $cocheVerte;
								}else if($gout=="non"){
									echo $cocheRouge;
								}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
						<td class="decision">
							<?php 
								switch ($decision) {
									case 'En attente':
										echo "<span class='enAttente'>".$decision."</span>";
										break;
									case 'Accepté':
										echo "<span class='conform'>".$decision."</span>";
										break;
									case 'Refusé':
										echo "<span class='nonConform'>".$decision."</span>";
										break;
									case 'Dérogation':
										echo "<span class='derogation'>".$decision."</span>";
										break;
								}
							?>
						</td>
					</tr>
					
				</tbody>
			</table>
			
			<!-- ====================================================================================================== -->
			
			<hr/>
			<div class="row">
				<div class="span6">
					Commentaires : <br>
					<textarea rows="3" style="width:80%;"></textarea>
				</div>
				<div class="span6">
					<br><br>
					Signature du responsable :
				</div>
			</div>
			
			 
		</div>
	</body>
</html>