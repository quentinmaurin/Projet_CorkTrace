<?php
		
	function moyenne($tableauDeValeurs)
	{
		return array_sum($tableauDeValeurs)/count($tableauDeValeurs);
	}


	function mediane($tableauDeValeurs)
	{
		sort($tableauDeValeurs);

		$nbValeurs = count($tableauDeValeurs);
		$valeurMediane = floor(($nbValeurs-1)/2);

		if ($nbValeurs % 2)
		{
			$mediane = $tableauDeValeurs[$valeurMediane];
		}
		else
		{
	 		$min = $tableauDeValeurs[$valeurMediane];
	        $max = $tableauDeValeurs[$valeurMediane + 1];
	        $mediane = ($min + $max) / 2;
		}

		return $mediane;
	}

	function moyenne_ponderee($tableauDeValeurs,$coefficient)
	{
		$somme_valeurs = 0;

		foreach ($tableauDeValeurs as $value)
		{
			$somme_valeurs += $value * $coefficient[$i];
			$i++;
		}

		return $somme_valeurs / array_sum($somme_coefficients);
	}

	
	function frequences($tableauDeValeurs)
	{
		$total = array_sum($tableauDeValeurs);
		$tabFreq = array();
		
		foreach($tableauDeValeurs as $val)
		{
			$tabFreq[0] = $val / $total;
		}
		return $tabFreq;
	}
	

	function variance($tableauDeValeurs)
	{
		$somme = 0;
		$moyenne = moyenne($tableauDeValeurs);
		
		foreach($tableauDeValeurs as $valeur)
		{
			$ecartCarre = pow($valeur - $moyenne,2);
			$somme += $ecartCarre;
		}

		return ($somme / count($tableauDeValeurs));
	}
	

	function ecartType($tableauDeValeurs)
	{
		return sqrt(variance($tableauDeValeurs));
	}
	

	function covariance($tableauDeValeurs1, $tableauDeValeurs2)
	{
		$moy1 = moyenne($tableauDeValeurs1);
		$moy2 = moyenne($tableauDeValeurs2);

		$i=0;
		foreach($tableauDeValeurs1 as $val1)
		{
			$val2 = $tableauDeValeurs2[$i];
			$covUnitaire[$i] = ($val1 - $moy1) * ($val2 - $moy2);
			$i++;
		}

		return array_sum($covUnitaire)/count($covUnitaire);
	}


	function pente_courbe_regression($tableauDeValeurs)
	{
		$xi = array();
		$yi = $tableauDeValeurs;

		for($i=0; $i<count($yi); $i++)		$xi[$i] = $i+1;

		return (covariance($xi,$yi) / variance($xi));
	}

	// Param1 : TABLEAU DES QUANTITES DE PRODUITS A L'ARRIVAGE PAR ORDRE CHRONOLOGIQUE
	// Param2 : TABLEAU DES CONFORMITES (1 pour conforme et -1 pour non conforme)
	function taux_non_conformite($array_quantite, $array_conformite)
	{
		$quantite_totale = 0;
		$quantite_non_conforme = 0;

		for($i=0; $i<count($array_quantite); $i++)
		{
			$quantite_totale += $array_quantite[$i];

			if ($array_conformite[$i] == -1)
			{
				$quantite_non_conforme += $array_quantite[$i];
			}
		}

		return ($quantite_non_conforme / $quantite_totale);
	}

	$array_qtt = array(150000,10000,150000,65800,50000,10000,10000,12000,15400,18700);
	$array_conf = array(1,-1,-1,-1,1,1,1,-1,1,1);

	echo "Le fournisseur propose des produits a " . taux_non_conformite($array_qtt,$array_conf) . "%, ";
	if (pente_courbe_regression($array_conf) > 0) 	 echo "avec une qualite ascendante. <br>";
	else 											 echo "avec une qualite descendante. <br>";

?>