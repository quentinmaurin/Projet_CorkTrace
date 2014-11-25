<?php

	function isLongueurConforme($echantillon,$lgMax,$lgMin,$nbTolerance){
		$nbRebus=0;
		foreach ($echantillon as $value) {
			if($value>$lgMax || $value<$lgMin){
				$nbRebus++;
			}
		}

		if($nbRebus<=$nbTolerance){
			return 1;
		}else{
			return 0;
		}
	}
	
	function isDiametreConforme($echantillon,$dmMax,$dmMin,$nbTolerance){
		$nbRebus=0;
		foreach ($echantillon as $value) {
			if($value>$dmMax || $value<$dmMin){
				$nbRebus++;
			}
		}
		if($nbRebus<=$nbTolerance){
			return 1;
		}else{
			return 0;
		}
	}
	
	function isOvalisationConforme($echantillon,$ovMax,$nbTolerance){
		$nbRebus=0;
		foreach ($echantillon as $value) {
			if($value>$ovMax){
				$nbRebus++;
			}
		}
		if($nbRebus<=$nbTolerance){
			return 1;
		}else{
			return 0;
		}
	}
	
	function isHumiditeConforme($echantillon,$hmMax,$hmMin,$nbToleranceMin){
		$nbOK=0;
		$i=0;
		while($i<$nbToleranceMin) {
			$value = $echantillon[$i];
			if($value<=$hmMax && $value>=$hmMin){
				$nbOK++;
			}
			$i++;
		}
		if($nbOK>=$nbToleranceMin){
			return 1;
		}else{
			return 0;
		}
	}
	
	function sourcesNonConformite($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou, $toleranceTcaFou,
								   $tcaInt, $toleranceTcaInt,
								   $capilarite,
								   $echantillonHm,$hmMax,$hmMin,$nbToleranceHmMin,
								   $diamCompr, $toleranceDiamCompr){

		$tabConfo['Longueur']=isLongueurConforme($echantillonLg,$lgMax,$lgMin,$nbToleranceLg);
		$tabConfo['Diametre']=isDiametreConforme($echantillonDm,$dmMax,$dmMin,$nbToleranceDm);
		$tabConfo['Ovalisation']=isOvalisationConforme($echantillonOv,$ovMax,$nbToleranceOv);
		$tabConfo['Gout']=($gout==$goutAcceptation)?1:0;
		$tabConfo['TCAFournisseur']=($tcaFou<$toleranceTcaFou)?1:0;
		$tabConfo['TCAInterne']=($tcaInt<$toleranceTcaInt)?1:0;
		$tabConfo['Capilarite']=($capilarite==1)?0:1;
		$tabConfo['Humidite']=isHumiditeConforme($echantillonHm,$hmMax,$hmMin,$nbToleranceHmMin);
		$tabConfo['DiametreCompression']=($diamCompr>$toleranceDiamCompr)?1:0;
						   
		return $tabConfo;
	}

	function isEchantillonConforme($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou, $toleranceTcaFou,
								   $tcaInt, $toleranceTcaInt,
								   $capilarite,
								   $echantillonHm,$hmMax,$hmMin,$nbToleranceHmMin,
								   $diamCompr, $toleranceDiamCompr){
			
		$tabSourcesNonConformite=sourcesNonConformite($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou,$toleranceTcaFou,
								   $tcaInt,$toleranceTcaInt,
								   $capilarite,
								   $echantillonHm,$hmMax,$hmMin,$nbToleranceHmMin,
								   $diamCompr,$toleranceDiamCompr);
		//print_r($tabSourcesNonConformite);

		$conforme=1;					   
		foreach($tabSourcesNonConformite as $value){
			if($value == 0){
				$conforme=0;
			}
		}
		return $conforme;
	}
?>