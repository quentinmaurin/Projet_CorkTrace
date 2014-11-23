<?php

	require_once("../data/orm/Arrivage.php");
	require_once("../data/orm/ArrivageDetail.php");
	require_once("../data/orm/Conformite.php");
	require_once("../data/orm/Mesure.php");
	require_once("../data/orm/CommandeFournisseur.php");
	require_once("../data/orm/Fournisseur.php");
	require_once("../data/orm/Produit.php");
	
	$arrivage = new Arrivage();
	$arrivageDetail = new ArrivageDetail();
	$conformite = new Conformite();
	$mesure = new Mesure();
	$commandeFournisseur = new CommandeFournisseur();
	$fournisseur = new Fournisseur();
	$produit = new Produit();
	
	$id_arrivage = $_GET['id'];

	// Récupération informations table Arrivage
	$condGetRows = array("ARI_ID" => $id_arrivage);
	$res = $arrivage->getRows($condGetRows); 
		//$numArrivage =  $res[0]['ari_num_arrivage'];
		$responsable =  $res[0]['ari_responsable'];
		$dateRecept  =  $res[0]['ari_date_recept'];
	
	// Récupération informations table ArrivageDetail
	$condGetRows = array("ARI_ID" => $id_arrivage);
	$res = $arrivageDetail->getRows($condGetRows); 
		$idArrivageDetail = $res[0]['ard_id'];
		$idProduit        = $res[0]['pro_id'];
		$idConformite     = $res[0]['cfm_id'];
		$quantite         = $res[0]['ard_quantite'];
		
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
		
	// Récupération Nom produit
	$condGetRows = array("PRO_ID" => $idProduit);
	$res = $produit->getRows($condGetRows); 
		$nomProduit = $res[0]['pro_nom'];
		$tailleProduit = $res[0]['pro_taille'];
	
	// Récupération id fournisseur 
	$condGetRows = array("ARI_ID" => $id_arrivage);
	$res = $commandeFournisseur->getRows($condGetRows); 
	$idFournisseur = $res[0]['fou_id'];
	
	// Récupération Nom fournisseur 
	$condGetRows = array("FOU_ID" => $idFournisseur);
	$res = $fournisseur->getRows($condGetRows); 
	$nomFournisseur = $res[0]['fou_nom'];
	
?>

<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Résultat de conformité ARRIVAGE</title>
		<link href="../css/bootstrap.css" rel="stylesheet"/>
		<link href="../css/style.css" rel="stylesheet"/>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="html2canvas/build/html2canvas.js"></script>
		<script type="text/javascript" src="html2canvas/build/jquery.plugin.html2canvas.js"></script>

	</head>

	<body>
		<div class="navbar no-print">
			<div class="navbar-inner">
				<a class="brand" href="#">Résultat de conformité</a>
				<button class="btn" onclick="capture();">Edition PDF</button>
				<ul class="nav pull-right">
					<li><a href="index.php">Retour</a></li>
				</ul>
			</div>
		</div>
		<div class="container">
		    
			<div class="row">
				<div class="span3"><img src="../img/logo.png"/></div>
				<div class="span6" style="text-align:center;"><h1>Résultat de conformité <br>ARRIVAGE</h1></div>
				<div class="span3"><img src="../img/arrivage.png"/></div>
			</div>
			
			<br/>
			
		<!-- ====================================================================================================== -->	
		<legend>Informations :</legend>
			<div class="row">
				<div class="span6">
					<table class="table table-bordered tableSmall">
						<tr>
							<th>N° d’arrivage</th>
							<td><?php echo "ARI$id_arrivage";?></td>
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
							<th>Date de réception</th>
							<td><?php echo $dateRecept;?></td>
						</tr>
						<tr>
							<th>Responsable Qualité</th>
							<td><?php echo $responsable;?></td>
						</tr>
						<tr>
							<th>Nom du fournisseur</th>
							<td><?php echo $idFournisseur." - ".$nomFournisseur;?></td>
						</tr>
					</table>
				</div>
				<div class="span6" style="text-align:center;">
					<img class="codebarreConformite" alt="" src="barcode.php?id=<?php echo "ARI$id_arrivage";?>&taille=3&font=14">
				</div>
			</div>
			
			<!-- ====================================================================================================== -->
			
			<legend>Détails de l’échantillonage :</legend>	
			<table class="table table-bordered echantillon tableSmall">
				<thead>
				<tr class="colorEnteteFact">
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
									<td>".($i+1)."</td>
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
			
			<table class="table table-bordered tableSmall">
				<thead>
					<tr class="colorEnteteFact">
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
									case 'Conforme':
										echo "<span class='conform'>".$decision."</span>";
										break;
									case 'Non Conforme':
										echo "<span class='nonConform'>".$decision."</span>";
										break;
									case 'Exception':
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

