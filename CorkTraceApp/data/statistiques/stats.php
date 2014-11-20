<?php
		
	
		
	function moyenne($tableauDeValeurs){
		return array_sum($tableauDeValeurs)/array_count_values($tableauDeValeurs);
	}
	
	function frequences($tableauDeValeurs){
		$total = array_sum(tableauDeValeurs);
		
		foreach($tableauDeValeurs as $val){
			$tabFreq[0] = $val/$total;
		}
	}
	
	function variance($tableauDeValeurs){
		
		$somme = 0;
		$moyenne = moyenne($tableauDeValeurs);
		
		foreach($tableauDeValeurs as $valeur)
		{
			$ecartCarre = pow($valeur - $moyenne,2);
			$somme += $ecartCarre;
		}
		
		return ($somme / array_count_values($tableauDeValeurs));
	}
	
	function ecartType($tableauDeValeurs){
		return sqrt(variance($tableauDeValeurs));
	}
	
	function covariance($tableauDeValeurs1, $tableauDeValeurs2){
		
		$moy1=moyenne($tableauDeValeurs1);
		$moy2=moyenne($tableauDeValeurs2);

		$i=0;
		foreach($tableauDeValeurs1 as $val1){
			$val2=$tableauDeValeurs2[$i];
			$covUnitaire[$i] = ($val1-$moy1)*($val2-$moy2);
			$i++;
		}
		
		return array_sum($covUnitaire)/array_count_values($covUnitaire);
	}

?>