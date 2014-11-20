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


	function equation_courbe_regression($tableauDeValeurs)
	{
		$xi = array();
		$info_equation = array();
		$yi = $tableauDeValeurs;

		for($i=0; $i<count($yi); $i++)		$xi[$i] = $i+1;

		$a = covariance($xi,$yi) / variance($xi);
		$b = moyenne($yi) - $a * moyenne($xi);
		$R2 = pow(covariance($xi,$yi),2) / (variance($xi)*variance($yi));
		
		$info_equation[0] = $a;
		$info_equation[1] = $b;
		$info_equation[2] = $R2;

		return $info_equation;
	}


	function valeur_probable($index, $equation_regression)
	{
		$a = $equation_regression[0];
		$b = $equation_regression[1];
		$R2 = $equation_regression[2];

		$valeur_proba = $a * $index + $b;
		$marge = $valeur_proba * (1-$R2);

		echo "Equation de regression : y = " . $a . " x + " . $b . "<br>";
		echo "Coefficient de correlation : R2 = " . $R2 . "<br>";
		echo "Valeur probable : " . $valeur_proba . "<br>";
		echo "Marge d'erreur : " . $marge . "<br>";

		//return array($valeur_proba,$marge,$index_zero); 
	}

	$array = array(10,10,9,8,7,6,5,5,4,2);
	$equation = equation_courbe_regression($array);
	valeur_probable(11, $equation);

?>