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
	
	function sourcesNonConformite($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou, $toleranceTcaFou,
								   $tcaInt, $toleranceTcaInt,
								   $capilarite,
								   $humidite,$hmMax,$hmMin,
								   $diamCompr, $toleranceDiamCompr){

		$tabConfo['Longueur']=isLongueurConforme($echantillonLg,$lgMax,$lgMin,$nbToleranceLg);
		$tabConfo['Diametre']=isDiametreConforme($echantillonDm,$dmMax,$dmMin,$nbToleranceDm);
		$tabConfo['Ovalisation']=isOvalisationConforme($echantillonOv,$ovMax,$nbToleranceOv);
		$tabConfo['Gout']=($gout==$goutAcceptation)?1:0;
		$tabConfo['TCAFournisseur']=($tcaFou<$toleranceTcaFou)?1:0;
		$tabConfo['TCAInterne']=($tcaInt<$toleranceTcaInt)?1:0;
		$tabConfo['Capilarite']=($capilarite==1)?1:0;
		$tabConfo['Humidite']=($humidite<$hmMax && $humidite>$hmMin)?1:0;
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
								   $humidite,$hmMax,$hmMin,
								   $diamCompr, $toleranceDiamCompr){
			
		$tabSourcesNonConformite=sourcesNonConformite($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou,$toleranceTcaFou,
								   $tcaInt,$toleranceTcaInt,
								   $capilarite,
								   $humidite,$hmMax,$hmMin,
								   $diamCompr,$toleranceDiamCompr);

		$conforme=1;					   
		foreach($tabSourcesNonConformite as $value){
			if(!$value){
				$conforme=0;
			}
		}
		return conforme;
	}
?>